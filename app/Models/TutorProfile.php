<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany; // 👈 1. Tambahkan ini untuk HasMany

class TutorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat_domisili',
        'pendidikan_terakhir',
        'instansi',
        'bidang',
        'pengalaman',
        'tingkat_siswa',
        'metode',
        'hari',
        'jam',
        'area',
        'tarif_per_sesi',
        'link_silabus',
        'setuju_pernyataan',
        'strike_count',
        'status_akun',
    ];

    // Otomatis mengubah JSON dari database menjadi Array di Laravel, dan sebaliknya
    protected $casts = [
        'tingkat_siswa' => 'array',
        'metode' => 'array',
        'hari' => 'array',
        'setuju_pernyataan' => 'boolean',
        'tarif_per_sesi' => 'integer',
        'strike_count' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // 2. 👇 TAMBAHKAN FUNGSI INI UNTUK MENGATASI ERROR 👇
    public function packages(): HasMany
    {
        // PENTING: Ganti 'TutorPackage' dengan nama Model paket harga milik Mas Dani.
        // Jika nama model paketnya adalah 'Package', ubah menjadi Package::class
        return $this->hasMany(TutorPackage::class, 'user_id', 'user_id');
    }
}