<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Desa;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $totalPenduduk = Penduduk::count();
        $totalLaki = Penduduk::where('jenis_kelamin', 'L')->count();
        $totalPerempuan = Penduduk::where('jenis_kelamin', 'P')->count();
        $totalDesa = Desa::count();

        // 5 penduduk terbaru
        $pendudukTerbaru = Penduduk::with('desa')->latest()->limit(5)->get();

        // Data per desa untuk ringkasan
        $perDesa = Desa::withCount('penduduks')->orderByDesc('penduduks_count')->get();

        return Inertia::render('Dashboard', [
            'stats' => [
                'total_penduduk' => $totalPenduduk,
                'total_laki' => $totalLaki,
                'total_perempuan' => $totalPerempuan,
                'total_desa' => $totalDesa,
            ],
            'pendudukTerbaru' => $pendudukTerbaru,
            'perDesa' => $perDesa,
        ]);
    }
}
