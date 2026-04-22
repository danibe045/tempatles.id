<?php

namespace App\Http\Controllers;

use App\Models\TutorProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TutorProfileController extends Controller
{
    /**
     * Menampilkan Form Lengkapi Profil (Wizard Step 1 & 2)
     */
    public function create()
    {
        $user = Auth::user();

        // Jika bukan tutor, tendang ke dashboard
        if ($user->role !== 'tutor') {
            return redirect()->route('dashboard');
        }

        // Jika sudah isi profil, tendang ke dashboard (masuk karantina)
        if ($user->tutorProfile) {
            return redirect()->route('dashboard');
        }

        return view('tutor.register-profile', compact('user'));
    }

    /**
     * Menyimpan data profil ke Database
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'phone_number' => 'required|string|max:20',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat_domisili' => 'required|string',
            'pendidikan_terakhir' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
            'bidang' => 'required|string|max:255',
            'pengalaman' => 'required|string',
            'link_silabus' => 'required|url', // GDrive Link
            'setuju_pernyataan' => 'accepted',
        ]);

        $user = Auth::user();

        // 2. Update No HP di tabel users
        User::where('id', $user->id)->update([
            'phone_number' => $request->phone_number
        ]);

        // 3. Simpan Profil ke tabel tutor_profiles
        TutorProfile::create([
            'user_id' => $user->id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat_domisili' => $request->alamat_domisili,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'instansi' => $request->instansi,
            'bidang' => $request->bidang,
            'pengalaman' => $request->pengalaman,
            'link_silabus' => $request->link_silabus,
            
            // Kolom JSON butuh nilai default array kosong []
            'tingkat_siswa' => [], 
            'metode' => [], 
            'hari' => [], 
            
            // Kolom String & Int butuh default value
            'jam' => '-',
            'area' => '-',
            'tarif_per_sesi' => 0,
            
            'setuju_pernyataan' => true,
            'strike_count' => 0,
            'status_akun' => 'pending', // <--- Langsung ubah status jadi pending (Karantina)
        ]);

        return redirect()->route('dashboard');
    }
}