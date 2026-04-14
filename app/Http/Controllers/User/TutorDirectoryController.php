<?php

namespace App\Http\Controllers\User; // <-- 1. Berubah jadi User

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TutorProfile;

class TutorDirectoryController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data tutor yang AKTIF
        $query = TutorProfile::with('user')->where('status_akun', 'aktif');

        // Filter Pencarian: Mata Pelajaran
        if ($request->filled('mapel')) {
            $query->where('bidang', 'like', '%' . $request->mapel . '%');
        }

        // Filter Pencarian: Kota / Area
        if ($request->filled('lokasi')) {
            $query->where('area', 'like', '%' . $request->lokasi . '%')
                ->orWhere('alamat_domisili', 'like', '%' . $request->lokasi . '%');
        }

        // Pagination
        $tutors = $query->latest()->paginate(12);

        // 2. Berubah jadi folder 'user'
        return view('user.tutor-directory', compact('tutors')); 
    }
}