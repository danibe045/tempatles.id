<?php

namespace App\Http\Controllers;

use App\Models\TutorProfile;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Tangkap input dari form filter
        $search = $request->input('search');
        $mapel = $request->input('mapel');

        // 2. Hitung Statistik (Dihitung dari SELURUH data tanpa filter status)
        // Kita gunakan nama kolom 'status_akun' sesuai database barumu
        $countPending = TutorProfile::where('status_akun', 'pending')->count();
        $countMou     = TutorProfile::where('status_akun', 'menunggu_mou')->count();
        $countAktif   = TutorProfile::where('status_akun', 'aktif')->count();

        // 3. Siapkan query untuk TABEL (Hanya yang BELUM aktif)
        $query = TutorProfile::with('user')
            ->where('status_akun', '!=', 'aktif') // Menghilangkan yang sudah aktif dari tabel
            ->latest();

        // 4. Logika Filter Pencarian (Mencari di tabel relasi User)
        if ($search) {
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // 5. Logika Filter Mata Pelajaran
        if ($mapel) {
            $query->where('bidang', 'like', "%{$mapel}%");
        }

        // 6. Ambil data dengan Pagination
        $tutors = $query->paginate(10)->withQueryString();

        // 7. Kirim variabel ke view
        return view('admin.dashboard', compact(
            'tutors', 
            'search', 
            'mapel', 
            'countPending', 
            'countMou', 
            'countAktif'
        ));
    }

    public function show($id)
    {
        // Kita arahkan ke halaman detail yang profesional tadi
        $tutor = TutorProfile::with('user')->findOrFail($id);
        return view('admin.katalog-tutor.show', compact('tutor')); 
    }
}