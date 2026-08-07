<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Desa; // TAMBAHAN WAJIB: Memanggil model Desa
use App\Http\Requests\StorePendudukRequest;
use Inertia\Inertia; 
use Inertia\Response; 
use Illuminate\Http\RedirectResponse; 

class PendudukController extends Controller
{
    /**
     * ENDPOINT READ: Menampilkan list data ke layar Vue
     */
    public function index(): Response
    {
        // PERUBAHAN PENTING: Gunakan with('desa') agar Vue bisa menampilkan nama desanya (Eager Loading)
        $penduduks = Penduduk::with('desa')->latest()->get();

        return Inertia::render('Penduduk/Index', [
            'items' => $penduduks 
        ]);
    }

    /**
     * ENDPOINT CREATE FORM: Menampilkan form tambah data
     */
    public function create(): Response
    {
        // Mengambil semua daftar desa untuk dropdown di form Vue
        $desas = Desa::all();

        return Inertia::render('Penduduk/Create', [
            'desas' => $desas
        ]);
    }

    /**
     * ENDPOINT CREATE: Menyimpan data & merefresh tabel tanpa loading
     */
    public function store(StorePendudukRequest $request): RedirectResponse
    {
        // 1. Ambil data yang sudah lolos uji validasi FormRequest
        $validatedData = $request->validated();

        // 2. Simpan permanen ke database
        Penduduk::create($validatedData);

        // 3. Alihkan (redirect) kembali ke halaman index
        return redirect()->route('penduduk.index');
    }

    /**
     * ENDPOINT EDIT FORM: Menampilkan form edit data
     */
    public function edit(Penduduk $penduduk): Response
    {
        // Mengambil semua daftar desa untuk dropdown di form Vue
        $desas = Desa::all();

        return Inertia::render('Penduduk/Edit', [
            'item' => $penduduk,
            'desas' => $desas // Melempar pilihan desa ke halaman Edit
        ]);
    }

    /**
     * ENDPOINT UPDATE: Menyimpan perubahan data ke Database
     */
    public function update(StorePendudukRequest $request, Penduduk $penduduk): RedirectResponse
    {
        // 1. Validasi data baru 
        $validatedData = $request->validated();

        // 2. Update data yang spesifik di database
        $penduduk->update($validatedData);

        // 3. Refresh halaman
        return redirect()->route('penduduk.index');
    }

    /**
     * ENDPOINT DELETE: Menghapus data dari Database
     */
    public function destroy(Penduduk $penduduk): RedirectResponse
    {
        // Hapus data secara permanen
        $penduduk->delete();

        // Refresh halaman
        return redirect()->back();
    }
}