<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Kita paksa pakai nama 'silabus' (tanpa -es)
        Schema::create('silabus', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke Tutor (Tabel users)
            $table->foreignId('tutor_id')->constrained('users')->cascadeOnDelete(); 
            
            // Identitas Utama Kurikulum/Paket Belajar
            $table->string('judul_kurikulum'); 
            $table->string('mata_pelajaran'); 
            $table->string('tingkat_siswa'); 
            
            // Detail Pelaksanaan
            $table->text('deskripsi_singkat'); 
            $table->text('target_pembelajaran'); 
            $table->integer('jumlah_pertemuan'); 
            
            // File PDF (Opsional, kalau tutor mau upload detail)
            $table->string('file_panduan_path')->nullable(); 
            
            // Status Persetujuan Admin (defaultnya 'pending' nunggu di-ACC)
            $table->enum('status_persetujuan', ['pending', 'revisi', 'disetujui', 'ditolak'])->default('pending');
            $table->text('catatan_reviewer')->nullable(); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('silabus');
    }
};