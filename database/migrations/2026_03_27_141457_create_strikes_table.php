<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('strikes', function (Blueprint $table) {
            $table->id();
            
            // Siapa tutor yang kena SP (Surat Peringatan)?
            $table->foreignId('tutor_id')->constrained('users')->onDelete('cascade');
            
            // Detail Pelanggaran
            $table->string('alasan_pelanggaran'); // Contoh: 'Tutor absen tanpa kabar'
            $table->text('keterangan_detail')->nullable();
            
            // Status Strike
            $table->enum('status', [
                'aktif',   // Masih berlaku dan dihitung
                'dicabut'  // Dibatalkan oleh Admin (misal karena alasan tutor bisa diterima)
            ])->default('aktif');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('strikes');
    }
};