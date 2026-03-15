<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorWallet extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'saldo_tertahan', 'saldo_aktif'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}