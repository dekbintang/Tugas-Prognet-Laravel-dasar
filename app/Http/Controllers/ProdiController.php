<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        // Ambil semua prodi beserta relasi fakultas, urutkan berdasarkan nama
        $prodi = Prodi::with('fakultas')->orderBy('nama_prodi')->get();
        return view('prodi.index', compact('prodi'));
    }

    public function create()
    {
        $fakultas = Fakultas::orderBy('nama_fakultas')->get();
        return view('prodi.create', compact('fakultas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_prodi' => 'required|string|max:255|unique:prodis,nama_prodi',
            'fakultas_id' => 'required|exists:fakultas,id',
        ], [
            'nama_prodi.required' => 'Nama program studi wajib diisi.',
            'nama_prodi.unique' => 'Nama program studi sudah ada.',
            'fakultas_id.required' => 'Fakultas wajib dipilih.',
            'fakultas_id.exists' => 'Fakultas yang dipilih tidak valid.',
        ]);

        Prodi::create($validated);

        return redirect()->route('prodi.index')->with('success', 'Program studi berhasil ditambahkan.');
    }

    public function edit(Prodi $prodi)
    {
        $fakultas = Fakultas::orderBy('nama_fakultas')->get();
        return view('prodi.edit', compact('prodi', 'fakultas'));
    }

    public function update(Request $request, Prodi $prodi)
    {
        $validated = $request->validate([
            'nama_prodi' => 'required|string|max:255|unique:prodis,nama_prodi,' . $prodi->id,
            'fakultas_id' => 'required|exists:fakultas,id',
        ], [
            'nama_prodi.required' => 'Nama program studi wajib diisi.',
            'nama_prodi.unique' => 'Nama program studi sudah ada.',
            'fakultas_id.required' => 'Fakultas wajib dipilih.',
            'fakultas_id.exists' => 'Fakultas yang dipilih tidak valid.',
        ]);

        $prodi->update($validated);

        return redirect()->route('prodi.index')->with('success', 'Program studi berhasil diperbarui.');
    }


    public function destroy(Prodi $prodi)
    {
        $prodi->delete();
        return redirect()->route('prodi.index')->with('success', 'Program studi berhasil dihapus!');
    }
}
