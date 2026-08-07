<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PendudukFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Membuat nama palsu secara acak
            'nama_lengkap' => fake()->name(),
            
            // Mengacak angka usia antara 17 sampai 80 tahun
            'usia' => fake()->numberBetween(17, 80),
            
            // Mengacak pilihan jenis kelamin (L atau P)
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
        ];
    }
}