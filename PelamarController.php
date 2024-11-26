<?php

namespace App\Http\Controllers;

use App\Models\Pelamar;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PelamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data pelamar dengan relasi lowongan
        $pelamars = Pelamar::with('lowongan')->get();
        return view('pelamar.index', compact('pelamars'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pelamar = Pelamar::with('lowongan')->findOrFail($id);
        return view('pelamar.show', compact('pelamar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pelamar = Pelamar::with('lowongan')->findOrFail($id);
        $lowongans = Lowongan::all();
        return view('pelamar.edit', compact('pelamar', 'lowongans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pelamar = Pelamar::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pelamars,email,' . $id,
            'phone_number' => 'required|string|max:20',
            'birth_date' => 'required|date',
            'lowongan_id' => 'required|exists:lowongans,id',
            'cv_path' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'jadwal_interview' => 'nullable|date',
            'status' => 'required|string|in:Menunggu,Ditolak,Diterima',
        ]);

        if ($request->hasFile('cv_path')) {
            if ($pelamar->cv_path) {
                Storage::disk('public')->delete($pelamar->cv_path);
            }
            $cvPath = $request->file('cv_path')->store('cv', 'public');
            $validated['cv_path'] = $cvPath;
        }

        $pelamar->update($validated);

        return redirect()->route('pelamars.index')
            ->with('success', 'Data pelamar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pelamar = Pelamar::findOrFail($id);

        if ($pelamar->cv_path) {
            Storage::disk('public')->delete($pelamar->cv_path);
        }

        $pelamar->delete();

        return redirect()->route('pelamars.index')
            ->with('success', 'Data pelamar berhasil dihapus.');
    }

    /**
     * Update the interview schedule for a pelamar.
     */
    public function updateSchedule(Request $request, $id)
    {
        $pelamar = Pelamar::findOrFail($id);

        $validated = $request->validate([
            'jadwal_interview' => 'required|date',
            'notes' => 'nullable|string'
        ]);

        $pelamar->update([
            'jadwal_interview' => $validated['jadwal_interview'],
            'notes' => $validated['notes'],
            'status' => 'Menunggu'
        ]);

        return redirect()->route('pelamars.index')
            ->with('success', 'Jadwal interview berhasil diperbarui.');
    }
}
