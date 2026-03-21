<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Silabus extends Model
{
    use HasFactory;

    // --- KUNCI PERBAIKANNYA DI SINI ---
    // Paksa Laravel pakai nama tabel 'silabus'
    protected $table = 'silabus'; 

    protected $guarded = ['id'];

    public function tutor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }
}