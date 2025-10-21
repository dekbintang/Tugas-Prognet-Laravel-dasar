<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        // Ambil semua prodi beserta fakultasnya
        $prodi = Prodi::with('fakultas')->orderBy('id', 'desc')->get();
        return view('prodi.index', compact('prodi'));
    }

    public function create()
    {
        $fakultas = Fakultas::orderBy('nama_fakultas')->get();
        return view('prodi.create', compact('fakultas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_prodi' => 'required|unique:prodis,nama_prodi',
            'fakultas_id' => 'required|exists:fakultas,id',
            'akreditasi' => 'required|string',
        ], [
            'nama_prodi.required' => 'Nama Prodi harus diisi!',
            'nama_prodi.unique' => 'Nama Prodi sudah ada!',
            'fakultas_id.required' => 'Fakultas harus dipilih!',
            'akreditasi.required' => 'Akreditasi harus diisi!',
        ]);

        // Tambahkan akreditasi ke database
        Prodi::create([
            'nama_prodi' => $request->nama_prodi,
            'fakultas_id' => $request->fakultas_id,
            'akreditasi' => $request->akreditasi,
        ]);

        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil ditambahkan!');
    }

    public function edit(Prodi $prodi)
    {
        $fakultas = Fakultas::orderBy('nama_fakultas')->get();
        return view('prodi.edit', compact('prodi', 'fakultas'));
    }

    public function update(Request $request, Prodi $prodi)
    {
        $request->validate([
            'nama_prodi' => 'required|unique:prodis,nama_prodi,' . $prodi->id,
            'fakultas_id' => 'required|exists:fakultas,id',
            'akreditasi' => 'required|string',
        ], [
            'nama_prodi.required' => 'Nama Prodi harus diisi!',
            'nama_prodi.unique' => 'Nama Prodi sudah ada!',
            'fakultas_id.required' => 'Fakultas harus dipilih!',
            'akreditasi.required' => 'Akreditasi harus diisi!',
        ]);

        $prodi->update([
            'nama_prodi' => $request->nama_prodi,
            'fakultas_id' => $request->fakultas_id,
            'akreditasi' => $request->akreditasi,
        ]);

        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil diperbarui!');
    }

    public function destroy(Prodi $prodi)
    {
        $prodi->delete();
        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil dihapus!');
    }
}
