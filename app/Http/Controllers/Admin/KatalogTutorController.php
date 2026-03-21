<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TutorProfile;
use Illuminate\Http\Request;

class KatalogTutorController extends Controller
{
    /**
     * Menampilkan Katalog Tutor yang sudah Aktif.
     * Sesuai rancangan: Smart Filter (Pencarian Cepat Admin)
     */
    public function index(Request $request)
    {
        // Ambil input filter dari request sesuai rancangan sistem 
        $mapel = $request->input('mapel');
        $kota = $request->input('kota');
        $tingkat = $request->input('tingkat'); // Contoh: SD, SMP, atau SMA
        $metode = $request->input('metode');   // Contoh: Online atau Offline

        // Query dasar: Hanya tutor dengan status 'aktif' sesuai database 
        $query = TutorProfile::with('user')->where('status_akun', 'aktif');

        // Logika Smart Filter Multi-Kriteria 

        // 1. Filter Mata Pelajaran (kolom 'bidang')
        if ($mapel) {
            $query->where('bidang', 'like', "%{$mapel}%");
        }

        // 2. Filter Domisili (kolom 'kota')
        if ($kota) {
            $query->where('kota', 'like', "%{$kota}%");
        }

        // 3. Filter Tingkat Siswa (kolom JSON 'tingkat_siswa') 
        if ($tingkat) {
            $query->whereJsonContains('tingkat_siswa', $tingkat);
        }

        // 4. Filter Metode Belajar (kolom JSON 'metode') 
        if ($metode) {
            $query->whereJsonContains('metode', $metode);
        }

        // Ambil data dengan paginasi agar performa tetap ringan
        $tutors = $query->latest()->paginate(12)->withQueryString();

        return view('admin.katalog-tutor.index', compact('tutors'));
    }

    /**
     * Menampilkan profil mendalam tutor untuk verifikasi manual Admin [cite: 137]
     */
    public function show($id)
    {
        // Mencari tutor berdasarkan ID dan memuat data user-nya
        $tutor = TutorProfile::with('user')->findOrFail($id);

        return view('admin.katalog-tutor.show', compact('tutor'));
    }
}