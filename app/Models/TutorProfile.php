<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'link',
        'is_manual',
        'setuju_pernyataan',
        'strike_count',
        'status_akun',
    ];

    // Otomatis mengubah tipe data saat ditarik dari database
    protected $casts = [
        'setuju_pernyataan' => 'boolean',
        'is_manual' => 'boolean',
        'strike_count' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function packages(): HasMany
    {
        return $this->hasMany(TutorPackage::class, 'user_id', 'user_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'tutor_id', 'user_id');
    }

}