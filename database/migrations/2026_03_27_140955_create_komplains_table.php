<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('komplains', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke Order yang bermasalah
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            
            // Siapa yang lapor? (Bisa Murid, bisa Tutor)
            $table->foreignId('pelapor_id')->constrained('users')->onDelete('cascade'); 
            
            // Detail Komplain
            $table->string('jenis_komplain'); // Contoh: 'Tutor Tidak Hadir', 'Sikap Kurang Baik', dll
            $table->text('deskripsi');
            $table->string('bukti_path')->nullable(); // Foto/Screenshot bukti dari pelapor
            
            // Status Investigasi Admin
            $table->enum('status', [
                'menunggu_review', 
                'sedang_dimediasi', 
                'selesai_refund',  // Admin memutuskan uang dikembalikan ke murid
                'selesai_tolak'    // Admin menolak komplain, uang diteruskan ke tutor
            ])->default('menunggu_review');
            
            // Catatan Keputusan dari Admin
            $table->text('keputusan_admin')->nullable(); 

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komplains');
    }
};