<?php

namespace App\Http\Controllers;

use App\Imports\GraduationImport;
use App\Models\Graduation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class GraduationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $graduations = Graduation::latest()->paginate(10);
        return view('admin.alumni.alumni', compact('graduations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'npm'               => 'required|string|max:50|unique:graduation,npm',
            'major'             => 'required|string|max:255',
            'year'              => 'required|string|max:4',
            'status_job'        => 'required|string|max:255',
            'status_major_now'  => 'required|string|max:255',
            'photo'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('graduation', 'public');
        }

        Graduation::create($validated);

        return redirect()->route('admin.graduation')
            ->with('success', 'Data alumni berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Graduation $graduation)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'npm'               => 'required|string|max:50|unique:graduation,npm,' . $graduation->id,
            'major'             => 'required|string|max:255',
            'year'              => 'required|string|max:4',
            'status_job'        => 'required|string|max:255',
            'status_major_now'  => 'required|string|max:255',
            'photo'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($graduation->photo) {
                Storage::disk('public')->delete($graduation->photo);
            }
            $validated['photo'] = $request->file('photo')->store('graduation', 'public');
        }

        $graduation->update($validated);

        return redirect()->route('admin.graduation')
            ->with('success', 'Data alumni berhasil diperbarui.');
    }

    /**
     * Import data alumni dari file Excel.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:5120',
        ], [
            'file.required' => 'File Excel wajib diunggah.',
            'file.mimes'    => 'Format file harus .xlsx atau .xls.',
            'file.max'      => 'Ukuran file maksimal 5 MB.',
        ]);

        try {
            Excel::import(new GraduationImport, $request->file('file'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }

        return redirect()->route('admin.graduation')
            ->with('success', 'Data alumni berhasil diimport dari Excel.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Graduation $graduation)
    {
        if ($graduation->photo) {
            Storage::disk('public')->delete($graduation->photo);
        }

        $graduation->delete();

        return redirect()->route('admin.graduation')
            ->with('success', 'Data alumni berhasil dihapus.');
    }
}
