<?php

namespace App\Http\Controllers;

use App\Models\TutorProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TutorProfileController extends Controller
{
    /**
     * Menampilkan formulir pendaftaran profil tutor.
     */
    public function create(): View
    {
        return view('tutor.create');
    }

    /**
     * Menyimpan data profil tutor ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi Input sesuai kebutuhan projek tempatles.id
        $request->validate([
            'nama_lengkap'        => 'required|string|max:255',
            'no_wa'               => 'required|string|max:15',
            'tingkat_siswa'       => 'required|array',
            'metode'              => 'required|array',
            'hari'                => 'required|array',
            'jenis_kelamin'       => 'required|in:Laki-laki,Perempuan',
            'setuju_pernyataan'   => 'accepted', // Harus diceklis
        ]);

        // 2. Membuat Profil Tutor
        TutorProfile::create([
            'user_id'             => Auth::id(),
            'nama_lengkap'        => $request->nama_lengkap,
            'jenis_kelamin'       => $request->jenis_kelamin,
            'tempat_lahir'        => $request->tempat_lahir,
            'tanggal_lahir'       => $request->tanggal_lahir,
            'provinsi'            => $request->provinsi,
            'kota'                => $request->kota,
            'no_wa'               => $request->no_wa,
            'email_aktif'         => $request->email_aktif,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'instansi'            => $request->instansi,
            'bidang'              => $request->bidang,
            'pengalaman'          => $request->pengalaman,
            // Simpan data array sebagai JSON
            'tingkat_siswa'       => json_encode($request->tingkat_siswa),
            'metode'              => json_encode($request->metode),
            'hari'                => json_encode($request->hari),
            'jam'                 => $request->jam,
            'area'                => $request->area,
            'setuju_pernyataan'   => $request->has('setuju_pernyataan'),
        ]);

        // 3. Redirect ke Dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Profil tutor berhasil disimpan! Admin akan segera menghubungi Anda.');
    }
}