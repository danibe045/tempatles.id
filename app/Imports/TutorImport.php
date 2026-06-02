<?php

namespace App\Imports;

use App\Models\User;
use App\Models\TutorProfile; 
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; // Tambahkan ini
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class TutorImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $email = trim($row['email_aktif'] ?? '');

            if (empty($email)) continue;

            // Gunakan Transaction untuk memastikan integritas data per baris
            DB::transaction(function () use ($row, $email) {
                try {
                    // 1. BIKIN AKUN LOGIN
                    $user = User::firstOrCreate(
                        ['email' => $email], 
                        [
                            'name' => $row['nama_lengkap'] ?? 'Tutor Tempatles',
                            'phone_number' => $row['nomor_wa_aktif'] ?? null,
                            'password' => Hash::make('tempatles123'),
                            'role' => 'tutor',
                        ]
                    );

                    // 2. PECAH TEMPAT & TANGGAL LAHIR (Bisa disesuaikan format Excelnya)
                    $ttl_raw = $row['tempat_tanggal_lahir'] ?? '';
                    $ttl_parts = explode(',', $ttl_raw);
                    $tempat_lahir = trim($ttl_parts[0] ?? 'Tidak Diketahui');

                    // 3. ARRAY DARI EXCEL (Tanpa json_encode, biarkan Model Cast yang urus)
                    $tingkat = !empty($row['tingkat_siswa_yang_bisa_diajar']) ? array_map('trim', explode(',', $row['tingkat_siswa_yang_bisa_diajar'])) : [];
                    $metode = !empty($row['metode_mengajar']) ? array_map('trim', explode(',', $row['metode_mengajar'])) : [];
                    $hari_array = !empty($row['hari_yang_tersedia']) ? array_map('trim', explode(',', $row['hari_yang_tersedia'])) : [];

                    // 4. SIMPAN PROFIL
                    TutorProfile::updateOrCreate(
                        ['user_id' => $user->id],
                        [
                            'status_akun' => 'aktif',
                            'jenis_kelamin' => $row['jenis_kelamin'] ?? 'Laki-laki',
                            'tempat_lahir' => $tempat_lahir,
                            'tanggal_lahir' => '2000-01-01', // Sesuaikan dengan kebutuhan
                            'alamat_domisili' => $row['alamat_domisili'] ?? '-',
                            'pendidikan_terakhir' => $row['pendidikan_terakhir'] ?? '-',
                            'instansi' => $row['asal_sekolah_kampus'] ?? '-',
                            'bidang' => $row['bidang_keahlian_mata_pelajaran'] ?? '-',
                            'pengalaman' => $row['jika_ya_jelaskan_pengalaman_mengajar_anda'] ?? '-',
                            'tingkat_siswa' => $tingkat, // Model cast akan mengubah ini ke JSON otomatis
                            'metode' => $metode,
                            'hari' => $hari_array,
                            'jam' => $row['jam_mengajar_yang_diinginkan'] ?? '-',
                            'area' => $row['area_mengajar'] ?? '-',
                        ]
                    );
                } catch (\Exception $e) {
                    // Log error jika baris tertentu gagal diimport
                    Log::error("Gagal import email {$email}: " . $e->getMessage());
                }
            });
        }
    }

    public function chunkSize(): int
    {
        return 50;
    }
}