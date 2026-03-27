<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komplain extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi ke pesanan yang dipermasalahkan
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi ke user yang melaporkan komplain
    public function pelapor()
    {
        return $this->belongsTo(User::class, 'pelapor_id');
    }
}