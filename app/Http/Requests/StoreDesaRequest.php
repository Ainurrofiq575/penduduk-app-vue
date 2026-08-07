<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDesaRequest extends FormRequest
{
    /**
     * Tentukan apakah user diizinkan melakukan request ini.
     */
    public function authorize(): bool
    {
        // Ubah menjadi true agar semua user bisa menyimpan data
        return true; 
    }

    /**
     * Aturan validasi untuk form Desa.
     */
    public function rules(): array
    {
        return [
            'nama_desa' => 'required|string|max:255'
        ];
    }
}