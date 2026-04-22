<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TutorPackage extends Model
{
    protected $table = 'tutor_packages';

    protected $fillable = [
        'user_id', 
        'nama_mapel', 
        'jenjang', 
        'jumlah_sesi', 
        'domisili', 
        'metode', 
        'harga_nett',
        'deskripsi',
        'is_active',
        'kuota'
    ];

    // Mengubah nilai is_active menjadi boolean (true/false) secara otomatis
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}