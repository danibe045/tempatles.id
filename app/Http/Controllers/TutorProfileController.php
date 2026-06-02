<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\TutorProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TutorProfileController extends Controller
{
    /**
     * Menampilkan Form Lengkapi Profil (Wizard Step 1 & 2)
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->role !== 'tutor') {
            return redirect()->route('dashboard');
        }

        if ($user->tutorProfile) {
            return redirect()->route('dashboard');
        }

        return view('tutor.register-profile', compact('user'));
    }

    /**
     * Menyimpan data profil Awal ke Database
     */
    public function store(Request $request)
    {
        // 1. Ubah validasi link_silabus menjadi link
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
            'link' => 'required|url',
            'setuju_pernyataan' => 'accepted',
        ]);

        $user = Auth::user();

        User::where('id', $user->id)->update([
            'phone_number' => $request->phone_number
        ]);

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
            'link' => $request->link,
            'setuju_pernyataan' => true,
            'strike_count' => 0,
            'status_akun' => 'menunggu_mou', 
        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Menampilkan Halaman Edit Profil di Dashboard Tutor
     */
    public function edit()
    {
        $user = Auth::user();
        $user->load('tutorProfile'); 
        return view('tutor.profile.edit', compact('user'));
    }

    /**
     * Menyimpan Pembaruan Profil dari Dashboard Tutor
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'        => 'required|string|max:255',
            'no_wa'       => 'required|numeric',
            'bidang'      => 'required|string|max:255',
            'pendidikan'  => 'required|string',
            'universitas' => 'required|string|max:255',
            'bio'         => 'required|string',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        // Proses Upload Foto (DISIMPAN KE TABEL USERS BUKAN TUTOR_PROFILE)
        if ($request->hasFile('foto')) {
            if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            $path = $request->file('foto')->store('profile-photos', 'public');
            $user->profile_photo_path = $path;
        }

        $user->name = $request->name;
        $user->phone_number = $request->no_wa;
        $user->save();

        // Update sisanya ke tabel profil
        $user->tutorProfile()->update([
            'bidang'              => $request->bidang,
            'pendidikan_terakhir' => $request->pendidikan,
            'instansi'            => $request->universitas,
            'pengalaman'          => $request->bio,
        ]);

        return redirect()->route('tutor.profile.edit')->with('success', 'Profil Anda berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'], 
            'password' => ['required', 'confirmed', Password::defaults()], 
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password akun Anda berhasil diperbarui!');
    }
}