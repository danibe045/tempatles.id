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

        // 2. Siapkan query dasar
        $query = TutorProfile::with('user')->latest(); // latest() agar pendaftar baru ada di paling atas

        // 3. Logika Filter Pencarian (Cari di tabel relasi user ATAU di tabel profil)
        if ($search) {
            $query->where(function($q) use ($search) {
                // Asumsi pencarian berdasarkan nama lengkap atau email
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('email_aktif', 'like', "%{$search}%");
                
                // Jika ingin mencari dari tabel user juga:
                // ->orWhereHas('user', function($u) use ($search) {
                //     $u->where('name', 'like', "%{$search}%");
                // });
            });
        }

        // 4. Logika Filter Mata Pelajaran (Dropdown Mapel)
        if ($mapel) {
            $query->where('bidang', $mapel);
        }

        // 5. Hitung Statistik (Wajib query terpisah agar performa super cepat)
        $countPending = TutorProfile::where('status_akun', 'Pending')->count();
        $countMou = TutorProfile::where('status_akun', 'Menunggu MoU')->count();
        $countAktif = TutorProfile::where('status_akun', 'Aktif')->count();

        // 6. Ambil data pakai Pagination (misal 10 per halaman), jangan get() semua
        $tutors = $query->paginate(10)->withQueryString();

        // 7. Kirim semua variabel ke view agar tidak error
        return view('admin.dashboard', compact(
            'tutors', 'search', 'mapel', 'countPending', 'countMou', 'countAktif'
        ));
    }

    public function show($id)
    {
        $tutor = TutorProfile::with('user')->findOrFail($id);
        
        // Pastikan nama file blade-nya sesuai dengan yang akan kita buat
        return view('admin.tutor-detail', compact('tutor')); 
    }
}