<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('silabus', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel users (karena tutor_id merujuk ke tabel users)
            $table->foreignId('tutor_id')->constrained('users')->cascadeOnDelete();
            $table->string('link_gdrive')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('silabus');
    }
};