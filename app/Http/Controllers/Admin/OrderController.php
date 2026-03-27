<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // 1. Statistik untuk Gradient Cards
        // Hitung pesanan yang butuh perhatian (menunggu konfirmasi/pembayaran)
        $countPending = Order::whereIn('status_pesanan', ['menunggu_konfirmasi', 'menunggu_pembayaran'])->count();
        
        // Hitung pesanan yang kelasnya sedang berjalan
        $countBerjalan = Order::where('status_pesanan', 'berjalan')->count();
        
        // Hitung total dana Escrow (Uang yang sudah dibayar murid tapi belum dicairkan ke tutor)
        $totalEscrow = Order::where('status_pembayaran', 'lunas_escrow')->sum('grand_total');

        // 2. Query Data Order
        $query = Order::with(['murid', 'tutor']);

        // Fitur Filter Status
        if ($request->filled('status')) {
            $query->where('status_pesanan', $request->status);
        }

        // Fitur Pencarian (Cari nama murid, tutor, atau mapel)
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

        return view('admin.orders.index', compact(
            'countPending', 
            'countBerjalan', 
            'totalEscrow', 
            'orders'
        ));
    }
}