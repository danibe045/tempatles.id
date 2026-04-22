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
        $tingkat = $request->input('tingkat');
        $metode = $request->input('metode'); 

        // PERBAIKAN: Hapus 'silabus' dari dalam with() karena link GDrive sudah menyatu di TutorProfile
        $query = TutorProfile::with('user')->where('status_akun', 'aktif');

        if ($mapel) {
            $query->where('bidang', 'like', "%{$mapel}%");
        }
        
        if ($kota) {
            $query->where('alamat_domisili', 'like', "%{$kota}%");
        }
        
        if ($tingkat) {
            $query->whereJsonContains('tingkat_siswa', $tingkat);
        }
        if ($metode) {
            $query->whereJsonContains('metode', $metode);
        }

        $tutors = $query->latest()->paginate(12)->withQueryString();

        return view('admin.katalog-tutor.index', compact('tutors'));
    }

    /**
     * Menampilkan profil mendalam tutor
     */
    public function show($id)
    {
        // PERBAIKAN: Hapus 'silabus' dari relasi
        $tutor = TutorProfile::with('user')->findOrFail($id);
        return view('admin.katalog-tutor.show', compact('tutor'));
    }

    /**
     * MENYIMPAN DATA TUTOR DARI FORM MANUAL OLEH ADMIN
     */
    public function storeManual(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone_number' => 'nullable|string|max:20',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'status_akun' => 'required|in:pending,aktif',
            'link_gdrive' => 'nullable|url',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Pola Email sudah terdaftar. Silakan gunakan email lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'phone_number.max' => 'Nomor telepon terlalu panjang.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'link_gdrive.url' => 'Link GDrive tidak valid. Pastikan format URL benar.',
        ]);

        DB::beginTransaction();
        try {
            // 1. Buat Akun User
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'tutor',
                'phone_number' => $request->phone_number,
            ]);

            // 2. Format Array (Pecah string berdasarkan koma dari form manual)
            $tingkat_array = $request->tingkat_siswa ? array_map('trim', explode(',', $request->tingkat_siswa)) : [];
            $metode_array = $request->metode ? array_map('trim', explode(',', $request->metode)) : [];
            $hari_array = $request->hari ? array_map('trim', explode(',', $request->hari)) : [];

            // 3. Buat Profil Tutor
            TutorProfile::create([
                'user_id' => $user->id,
                'status_akun' => $request->status_akun ?? 'pending',
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat_domisili' => $request->alamat_domisili,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'instansi' => $request->instansi,
                'bidang' => $request->bidang,
                'pengalaman' => $request->pengalaman,
                
                'tingkat_siswa' => $tingkat_array,
                'metode' => $metode_array,
                'hari' => $hari_array,
                
                'jam' => $request->jam ?? '-',
                'area' => $request->area ?? '-',
                
                // PERBAIKAN: Link GDrive langsung disimpan di sini
                'link_silabus' => $request->link_gdrive, 
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Tutor manual berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan data manual: ' . $e->getMessage());
        }
    }

    /**
     * MENAMPILKAN FORM EDIT TUTOR 
     */
    public function edit($id)
    {
        // PERBAIKAN: Hapus 'silabus' dari relasi
        $tutor = TutorProfile::with('user')->findOrFail($id);
        return view('admin.katalog-tutor.edit', compact('tutor'));
    }

    /**
     * MENYIMPAN PERUBAHAN DATA TUTOR KE DATABASE 
     */
    public function update(Request $request, $id)
    {
        $tutorProfile = TutorProfile::findOrFail($id);
        $user = $tutorProfile->user;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'status_akun' => 'required|in:pending,aktif',
            'link_gdrive' => 'nullable|url',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Pola Email sudah terdaftar. Silakan gunakan email lain.',
            'phone_number.max' => 'Nomor telepon terlalu panjang.',
            'link_gdrive.url' => 'Link GDrive tidak valid. Pastikan format URL benar.',
        ]);

        DB::beginTransaction();
        try {
            // 1. Update Akun User
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
            ]);

            if ($request->filled('password')) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            // 2. Format Array 
            $tingkat_array = $request->tingkat_siswa ? array_map('trim', explode(',', $request->tingkat_siswa)) : [];
            $metode_array = $request->metode ? array_map('trim', explode(',', $request->metode)) : [];
            $hari_array = $request->hari ? array_map('trim', explode(',', $request->hari)) : [];

            // 3. Update Profil Tutor
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
                'tingkat_siswa' => $tingkat_array,
                'metode' => $metode_array,
                'hari' => $hari_array,
                'jam' => $request->jam ?? '-',
                'area' => $request->area ?? '-',
                
                // PERBAIKAN: Link GDrive langsung diupdate di sini
                'link_silabus' => $request->link_gdrive, 
            ]);

            DB::commit();
            return redirect()->route('admin.tutor.detail', $id)->with('success', 'Data profil tutor berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }
}