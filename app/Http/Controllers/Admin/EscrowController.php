<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\TutorWallet;
use App\Models\WalletHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EscrowController extends Controller
{
    public function index(Request $request)
    {
        // 1. Hitung total dana yang masih di Escrow (status_pembayaran = lunas_escrow)
        $danaTutor = Order::where('status_pembayaran', 'lunas_escrow')->sum('total_harga_sesi');
        
        // Hak Platform Tempatles (Biaya Layanan)
        $danaPlatform = Order::where('status_pembayaran', 'lunas_escrow')->sum('biaya_layanan');
        
        // Tiket order yang kelasnya sudah "selesai" dan uangnya siap dicairkan ke tutor
        $siapCair = Order::where('status_pembayaran', 'lunas_escrow')
                        ->where('status_pesanan', 'selesai')
                        ->count();

        // 2. Query Data Escrow (Ambil order yang sudah dibayar)
        $query = Order::with(['tutor', 'murid'])->whereIn('status_pembayaran', ['lunas_escrow', 'dicairkan']);

        // Fitur Filter Status
        if ($request->filled('status')) {
            if ($request->status == 'siap_cair') {
                $query->where('status_pembayaran', 'lunas_escrow')->where('status_pesanan', 'selesai');
            } else {
                $query->where('status_pembayaran', $request->status);
            }
        } else {
            $query->where('status_pembayaran', 'lunas_escrow');
        }

        // Fitur Pencarian (Cari berdasarkan nama Tutor atau Mapel)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('mata_pelajaran', 'like', "%{$search}%")
                ->orWhereHas('tutor', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                });
            });
        }

        // 3. Eksekusi Query
        $escrows = $query->latest()->paginate(10)->withQueryString();;

        return view('admin.escrow.index', compact(
            'danaTutor', 
            'danaPlatform', 
            'siapCair', 
            'escrows'
        ));
    }

    // Fungsi untuk Admin Melihat Detail Transaksi Escrow
    public function show($id)
    {
        $order = Order::with(['tutor', 'murid', 'sessions'])->findOrFail($id);
        return view('admin.escrow.show', compact('order'));
    }

    /**
     * FUNGSI SAKTI: Release Dana ke Wallet Tutor
     */
    public function release($id)
    {
        $order = Order::findOrFail($id);

        // Validasi: Pastikan kelas sudah selesai dan uang masih ada di Escrow
        if ($order->status_pesanan !== 'selesai' || $order->status_pembayaran !== 'lunas_escrow') {
            return redirect()->back()->with('error', 'Dana belum bisa dicairkan. Pastikan kelas sudah berstatus Selesai.');
        }

        DB::beginTransaction();
        try {
            // 1. Ubah status pembayaran di pesanan menjadi "dicairkan"
            $order->update([
                'status_pembayaran' => 'dicairkan'
            ]);

            // 2. Cari atau buatkan Dompet (Wallet) untuk Tutor ini
            $wallet = TutorWallet::firstOrCreate(
                ['user_id' => $order->tutor_id],
                ['saldo_tertahan' => 0, 'saldo_aktif' => 0]
            );

            // 3. Masukkan uang hak tutor (90%) ke Saldo Aktif dompetnya
            $wallet->increment('saldo_aktif', $order->total_harga_sesi);

            // 4. Catat di buku riwayat dompet!
            \App\Models\WalletHistory::create([
                'wallet_id' => $wallet->id,
                'type' => 'in',
                'amount' => $order->total_harga_sesi,
                'description' => 'Pencairan Dana dari Pesanan #' . $order->id
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil! Dana sebesar Rp ' . number_format($order->total_harga_sesi, 0, ',', '.') . ' telah masuk ke Dompet Tutor.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }
}