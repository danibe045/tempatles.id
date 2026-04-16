<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tutor_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('nama_mapel');
            $table->enum('jenjang', ['SD', 'SMP', 'SMA', 'Umum']);
            $table->integer('jumlah_sesi');
            $table->string('domisili');
            $table->enum('metode', ['Online', 'Offline']);
            $table->integer('harga_nett');
            $table->text('deskripsi'); // Penjelasan paket untuk narik minat murid
            $table->boolean('is_active')->default(true); // Toggle On/Off paket
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tutor_packages');
    }
};