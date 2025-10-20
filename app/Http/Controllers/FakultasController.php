<?php
namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    public function index()
    {
        $fakultas = Fakultas::all();
        return view('fakultas.index', compact('fakultas'));
    }

    public function create()
    {
        return view('fakultas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_fakultas' => 'required'
        ], [
            'nama_fakultas.required' => 'Nama Fakultas harus diisi!'
        ]);

        Fakultas::create($request->all());
        return redirect()->route('fakultas.index')->with('success', 'Fakultas berhasil ditambahkan!');
    }

    public function edit(Fakultas $fakultas)
    {
        return view('fakultas.edit', compact('fakultas'));
    }

    public function update(Request $request, Fakultas $fakultas)
    {
        $request->validate([
            'nama_fakultas' => 'required'
        ], [
            'nama_fakultas.required' => 'Nama Fakultas harus diisi!'
        ]);

        $fakultas->update($request->all());
        return redirect()->route('fakultas.index')->with('success', 'Fakultas berhasil diperbarui!');
    }
        
    public function destroy(Fakultas $fakultas)
    {
    if ($fakultas->prodi()->count() > 0) {
        // Simpan pesan error di session untuk baris tertentu
        return redirect()->route('fakultas.index')->with('cannot_delete_'.$fakultas->id, 'Fakultas ini tidak bisa dihapus karena masih memiliki prodi.');
    }

    $fakultas->delete();

    return redirect()->route('fakultas.index')->with('success', 'Fakultas berhasil dihapus!');
    }

}