<?php

namespace App\Http\Controllers;

use App\Models\TutorProfile;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status'); 

        // Hitung Statistik (Tetap butuh untuk card di atas)
        $countMou   = TutorProfile::where('status_akun', 'menunggu_mou')->count();
        $countAktif = TutorProfile::where('status_akun', 'aktif')->count();

        // TABEL: HANYA TAMPILKAN YANG BELUM AKTIF (Antrean Tugas Admin)
        $query = TutorProfile::with('user')
                ->where('status_akun', '!=', 'aktif') 
                ->latest();

        if ($status) {
            $query->where('status_akun', $status);
        }

        if ($search) {
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $tutors = $query->get();

        return view('admin.dashboard', compact(
            'tutors', 
            'search', 
            'status',
            'countMou', 
            'countAktif'
        ));
    }

    public function show($id)
    {
        $tutor = TutorProfile::with('user')->findOrFail($id);
        return view('admin.katalog-tutor.show', compact('tutor')); 
    }

    // Fungsi sakti untuk Admin merubah status kemitraan Tutor
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_akun' => 'required|in:aktif,dibekukan,banned,menunggu_mou'
        ]);

        $tutor = TutorProfile::findOrFail($id);
        
        $tutor->update([
            'status_akun' => $request->status_akun
        ]);

        // Pesan sukses yang dinamis
        if ($request->status_akun == 'aktif') {
            $pesan = 'Selamat! Tutor berhasil disetujui dan sekarang berstatus Aktif.';
        } elseif ($request->status_akun == 'banned') {
            $pesan = 'Pendaftaran tutor ditolak / diblokir.';
        } else {
            $pesan = 'Status tutor berhasil diubah menjadi ' . str_replace('_', ' ', $request->status_akun);
        }

        return redirect()->back()->with('success', $pesan);
    }

    // Fungsi untuk menghapus pendaftar yang tidak memenuhi syarat
    public function destroyTutor($id)
    {
        $tutor = TutorProfile::findOrFail($id);
        $user = $tutor->user;

        // Kita hapus User-nya. Karena di database sudah pakai "onDelete cascade", 
        // maka profil tutor dan semua file terkaitnya akan otomatis ikut terhapus bersih.
        if ($user) {
            $user->delete(); 
        } else {
            $tutor->delete();
        }

        return redirect()->back()->with('success', 'Data pendaftar berhasil dihapus permanen dari sistem.');
    }
}