<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi ke Tutor yang menarik dana
    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }
}