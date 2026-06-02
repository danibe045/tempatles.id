<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TutorProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class KatalogTutorController extends Controller
{
    /**
     * Menampilkan Katalog Tutor yang sudah Aktif.
     */
    public function index(Request $request)
    {
        $mapel = $request->input('mapel');
        $kota = $request->input('kota');
        $search = $request->input('search');

        // Query fokus pada status_akun 'aktif'
        $query = TutorProfile::with(['user', 'packages'])
                ->where('status_akun', 'aktif');

        // Filter Pencarian Nama atau ID (Tabel users atau id tutor_profiles)
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($qUser) use ($search) {
                    $qUser->where('name', 'like', "%{$search}%");
                })->orWhere('id', 'like', "%{$search}%"); // Jika search adalah angka ID
            });
        }

        // Filter berdasarkan bidang (tabel tutor_profiles) atau nama mapel (tabel packages)
        if ($mapel) {
            $query->where(function($q) use ($mapel) {
                $q->where('bidang', 'like', "%{$mapel}%")
                ->orWhereHas('packages', function($q2) use ($mapel) {
                    $q2->where('nama_mapel', 'like', "%{$mapel}%")->where('is_active', true);
                });
            });
        }
        
        // Filter berdasarkan alamat domisili
        if ($kota) {
            $query->where('alamat_domisili', 'like', "%{$kota}%");
        }

        $tutors = $query->latest()->paginate(12)->withQueryString();

        return view('admin.katalog-tutor.index', compact('tutors'));
    }

    public function show($id)
    {
        $tutor = TutorProfile::with(['user', 'packages'])->findOrFail($id);
        return view('admin.katalog-tutor.show', compact('tutor'));
    }

    public function storeManual(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'bidang' => 'required|string|max:255',
            'status_akun' => 'required|in:aktif,menunggu_mou',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'bidang.required' => 'Bidang wajib diisi.',
            'status_akun.required' => 'Status akun wajib diisi.',
            'status_akun.in' => 'Status akun harus "aktif" atau "menunggu_mou".',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'tutor',
                'phone_number' => $request->phone_number,
            ]);

            TutorProfile::create([
                'user_id' => $user->id,
                'status_akun' => $request->status_akun,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat_domisili' => $request->alamat_domisili,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'instansi' => $request->instansi,
                'bidang' => $request->bidang,
                'pengalaman' => $request->pengalaman,
                'link' => $request->link_gdrive,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Tutor manual berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $tutor = TutorProfile::with('user')->findOrFail($id);
        return view('admin.katalog-tutor.edit', compact('tutor'));
    }

    public function update(Request $request, $id)
    {
        $tutorProfile = TutorProfile::findOrFail($id);
        $user = $tutorProfile->user;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'status_akun' => 'required|in:aktif,menunggu_mou,dibekukan,banned',
        ]);

        DB::beginTransaction();
        try {
            $userData = [
                'name' => $request->name, 
                'email' => $request->email, 
                'phone_number' => $request->phone_number
            ];
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }
            $user->update($userData);

            $tutorProfile->update([
                'status_akun' => $request->status_akun,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat_domisili' => $request->alamat_domisili,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'instansi' => $request->instansi,
                'bidang' => $request->bidang,
                'pengalaman' => $request->pengalaman,
                'link' => $request->link_gdrive,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function destroyPhoto($id)
    {
        // Cari TutorProfile
        $tutor = TutorProfile::findOrFail($id);
        // Akses user yang berelasi
        $user = $tutor->user;

        if ($user && $user->profile_photo_path) {
            // 1. Hapus file fisik dari storage
            \Illuminate\Support\Facades\Storage::disk('public')->delete($user->profile_photo_path);

            // 2. Update kolom di tabel USERS, bukan di TutorProfile
            $user->update(['profile_photo_path' => null]);
        }

        return redirect()->back()->with('success', 'Foto profil berhasil dihapus!');
    }

    public function nonaktifkan($id)
    {
        $tutor = TutorProfile::findOrFail($id);
        // Kita ubah langsung ke 'dibekukan' (sesuai status yang ada di DB Mas Dani)
        $tutor->update(['status_akun' => 'dibekukan']); 
        
        return redirect()->back()->with('success', 'Akun tutor berhasil dinonaktifkan.');
    }
}