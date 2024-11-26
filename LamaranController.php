<?php

namespace App\Http\Controllers;

use App\Models\Lamaran;
use App\Models\Lowongan;
use Illuminate\Http\Request;

class LamaranController extends Controller
{
    // Menampilkan daftar lamaran
    public function index()
    {
        $lamarans = Lamaran::with(['user', 'lowongan'])->get(); // Include user dan lowongan
        return view('lamaran.index', compact('lamarans'));
    }

    // Menampilkan form tambah lamaran
    public function create()
    {
        $lowongans = Lowongan::all();
        return view('lamaran.create', compact('lowongans'));
    }

    // Menyimpan data lamaran baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'job_id' => 'required|exists:lowongans,id',
        ]);

        Lamaran::create($request->all());

        return redirect()->route('lamaran.index')->with('success', 'Lamaran berhasil ditambahkan.');
    }

    // Menghapus data lamaran
    public function destroy($id)
    {
        $lamaran = Lamaran::findOrFail($id);
        $lamaran->delete();

        return redirect()->route('lamaran.index')->with('success', 'Lamaran berhasil dihapus.');
    }
}
