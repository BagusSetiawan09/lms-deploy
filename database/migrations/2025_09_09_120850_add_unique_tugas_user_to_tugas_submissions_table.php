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
        Schema::table('tugas_submissions', function (Blueprint $table) {
            $table->unique(['tugas_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tugas_submissions', function (Blueprint $table) {
             $table->dropUnique(['tugas_submissions_tugas_id_user_id_unique']);
        });
    }
};
