<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel terkait
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('tutor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('murid_id')->constrained('users')->onDelete('cascade');
            
            // Penilaian
            $table->tinyInteger('rating'); // Bintang 1 sampai 5
            $table->text('komentar')->nullable(); // Ulasan singkat
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};