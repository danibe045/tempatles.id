<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Silabus; // Panggil model Silabus yang sudah kita buat
use Illuminate\Http\Request;

class SilabusController extends Controller
{
    /**
     * Menampilkan halaman Monitoring Silabus
     */
    public function index(Request $request)
    {
        // 1. Hitung Statistik untuk 3 Kartu di Atas
        $countPending = Silabus::where('status_persetujuan', 'pending')->count();
        $countRevisi = Silabus::where('status_persetujuan', 'revisi')->count();
        $countDisetujui = Silabus::where('status_persetujuan', 'disetujui')->count();

        // 2. Siapkan Query untuk Tabel (Sekalian bawa data Tutor-nya biar efisien)
        $query = Silabus::with('tutor');

        // Fitur Filter Status (Dropdown)
        if ($request->filled('status')) {
            $query->where('status_persetujuan', $request->status);
        }

        // Fitur Pencarian (Search text)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul_kurikulum', 'like', "%{$search}%")
                  ->orWhere('mata_pelajaran', 'like', "%{$search}%")
                  ->orWhereHas('tutor', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // 3. Ambil data terbaru, urutkan dari yang paling baru, batasi 10 per halaman
        $silabusList = $query->latest()->paginate(10);

        // 4. Kirim semua data ke View
        return view('admin.silabus.index', compact(
            'countPending', 
            'countRevisi', 
            'countDisetujui', 
            'silabusList'
        ));
    }

    /**
     * Menampilkan Detail Silabus (Untuk halaman Tinjauan)
     */
    public function show($id)
    {
        $silabus = Silabus::with('tutor')->findOrFail($id);
        
        // Nanti kita buat view ini setelah tabelnya aman
        // return view('admin.silabus.show', compact('silabus'));
        return "Ini halaman review untuk silabus: " . $silabus->judul_kurikulum;
    }
}