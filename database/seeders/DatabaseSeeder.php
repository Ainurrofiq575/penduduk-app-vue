<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Desa; // Tambahkan import Model Desa

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Kita masukkan beberapa kelurahan (misalnya area Tegal) sebagai contoh master data
        $desas = ['Mintaragen', 'Panggung', 'Kejambon', 'Randugunting', 'Slerok'];

        foreach ($desas as $desa) {
            Desa::create(['nama_desa' => $desa]);
        }
    }
}