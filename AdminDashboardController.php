<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use App\Models\Lamaran;
use App\Models\Pelamar;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $jumlahLowongan = Lowongan::count();
        $jumlahLamaranMasuk = Lamaran::count();
        $jumlahPelamarDiterima = Pelamar::where('status', 'Diterima')->count();

        return view('dashboard', compact(
            'jumlahLowongan',
            'jumlahLamaranMasuk',
            'jumlahPelamarDiterima'
        ));
    }
}
