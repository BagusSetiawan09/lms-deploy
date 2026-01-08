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
        Schema::create('pengumpulans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tugas_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('file_pengumpulan')->nullable();
            $table->enum('status', ['belum', 'terkumpul', 'telat', 'direvisi'])->default('belum');
            $table->timestamps();

            // user hanya bisa kumpul sekali untuk setiap tugas
            $table->unique(['tugas_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumpulans');
    }
};
