<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 
        'pertemuan_ke', 
        'tanggal_jadwal', 
        'waktu_mulai', 
        'waktu_selesai', 
        'status_sesi'
    ];

    // Relasi balik ke Order induk
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Setiap sesi bisa punya satu Jurnal Mengajar
    public function teachingJournal()
    {
        return $this->hasOne(TeachingJournal::class);
    }
}