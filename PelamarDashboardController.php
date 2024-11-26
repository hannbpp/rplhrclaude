<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Lamaran;

class PelamarDashboardController extends Controller
{
    public function index()
    {
        $pelamar = Auth::user();
        $jumlahLamaranAktif = Lamaran::where('pelamar_id', $pelamar->id)
            ->where('status', 'Aktif')
            ->count();

        return view('pelamar.dashboard', compact(
            'pelamar',
            'jumlahLamaranAktif'
        ));
    }
}
