<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderSession;
use App\Models\TutorPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderTutorController extends Controller
{
    /**
     * Menampilkan Halaman Semua Pesanan (Fase 2)
     */
    public function index()
    {
        $user_id = Auth::id();

        // Ambil semua pesanan milik tutor ini, kelompokkan berdasarkan status
        $orders = Order::with('murid')
            ->where('tutor_id', $user_id)
            ->latest()
            ->get();

        $pesananBaru = $orders->where('status_pesanan', 'menunggu_konfirmasi');
        $pesananBerjalan = $orders->where('status_pesanan', 'berjalan');
        $pesananSelesai = $orders->where('status_pesanan', 'selesai');
        $pesananDibatalkan = $orders->whereIn('status_pesanan', ['dibatalkan', 'komplain']);

        return view('tutor.orders.index', compact(
            'pesananBaru', 'pesananBerjalan', 'pesananSelesai', 'pesananDibatalkan'
        ));
    }

    /**
     * Aksi Tutor Menerima Pesanan & Sistem Kuota
     */
    public function accept($id)
    {
        $order = Order::where('id', $id)->where('tutor_id', Auth::id())->firstOrFail();

        if ($order->status_pesanan !== 'menunggu_konfirmasi') {
            return redirect()->back()->with('error', 'Status pesanan tidak valid.');
        }

        DB::beginTransaction();
        try {
            // 1. Ubah status pesanan jadi berjalan
            $order->update(['status_pesanan' => 'berjalan']);

            // 2. Generate Jurnal/Sesi Otomatis sesuai Jumlah Sesi
            for ($i = 1; $i <= $order->jumlah_sesi; $i++) {
                OrderSession::create([
                    'order_id' => $order->id,
                    'pertemuan_ke' => $i,
                    'tanggal_jadwal' => now()->addDays($i)->format('Y-m-d'), // Penjadwalan sementara
                    'waktu_mulai' => '00:00:00',
                    'status_sesi' => 'dijadwalkan'
                ]);
            }

            // 3. Logika Pemotongan Kuota & Auto-Nonaktif Paket
            $paket = TutorPackage::where('user_id', Auth::id())
                                 ->where('nama_mapel', $order->mata_pelajaran)
                                 ->first();
            
            if ($paket && $paket->kuota > 0) {
                $paket->decrement('kuota'); // Kurangi kuota 1
                
                // Jika setelah dikurangi kuotanya habis (0), sembunyikan paket
                if ($paket->kuota == 0) {
                    $paket->update(['is_active' => false]);
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Pesanan diterima! Kuota kelas Anda telah dikurangi.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menerima pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Aksi Tutor Menolak Pesanan
     */
    public function reject($id)
    {
        $order = Order::where('id', $id)->where('tutor_id', Auth::id())->firstOrFail();
        
        // Tolak pesanan, uang akan di-refund oleh Admin Escrow
        $order->update(['status_pesanan' => 'dibatalkan']);

        // Kuota TIDAK dikurangi karena ditolak
        return redirect()->back()->with('success', 'Pesanan berhasil ditolak.');
    }
}