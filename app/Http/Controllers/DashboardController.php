<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Fakultas;
use App\Models\Prodi;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahMahasiswa = Mahasiswa::count();
        $jumlahFakultas = Fakultas::count();
        $jumlahProdi = Prodi::count();

        // contoh statistik tambahan (opsional)
        $mahasiswaPerProdi = Mahasiswa::selectRaw('prodi_id, COUNT(*) as total')
            ->groupBy('prodi_id')
            ->with('prodi')
            ->get();

        return view('dashboard', compact(
            'jumlahMahasiswa',
            'jumlahFakultas',
            'jumlahProdi',
            'mahasiswaPerProdi'
        ));
    }
}
