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
        Schema::create('tutor_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_mapel');
            $table->enum('jenjang', ['SD', 'SMP', 'SMA', 'Umum']);
            $table->integer('jumlah_sesi');
            $table->string('domisili');
            $table->enum('metode', ['Online', 'Offline']);
            $table->integer('harga_nett');
            $table->text('deskripsi');
            
            // INI TAMBAHAN KOLOM KUOTANYA!
            $table->integer('kuota')->default(10);
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutor_packages');
    }
};