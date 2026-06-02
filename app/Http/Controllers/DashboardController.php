<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TutorPackage; 
use App\Models\TutorWallet;
use App\Models\Order;
use App\Models\Review;
use App\Models\OrderSession;
use App\Models\Payout;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'tutor') {
            $totalPaket = TutorPackage::where('user_id', $user->id)->where('is_active', true)->count();
            
            $wallet = TutorWallet::firstOrCreate(['user_id' => $user->id]);
            $saldoCair = $wallet->saldo_aktif;
            
            $danaTertahan = Order::where('tutor_id', $user->id)
                ->where('status_pembayaran', 'lunas_escrow')
                ->sum('total_harga_sesi');
            
            $rating = Review::where('tutor_id', $user->id)->avg('rating') ?? 0;
            $strike = $user->tutorProfile->strike_count ?? 0;

            $pesananBaru = Order::with('murid')
                ->where('tutor_id', $user->id)
                ->where('status_pesanan', 'menunggu_konfirmasi')
                ->get();
            
            $activeOrders = Order::with(['murid', 'sessions.teachingJournal'])
                ->where('tutor_id', $user->id)
                ->where('status_pembayaran', 'lunas_escrow') 
                ->get();

            $jurnalTertunda = OrderSession::with('order.tutor')
                ->whereHas('order', function($q) use ($user) {
                    $q->where('tutor_id', $user->id)->where('status_pesanan', 'berjalan');
                })
                ->whereDoesntHave('teachingJournal')
                ->whereDate('tanggal_jadwal', '<=', now())
                ->get();

            $riwayatPayout = Payout::where('tutor_id', $user->id)->latest()->get();

            return view('tutor.dashboard-tutor', compact(
                'user', 'totalPaket', 'saldoCair', 'danaTertahan', 'rating', 'strike', 
                'pesananBaru', 'activeOrders', 'jurnalTertunda', 'riwayatPayout'
            ));
        }

        if ($user->role === 'murid') {
            // Pastikan bagian murid di DashboardController seperti ini:
            $pesanan_aktif = Order::with('tutor')
                ->where('murid_id', $user->id)
                ->whereIn('status_pesanan', ['menunggu_konfirmasi', 'menunggu_pembayaran'])
                ->get();

            $activeOrdersMurid = Order::with(['tutor.tutorProfile', 'sessions.teachingJournal'])
                ->where('murid_id', $user->id)
                ->where('status_pesanan', 'berjalan') // Hanya yang sudah ACC
                ->get();

            $jadwal_les = OrderSession::with(['order.tutor'])
                ->whereHas('order', function ($query) use ($user) {
                    $query->where('murid_id', $user->id)
                        ->where('status_pesanan', 'berjalan');
                })
                ->where('status_sesi', 'dijadwalkan')
                ->orderBy('tanggal_jadwal', 'asc')
                ->orderBy('waktu_mulai', 'asc')
                ->get()
                ->map(function ($session) {
                    return (object)[
                        'tanggal' => $session->tanggal_jadwal,
                        'jam_mulai' => $session->waktu_mulai,
                        'mapel' => $session->order->mata_pelajaran,
                        'tutor' => $session->order->tutor,
                        'metode' => 'Sesuai Kesepakatan', // KITA UBAH JADI STRING AMAN
                        'link_zoom' => null,
                    ];
                });

            $riwayat_transaksi = Order::with(['tutor.tutorProfile', 'sessions.teachingJournal'])
                ->where('murid_id', $user->id)
                ->whereIn('status_pesanan', ['selesai', 'dibatalkan', 'komplain'])
                ->latest()
                ->take(5)
                ->get();

            return view('user.dashboard-murid', compact(
                'user', 'pesanan_aktif', 'activeOrdersMurid', 'jadwal_les', 'riwayat_transaksi'
            ));
        }

        return abort(403, 'Akses Ditolak: Anda tidak memiliki role yang valid.');
    }
}