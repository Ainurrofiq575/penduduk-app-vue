<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Desa extends Model
{
    use HasFactory;

    // Izinkan pengisian kolom ini
    protected $fillable = ['nama_desa'];

    // RELASI: 1 Desa punya Banyak (hasMany) Penduduk
    public function penduduks()
    {
        return $this->hasMany(Penduduk::class);
    }
}