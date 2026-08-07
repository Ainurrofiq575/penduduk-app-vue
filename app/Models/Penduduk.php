<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penduduk extends Model
{
    use HasFactory;

    // 1. TAMBAHKAN desa_id DI SINI agar Vue bisa menyimpan data desanya
    protected $fillable = [
        'desa_id', // <--- Ini tambahan barunya
        'nama_lengkap',
        'usia',
        'jenis_kelamin',
    ];

    // 2. RELASI: 1 Penduduk berasal/milik dari (belongsTo) 1 Desa
    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }
}