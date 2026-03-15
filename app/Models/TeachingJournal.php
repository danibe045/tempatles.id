<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachingJournal extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_session_id', 
        'catatan_materi', 
        'foto_bukti_path', 
        'waktu_submit'
    ];

    // Jurnal ini milik sesi pertemuan yang mana?
    public function session()
    {
        return $this->belongsTo(OrderSession::class, 'order_session_id');
    }
}