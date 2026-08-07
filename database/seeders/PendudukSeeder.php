<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penduduk; // Wajib di-import agar Model dikenali

class PendudukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Memerintahkan Factory untuk membuat 20 data penduduk palsu
        Penduduk::factory(20)->create();
    }
}