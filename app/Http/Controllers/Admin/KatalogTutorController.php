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

        $query = TutorProfile::with('user')->where('status_akun', 'aktif');

        // Filter berdasarkan bidang/mata pelajaran
        if ($mapel) {
            $query->where('bidang', 'like', "%{$mapel}%");
        }
        
        // Filter domisili (sesuai nama kolom di DB yang baru)
        if ($kota) {
            $query->where('alamat_domisili', 'like', "%{$kota}%");
        }
        
        // Filter array/JSON menggunakan whereJsonContains
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
        $tutor = TutorProfile::with('user')->findOrFail($id);
        return view('admin.katalog-tutor.show', compact('tutor'));
    }

    /**
     * MENYIMPAN DATA TUTOR DARI FORM MANUAL
     */
    public function storeManual(Request $request)
    {
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
                
                // Masukkan sebagai Array, karena di Model sudah di-$casts jadi 'array'
                'tingkat_siswa' => $tingkat_array,
                'metode' => $metode_array,
                'hari' => $hari_array,
                
                'jam' => $request->jam ?? '-',
                'area' => $request->area ?? '-',
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Tutor manual berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan data manual: ' . $e->getMessage());
        }
    }

    /**
     * MENAMPILKAN FORM EDIT TUTOR (FUNGSI BARU)
     */
    public function edit($id)
    {
        $tutor = TutorProfile::with('user')->findOrFail($id);
        return view('admin.katalog-tutor.edit', compact('tutor'));
    }

    /**
     * MENYIMPAN PERUBAHAN DATA TUTOR KE DATABASE (FUNGSI BARU)
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $tutorProfile = TutorProfile::findOrFail($id);
            $user = $tutorProfile->user;

            // 1. Update Akun User
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
            ]);

            // Jika password diisi di form edit, berarti admin mereset password tutor
            if ($request->filled('password')) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            // 2. Format Array (Kembalikan string ber-koma jadi Array)
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
            ]);

            DB::commit();
            return redirect()->route('admin.tutor.detail', $id)->with('success', 'Data profil tutor berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }
}