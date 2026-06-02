<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderTutorController extends Controller
{
    /**
     * Menampilkan Dasbor Manajemen Pesanan Tutor
     */
    public function index()
    {
        $tutorId = Auth::id();

        // 1. Pesanan Baru (Menunggu Konfirmasi)
        $pesananBaru = Order::with('murid')
            ->where('tutor_id', $tutorId)
            ->where('status_pesanan', 'menunggu_konfirmasi')
            ->latest()
            ->get();

        // 2. Pesanan Berjalan (Sudah di-ACC atau Sedang aktif)
        $pesananBerjalan = Order::with('murid')
            ->where('tutor_id', $tutorId)
            ->whereIn('status_pesanan', ['menunggu_pembayaran', 'berjalan'])
            ->latest()
            ->get();

        // 3. Pesanan Selesai
        $pesananSelesai = Order::with('murid')
            ->where('tutor_id', $tutorId)
            ->where('status_pesanan', 'selesai')
            ->latest()
            ->get();

        // 4. Pesanan Dibatalkan / Komplain
        $pesananDibatalkan = Order::with('murid')
            ->where('tutor_id', $tutorId)
            ->whereIn('status_pesanan', ['dibatalkan', 'komplain'])
            ->latest()
            ->get();

        return view('tutor.orders.index', compact(
            'pesananBaru', 
            'pesananBerjalan', 
            'pesananSelesai', 
            'pesananDibatalkan'
        ));
    }

    /**
     * Fitur Tutor Menerima Pesanan (ACC)
     */
    public function accept($id)
    {
        // Pastikan pesanan ini benar milik tutor yang sedang login
        $order = Order::where('id', $id)->where('tutor_id', Auth::id())->firstOrFail();
        
        if($order->status_pesanan !== 'menunggu_konfirmasi'){
            return redirect()->back()->with('error', 'Status pesanan tidak valid untuk diterima.');
        }

        // Ubah status jadi menunggu murid transfer uang
        $order->update([
            'status_pesanan' => 'menunggu_pembayaran'
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil diterima! Sekarang kita tunggu murid melakukan pembayaran.');
    }

    /**
     * Fitur Tutor Menolak Pesanan
     */
    public function reject($id)
    {
        // Pastikan pesanan ini benar milik tutor yang sedang login
        $order = Order::where('id', $id)->where('tutor_id', Auth::id())->firstOrFail();
        
        if($order->status_pesanan !== 'menunggu_konfirmasi'){
            return redirect()->back()->with('error', 'Status pesanan tidak valid untuk ditolak.');
        }

        // Ubah status langsung jadi batal
        $order->update([
            'status_pesanan' => 'dibatalkan'
        ]);

        return redirect()->back()->with('success', 'Pesanan telah ditolak dan dibatalkan.');
    }

    public function aturJadwal(Request $request) // Hapus , $id dari parameter ini
    {
        // 1. Validasi inputan diperketat
        $request->validate([
            'order_session_id' => 'required|exists:order_sessions,id',
            'tanggal_jadwal' => 'required|date|after_or_equal:today',
            'waktu_mulai' => 'required'
        ], [
            'tanggal_jadwal.required' => 'Tanggal wajib diisi!',
            'tanggal_jadwal.after_or_equal' => 'Tanggal tidak boleh hari yang sudah lewat!',
            'waktu_mulai.required' => 'Jam mulai wajib diisi!'
        ]);

        // 2. Cari sesi berdasarkan input-jadwal-session-id dari modal
        $session = \App\Models\OrderSession::with('order')->findOrFail($request->order_session_id);

        // PENGAMAN MUTLAK: Pastikan tutor yang login adalah pemilik kelas ini
        if (!$session->order || $session->order->tutor_id !== auth()->id()) {
            abort(403, 'Akses Ditolak! Anda tidak berhak mengubah jadwal kelas ini.');
        }

        // 3. Update data tanggal dan jam mengajar
        $session->update([
            'tanggal_jadwal' => $request->tanggal_jadwal,
            'jam_mulai'      => $request->waktu_mulai, 
        ]);

        // 4. Kembalikan ke halaman sebelumnya dengan flash session sukses untuk memicu SweetAlert2
        return back()->with('success', 'Jadwal sesi berhasil ditetapkan! Murid sekarang bisa melihatnya di dashboard mereka.');
    }

}