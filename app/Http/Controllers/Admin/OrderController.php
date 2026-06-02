<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // 1. Statistik untuk Gradient Cards
        $countPending = Order::whereIn('status_pesanan', ['menunggu_konfirmasi', 'menunggu_pembayaran'])->count();
        $countBerjalan = Order::where('status_pesanan', 'berjalan')->count();
        $totalEscrow = Order::where('status_pembayaran', 'lunas_escrow')->sum('grand_total');

        // 2. Query Data Order
        $query = Order::with(['murid', 'tutor']);

        if ($request->filled('status')) {
            $query->where('status_pesanan', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('mata_pelajaran', 'like', "%{$search}%")->orWhereHas('murid', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('tutor', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                });
            });
        }

        // 3. Eksekusi Query
        $orders = $query->latest()->paginate(10);

        return view('admin.orders.index', compact('countPending', 'countBerjalan', 'totalEscrow', 'orders'));
    }

    // Tampilkan Detail Pesanan
    public function show($id)
    {
        $order = Order::with(['murid', 'tutor', 'sessions'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // Fitur Intervensi Pembatalan oleh Admin
    // Ganti parameter $id menjadi instance model Order agar sesuai route
    public function cancel(Order $order) // Otomatis ter-bind
    {
        if ($order->status_pesanan === 'selesai' || $order->status_pesanan === 'dibatalkan') {
            return redirect()->back()->with('error', 'Pesanan tidak dapat diintervensi.');
        }

        $order->update(['status_pesanan' => 'dibatalkan']);
        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan.');
    }

    public function verifyPayment(Order $order) // Ganti $id jadi $order
    {
        if ($order->status_pembayaran === 'lunas_escrow') {
            return redirect()->back()->with('error', 'Pembayaran sudah dikonfirmasi.');
        }

        DB::transaction(function () use ($order) {
            $order->update([
                'status_pembayaran' => 'lunas_escrow',
                'status_pesanan' => 'berjalan'
            ]);

            // Generate sesi jika belum ada
            if ($order->sessions()->count() == 0) {
                for ($i = 1; $i <= $order->jumlah_sesi; $i++) {
                    OrderSession::create([
                        'order_id' => $order->id,
                        'pertemuan_ke' => $i,
                        'status_sesi' => 'belum_dijadwalkan'
                    ]);
                }
            }
        });

        return redirect()->back()->with('success', 'Pembayaran diverifikasi!');
    }
    
}