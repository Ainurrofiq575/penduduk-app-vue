<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migrasi untuk membuat tabel.
     */
    public function up(): void
    {
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id(); // Primary Key otomatis
            $table->string('nama_lengkap'); // Sesuai aturan 'string' di FormRequest
            $table->integer('usia'); // Diubah menjadi integer agar lebih presisi untuk umur
            $table->enum('jenis_kelamin', ['L', 'P']); // Memastikan format mutlak L atau P
            $table->timestamps(); // Otomatis membuat kolom created_at & updated_at
        });
    }

    /**
     * Membatalkan migrasi (menghapus tabel).
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};