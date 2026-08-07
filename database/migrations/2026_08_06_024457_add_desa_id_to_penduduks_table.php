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
        Schema::table('penduduks', function (Blueprint $table) {
            // Menambahkan kolom desa_id dan menjadikannya Foreign Key yang terhubung ke tabel desas
            $table->foreignId('desa_id')->nullable()->after('id')->constrained('desas')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            // Menghapus relasi jika fitur di-rollback
            $table->dropForeign(['desa_id']);
            $table->dropColumn('desa_id');
        });
    }
};