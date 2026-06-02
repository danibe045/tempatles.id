<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payout;
use App\Models\TutorWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    /**
     * Fitur 1: Memindahkan uang dari Escrow (Order) ke Saldo Aktif (Dompet Tutor)
     */
    public function claimEscrow($order_id)
    {
        // Cari pesanan yang sudah lunas dan selesai
        $order = Order::where('id', $order_id)->where('tutor_id', Auth::id())->firstOrFail();

        if ($order->status_pembayaran !== 'lunas_escrow' || $order->status_pesanan !== 'selesai') {
            return redirect()->back()->with('error', 'Dana belum bisa diklaim. Pastikan kelas sudah berstatus Selesai.');
        }

        DB::beginTransaction();
        try {
            // 1. Ubah status uang di Order menjadi 'dicairkan' (artinya sudah dilepas dari escrow)
            $order->update(['status_pembayaran' => 'dicairkan']);

            // 2. Tambahkan uang ke Saldo Aktif Tutor
            $wallet = TutorWallet::firstOrCreate(['user_id' => Auth::id()]);
            $wallet->increment('saldo_aktif', $order->total_harga_sesi);

            // 3. Catat di buku riwayat dompet!
            \App\Models\WalletHistory::create([
                'wallet_id' => $wallet->id,
                'type' => 'in',
                'amount' => $order->total_harga_sesi,
                'description' => 'Klaim Dana dari Kelas Selesai (Pesanan #' . $order->id . ')'
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil! Dana Escrow sebesar Rp ' . number_format($order->total_harga_sesi, 0, ',', '.') . ' telah masuk ke Saldo Aktif Anda.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memproses klaim dana: ' . $e->getMessage());
        }
    }

    /**
     * Fitur 2: Tutor mengajukan penarikan dana ke Rekening Bank (Withdraw/Payout)
     */
    public function requestPayout(Request $request)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:50000',
            'nama_bank' => 'required|string|max:50',
            'nomor_rekening' => 'required|string|max:50',
            'nama_pemilik_rekening' => 'required|string|max:255',
        ]);

        $wallet = TutorWallet::firstOrCreate(['user_id' => Auth::id()]);

        // Cek total penarikan yang sedang antre (pending/diproses) agar tutor tidak "ngakali" narik dobel
        $pendingPayouts = Payout::where('tutor_id', Auth::id())
                                ->whereIn('status', ['pending', 'diproses'])
                                ->sum('nominal');

        $saldoTersedia = $wallet->saldo_aktif - $pendingPayouts;

        if ($saldoTersedia < $request->nominal) {
            return redirect()->back()->with('error', 'Saldo Aktif tidak mencukupi (Mungkin Anda memiliki antrean penarikan yang sedang diproses Admin).');
        }

        // Buat Kode Unik Payout (Contoh: WD-852-171203495)
        $kode = 'WD-' . Auth::id() . '-' . time();

        // Kirim Tiket ke Admin
        Payout::create([
            'kode_pencairan' => $kode,
            'tutor_id' => Auth::id(),
            'nominal' => $request->nominal,
            'nama_bank' => $request->nama_bank,
            'nomor_rekening' => $request->nomor_rekening,
            'nama_pemilik_rekening' => $request->nama_pemilik_rekening,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Permintaan pencairan dana terkirim! Admin akan mentransfer ke rekening Anda maksimal 1x24 jam.');
    }
}