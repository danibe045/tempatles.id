<?php

namespace App\Imports;

use App\Models\User;
use App\Models\TutorProfile; 
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TutorImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $email = $row['email_aktif'] ?? null;

            if (empty($email)) {
                continue;
            }

            DB::beginTransaction();
            try {
                // 1. BIKIN AKUN LOGIN
                $user = User::firstOrCreate(
                    ['email' => trim($email)], 
                    [
                        'name' => $row['nama_lengkap'] ?? 'Tutor Tempatles',
                        'phone_number' => $row['nomor_wa_aktif'] ?? null,
                        'password' => Hash::make('tempatles123'),
                        'role' => 'tutor',
                    ]
                );

                // 2. PECAH TEMPAT & TANGGAL LAHIR
                $ttl_raw = $row['tempat_tanggal_lahir'] ?? '';
                $ttl_parts = explode(',', $ttl_raw);
                $tempat_lahir = trim($ttl_parts[0] ?? 'Tidak Diketahui');
                $tanggal_lahir = '2000-01-01'; // Default karena di Excel digabung

                // 3. UBAH FORMAT PILIHAN GANDA JADI ARRAY JSON
                $tingkat = isset($row['tingkat_siswa_yang_bisa_diajar']) ? array_map('trim', explode(',', $row['tingkat_siswa_yang_bisa_diajar'])) : [];
                $metode = isset($row['metode_mengajar']) ? array_map('trim', explode(',', $row['metode_mengajar'])) : [];
                $hari_array = isset($row['hari_yang_tersedia']) ? array_map('trim', explode(',', $row['hari_yang_tersedia'])) : [];

                // 4. SIMPAN PROFIL TUTOR (Sekarang sudah sinkron dengan Database & Form)
                TutorProfile::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'status_akun' => 'aktif',
                        'jenis_kelamin' => $row['jenis_kelamin'] ?? 'Laki-laki',
                        'tempat_lahir' => $tempat_lahir,
                        'tanggal_lahir' => $tanggal_lahir, 
                        'alamat_domisili' => $row['alamat_domisili'] ?? '-', // Langsung pasang alamatnya!
                        'pendidikan_terakhir' => $row['pendidikan_terakhir'] ?? '-',
                        'instansi' => $row['asal_sekolah_kampus'] ?? '-',
                        'bidang' => $row['bidang_keahlian_mata_pelajaran'] ?? '-',
                        'pengalaman' => $row['jika_ya_jelaskan_pengalaman_mengajar_anda'] ?? '-',
                        'tingkat_siswa' => json_encode($tingkat),
                        'metode' => json_encode($metode),
                        'hari' => json_encode($hari_array),
                        'jam' => $row['jam_mengajar_yang_diinginkan'] ?? '-',
                        'area' => $row['area_mengajar'] ?? '-',
                    ]
                );

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                // Buka komentar di bawah ini jika masih gagal untuk melihat pesan error dari Laravel:
                // dd($e->getMessage()); 
                continue; 
            }
        }
    }
}