<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    // Menampilkan daftar fakultas
    public function index()
    {
        $fakultas = Fakultas::all();
        return view('fakultas.index', compact('fakultas'));
    }

    // Form tambah fakultas
    public function create()
    {
        return view('fakultas.create');
    }

    // Simpan fakultas baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_fakultas' => 'required|unique:fakultas,nama_fakultas',
            'kode_fakultas' => 'required|unique:fakultas,kode_fakultas'
        ], [
            'nama_fakultas.required' => 'Nama Fakultas harus diisi!',
            'nama_fakultas.unique' => 'Nama Fakultas sudah ada!',
            'kode_fakultas.required' => 'Kode Fakultas harus diisi!',
            'kode_fakultas.unique' => 'Kode Fakultas sudah ada!'
        ]);

        Fakultas::create($request->only('nama_fakultas', 'kode_fakultas'));
        return redirect()->route('fakultas.index')->with('success', 'Fakultas berhasil ditambahkan!');
    }

    // Form edit fakultas
    public function edit(Fakultas $fakultas)
    {
        return view('fakultas.edit', compact('fakultas'));
    }

    // Update fakultas
    public function update(Request $request, Fakultas $fakultas)
    {
        $request->validate([
            'nama_fakultas' => 'required|unique:fakultas,nama_fakultas,' . $fakultas->id,
            'kode_fakultas' => 'required|unique:fakultas,kode_fakultas,' . $fakultas->id
        ], [
            'nama_fakultas.required' => 'Nama Fakultas harus diisi!',
            'nama_fakultas.unique' => 'Nama Fakultas sudah ada!',
            'kode_fakultas.required' => 'Kode Fakultas harus diisi!',
            'kode_fakultas.unique' => 'Kode Fakultas sudah ada!'
        ]);

        $fakultas->update($request->only('nama_fakultas', 'kode_fakultas'));
        return redirect()->route('fakultas.index')->with('success', 'Fakultas berhasil diperbarui!');
    }

    // Hapus fakultas
    public function destroy(Fakultas $fakultas)
    {
        try {
            $fakultas->delete();
            return redirect()->route('fakultas.index')->with('success', 'Fakultas berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('fakultas.index')->with('error', 'Terjadi kesalahan saat menghapus fakultas.');
        }
    }
}
