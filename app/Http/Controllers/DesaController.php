<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Http\Requests\StoreDesaRequest; // 1. IMPORT REQUEST-NYA DI SINI
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class DesaController extends Controller
{
    public function index(): Response
    {
        $desas = Desa::latest()->get();
        return Inertia::render('Desa/Index', ['items' => $desas]);
    }

    public function create(): Response
    {
        return Inertia::render('Desa/Create');
    }

    // 2. GANTI 'Request' MENJADI 'StoreDesaRequest'
    public function store(StoreDesaRequest $request): RedirectResponse
    {
        // Karena sudah divalidasi oleh StoreDesaRequest, kita tinggal ambil datanya
        $validatedData = $request->validated();
        
        Desa::create($validatedData);
        
        return redirect()->route('desa.index');
    }

    public function edit(Desa $desa): Response
    {
        return Inertia::render('Desa/Edit', ['item' => $desa]);
    }

    // 3. GANTI JUGA DI FUNGSI UPDATE
    public function update(StoreDesaRequest $request, Desa $desa): RedirectResponse
    {
        $validatedData = $request->validated();
        
        $desa->update($validatedData);
        
        return redirect()->route('desa.index');
    }

    public function destroy(Desa $desa): RedirectResponse
    {
        $desa->delete();
        return redirect()->back();
    }
}