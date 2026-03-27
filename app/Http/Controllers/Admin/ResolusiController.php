<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Komplain;
use Illuminate\Http\Request;

class ResolusiController extends Controller
{
    public function index(Request $request)
    {
        // 1. Statistik untuk Gradient Cards
        $countMenunggu = Komplain::where('status', 'menunggu_review')->count();
        $countMediasi = Komplain::where('status', 'sedang_dimediasi')->count();
        $countSelesai = Komplain::whereIn('status', ['selesai_refund', 'selesai_tolak'])->count();

        // 2. Query Data Komplain
        // Bawa relasi pelapor dan order (beserta tutor & murid di dalam order)
        $query = Komplain::with(['pelapor', 'order.tutor', 'order.murid']);

        // Fitur Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Fitur Pencarian (Cari berdasarkan nama pelapor atau jenis komplain)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('jenis_komplain', 'like', "%{$search}%")
                ->orWhereHas('pelapor', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                });
            });
        }

        // 3. Eksekusi Query, urutkan dari yang paling baru
        $komplains = $query->latest()->paginate(10);

        return view('admin.resolusi.index', compact(
            'countMenunggu', 
            'countMediasi', 
            'countSelesai', 
            'komplains'
        ));
    }
}