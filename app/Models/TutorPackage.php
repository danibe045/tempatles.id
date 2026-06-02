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
        'hari',
        'jam',
        'harga_nett',
        'deskripsi',
        'is_active',
        'kuota'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'jumlah_sesi' => 'integer',
        'harga_nett' => 'integer',
        'kuota' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}