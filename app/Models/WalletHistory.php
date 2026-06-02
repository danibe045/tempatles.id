<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_id', 
        'type', 
        'amount', 
        'description'
    ];

    // Relasi balik ke dompet utama
    public function wallet()
    {
        return $this->belongsTo(TutorWallet::class, 'wallet_id');
    }
}