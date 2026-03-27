<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Strike;
use Illuminate\Http\Request;

class StrikeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Statistik untuk Gradient Cards
        $countAktif = Strike::where('status', 'aktif')->count();
        $countDicabut = Strike::where('status', 'dicabut')->count();
        
        // Menghitung berapa banyak tutor unik yang sedang punya strike aktif
        $countTutorBermasalah = Strike::where('status', 'aktif')->distinct('tutor_id')->count('tutor_id');

        // 2. Query Data Strike beserta data Tutornya
        $query = Strike::with('tutor');

        // Fitur Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Fitur Pencarian (Cari berdasarkan nama tutor atau alasan pelanggaran)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('alasan_pelanggaran', 'like', "%{$search}%")
                ->orWhereHas('tutor', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                });
            });
        }

        // 3. Eksekusi Query
        $strikes = $query->latest()->paginate(10);

        return view('admin.strike.index', compact(
            'countAktif', 
            'countDicabut', 
            'countTutorBermasalah', 
            'strikes'
        ));
    }
}