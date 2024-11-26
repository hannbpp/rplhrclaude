<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class LowonganController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        try {
            $query = Lowongan::query();

            // Search functionality
            if ($request->has('search')) {
                $search = $request->get('search');
                $query->where(function ($q) use ($search) {
                    $q->where('posisi', 'LIKE', "%{$search}%")
                        ->orWhere('location', 'LIKE', "%{$search}%")
                        ->orWhere('description', 'LIKE', "%{$search}%");
                });
            }

            // Filter by status
            if ($request->has('status')) {
                $query->where('status', $request->status);
            }

            // Sorting
            $sortBy = $request->get('sort_by', 'created_at');
            $sortOrder = $request->get('sort_order', 'desc');
            $query->orderBy($sortBy, $sortOrder);

            // Pagination
            $lowongans = $query->paginate(10);

            return view('lowongan.index', compact('lowongans'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memuat data: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('lowongan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'posisi' => 'required|string|max:255',
                'description' => 'required|string|min:50',
                'requirements' => 'required|string|min:50',
                'location' => 'required|string|max:255',
                'salary' => 'required|numeric|min:0',
                'status' => ['required', Rule::in(['Aktif', 'Tutup'])],
            ], [
                'posisi.required' => 'Posisi wajib diisi',
                'description.required' => 'Deskripsi wajib diisi',
                'description.min' => 'Deskripsi minimal 50 karakter',
                'requirements.required' => 'Persyaratan wajib diisi',
                'requirements.min' => 'Persyaratan minimal 50 karakter',
                'location.required' => 'Lokasi wajib diisi',
                'salary.required' => 'Gaji wajib diisi',
                'salary.numeric' => 'Gaji harus berupa angka',
                'salary.min' => 'Gaji tidak boleh kurang dari 0',
                'status.required' => 'Status wajib diisi',
                'status.in' => 'Status harus Aktif atau Tutup',
            ]);

            DB::beginTransaction();

            $lowongan = Lowongan::create($validated);

            DB::commit();

            return redirect()
                ->route('lowongans.index')
                ->with('success', 'Lowongan berhasil ditambahkan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            $lowongan = Lowongan::findOrFail($id);
            return view('lowongan.edit', compact('lowongan'));
        } catch (\Exception $e) {
            return redirect()
                ->route('lowongans.index')
                ->with('error', 'Lowongan tidak ditemukan.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $lowongan = Lowongan::findOrFail($id);

            $validated = $request->validate([
                'posisi' => 'required|string|max:255',
                'description' => 'required|string|min:50',
                'requirements' => 'required|string|min:50',
                'location' => 'required|string|max:255',
                'salary' => 'required|numeric|min:0',
                'status' => ['required', Rule::in(['Aktif', 'Tutup'])],
            ], [
                'posisi.required' => 'Posisi wajib diisi',
                'description.required' => 'Deskripsi wajib diisi',
                'description.min' => 'Deskripsi minimal 50 karakter',
                'requirements.required' => 'Persyaratan wajib diisi',
                'requirements.min' => 'Persyaratan minimal 50 karakter',
                'location.required' => 'Lokasi wajib diisi',
                'salary.required' => 'Gaji wajib diisi',
                'salary.numeric' => 'Gaji harus berupa angka',
                'salary.min' => 'Gaji tidak boleh kurang dari 0',
                'status.required' => 'Status wajib diisi',
                'status.in' => 'Status harus Aktif atau Tutup',
            ]);

            DB::beginTransaction();

            $lowongan->update($validated);

            DB::commit();

            return redirect()
                ->route('lowongans.index')
                ->with('success', 'Lowongan berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $lowongan = Lowongan::findOrFail($id);
            $lowongan->delete();

            DB::commit();

            return redirect()
                ->route('lowongans.index')
                ->with('success', 'Lowongan berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }

    /**
     * Toggle the status of the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleStatus($id)
    {
        try {
            DB::beginTransaction();

            $lowongan = Lowongan::findOrFail($id);
            $lowongan->status = $lowongan->status === 'Aktif' ? 'Tutup' : 'Aktif';
            $lowongan->save();

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'Status lowongan berhasil diubah.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat mengubah status: ' . $e->getMessage());
        }
    }
}
