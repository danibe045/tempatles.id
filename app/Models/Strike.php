<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Strike extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi ke Tutor (User) yang melakukan pelanggaran
    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }
}