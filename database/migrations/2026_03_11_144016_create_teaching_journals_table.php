<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teaching_journals', function (Blueprint $table) {
            $table->id();
            
            // Mengaitkan jurnal ini dengan sesi pertemuan ke berapa
            $table->foreignId('order_session_id')->constrained('order_sessions')->onDelete('cascade');
            
            // Isi laporan Tutor
            $table->text('catatan_materi');
            $table->string('foto_bukti_path'); // Lokasi file foto disimpan di server
            
            // Kolom ini yang akan diincar oleh Cron Job untuk menghitung keterlambatan 24 jam
            $table->timestamp('waktu_submit')->useCurrent(); 
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teaching_journals');
    }
};