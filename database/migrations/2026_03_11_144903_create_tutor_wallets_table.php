<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tutor_wallets', function (Blueprint $table) {
            $table->id();
            // Milik siapa dompet ini? (Relasi ke user dengan role tutor)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Saldo Escrow (Uang dari kelas yang sedang berjalan / belum diverifikasi)
            $table->integer('saldo_tertahan')->default(0); 
            
            // Saldo yang sudah dipotong fee platform 10% dan siap ditarik Tutor
            $table->integer('saldo_aktif')->default(0); 
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tutor_wallets');
    }
};