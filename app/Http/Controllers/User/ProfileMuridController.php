<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileMuridController extends Controller
{
    /**
     * Memperbarui data profil dan password murid dari Modal Dashboard
     */
    public function update(Request $request)
    {
        // 1. Validasi Inputan Dasar
        $request->validate([
            'name'         => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'sekolah'      => 'nullable|string|max:255',
            'foto_profil'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = auth()->user();

        // 2. LOGIKA KEAMANAN (GANTI PASSWORD) 🔒
        // Cek apakah user mengisi kolom password_lama atau password_baru
        if ($request->filled('password_lama') || $request->filled('password_baru')) {
            $request->validate([
                'password_lama' => 'required|string',
                'password_baru' => 'required|string|min:8|confirmed', // wajib ada password_baru_confirmation
            ], [
                'password_baru.min'       => 'Password baru minimal harus 8 karakter.',
                'password_baru.confirmed' => 'Konfirmasi password baru tidak cocok.',
            ]);

            // Verifikasi apakah password lama yang diinput cocok dengan di database
            if (!Hash::check($request->password_lama, $user->password)) {
                return back()->with('error', 'Password lama yang kamu masukkan salah.');
            }

            // Update password user dengan enkripsi baru
            $user->password = Hash::make($request->password_baru);
        }

        // 3. Update Data Teks
        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->sekolah = $request->sekolah;

        // 4. Proses Upload Foto Baru
        if ($request->hasFile('foto_profil')) {
            if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            $path = $request->file('foto_profil')->store('profile-photos', 'public');
            $user->profile_photo_path = $path;
        }

        $user->save();

        return back()->with('success', 'Profil dan pengaturan keamanan berhasil diperbarui!');
    }

    /**
     * Menghapus file foto wajah dari storage dan mereset kolom ke NULL.
     */
    public function destroyPhoto()
    {
        $user = auth()->user();

        if ($user->profile_photo_path) {
            if (Storage::disk('public')->exists($user->profile_photo_path)) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            $user->profile_photo_path = null;
            $user->save();

            return back()->with('success', 'Foto profil berhasil dihapus.');
        }

        return back()->with('error', 'Kamu belum memiliki foto profil.');
    }
}