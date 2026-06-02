<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; // <-- INI YANG TADI LUPA SAYA TAMBAHKAN 🙏

class OrderMuridController extends Controller
{
    // Fitur 1: Upload Bukti Bayar (Tunggu ACC Admin)
    public function bayar(Request $request, $id)
    {
        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg|max:5120'
        ]);

        $order = Order::where('id', $id)->where('murid_id', Auth::id())->firstOrFail();
        
        // Simpan foto bukti bayar ke storage folder 'bukti_bayar_murid'
        $path = $request->file('bukti_bayar')->store('bukti_bayar_murid', 'public');

        // HANYA UPDATE FOTO STRUK, STATUS TETAP MENUNGGU PEMBAYARAN SAMPAI ADMIN ACC
        $order->update([
            'bukti_bayar' => $path
        ]);

        return redirect()->back()->with('success', 'Bukti transfer berhasil diunggah! Mohon tunggu Admin memverifikasi pembayaran Anda maksimal 1x24 jam.');
    }

    // Fitur 2: Murid Selesaikan Kelas & Beri Rating
    public function selesaikan(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:1000'
        ]);

        $order = Order::where('id', $id)->where('murid_id', Auth::id())->firstOrFail();

        DB::beginTransaction();
        try {
            $order->update(['status_pesanan' => 'selesai']);

            Review::create([
                'order_id' => $order->id,
                'tutor_id' => $order->tutor_id,
                'murid_id' => Auth::id(),
                'rating' => $request->rating,
                'komentar' => $request->komentar
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Terima kasih! Kelas selesai dan Ulasan telah dikirim. Dana akan diteruskan ke Tutor.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyelesaikan kelas: ' . $e->getMessage());
        }
    }

    // Fitur 3: Pusat Komplain (Dispute) Murid
    public function komplain(Request $request, $id)
    {
        $request->validate([
            'jenis_komplain' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
            'bukti_komplain' => 'nullable|image|mimes:jpeg,png,jpg|max:5120'
        ]);

        $order = Order::where('id', $id)->where('murid_id', Auth::id())->firstOrFail();

        // Jangan izinkan komplain jika sudah selesai/dibatalkan
        if (in_array($order->status_pesanan, ['selesai', 'dibatalkan'])) {
            return redirect()->back()->with('error', 'Pesanan ini sudah tidak dapat dikomplain.');
        }

        DB::beginTransaction();
        try {
            // Upload bukti foto jika ada
            $path = null;
            if ($request->hasFile('bukti_komplain')) {
                $path = $request->file('bukti_komplain')->store('bukti_komplain', 'public');
            }

            // Masukkan ke tabel Komplain
            \App\Models\Komplain::create([
                'order_id' => $order->id,
                'pelapor_id' => Auth::id(),
                'jenis_komplain' => $request->jenis_komplain,
                'deskripsi' => $request->deskripsi,
                'bukti_path' => $path,
                'status' => 'menunggu_review'
            ]);

            // Ubah status pesanan menjadi komplain agar dana tertahan
            $order->update(['status_pesanan' => 'komplain']);

            DB::commit();
            return redirect()->back()->with('success', 'Komplain berhasil diajukan. Dana ditahan sementara dan Admin akan segera meninjau masalah ini.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengajukan komplain: ' . $e->getMessage());
        }
    }

    public function riwayat()
    {
        $riwayatOrders = Order::with(['tutor.tutorProfile', 'sessions.teachingJournal'])
            ->where('murid_id', Auth::id())
            ->whereIn('status_pesanan', ['selesai', 'dibatalkan', 'komplain'])
            ->latest()
            ->paginate(12); // Membatasi 12 kotak per halaman agar tidak lemot

        return view('user.riwayat-kelas', compact('riwayatOrders'));
    }
}