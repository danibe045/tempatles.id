<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class EscrowController extends Controller
{
    public function index(Request $request)
    {
        // 1. Statistik untuk Gradient Cards (Hanya menghitung yang statusnya 'lunas_escrow')
        // Hak Tutor (Total Harga Sesi)
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
            // Default: Tampilkan yang masih nyangkut di Escrow
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
        $escrows = $query->latest()->paginate(10);

        return view('admin.escrow.index', compact(
            'danaTutor', 
            'danaPlatform', 
            'siapCair', 
            'escrows'
        ));
    }
}