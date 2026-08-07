<?php

namespace App\Http\Requests;

// Mengimpor class dasar FormRequest bawaan Laravel untuk mengaktifkan fitur validasi
use Illuminate\Foundation\Http\FormRequest;

class StorePendudukRequest extends FormRequest
{
    /**
     * Menentukan apakah pengguna diizinkan untuk melakukan request ini.
     */
    public function authorize(): bool
    {
        // Diatur 'true' agar siapa saja bisa mengakses endpoint ini tanpa token/login khusus
        return true;
    }

    /**
     * Mendefinisikan aturan validasi (rules) untuk setiap field data yang masuk.
     */
    public function rules(): array
    {
        return [
            // Wajib diisi dan ID-nya harus ada di tabel desas
            'desa_id' => 'required|exists:desas,id',

            // 1. Field teks wajib: Harus diisi, berupa teks, dan maksimal 255 karakter
            'nama_lengkap' => ['required', 'string', 'max:255'],

            // 2. Field angka minimal: Harus diisi, berupa angka murni, dan nilainya minimal 17
            'usia' => ['required', 'numeric', 'min:17'],

            // 3. Field pilihan (enum/in-array): Harus diisi, dan isinya wajib persis "L" atau "P"
            'jenis_kelamin' => ['required', 'in:L,P'],
        ];
    }
}