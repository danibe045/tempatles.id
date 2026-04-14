<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'setuju_pernyataan',
        'strike_count',
        'status_akun',
    ];

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

    public function silabus()
    {
        return $this->hasOne(Silabus::class, 'tutor_id', 'user_id');
    }
}