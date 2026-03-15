<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 
        'tutor_id', 
        'murid_id', 
        'rating', 
        'komentar'
    ];

    // Ulasan ini dari order/pesanan yang mana?
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Siapa murid yang kasih ulasan?
    public function murid()
    {
        return $this->belongsTo(User::class, 'murid_id');
    }

    // Siapa tutor yang diulas?
    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }
}