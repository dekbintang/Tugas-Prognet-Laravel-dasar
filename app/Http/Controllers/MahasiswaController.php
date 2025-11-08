<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $fakultas = Fakultas::all();

        // Ambil data prodi sesuai fakultas yang dipilih
        if ($request->filled('fakultas_id')) {
            $prodi = Prodi::where('fakultas_id', $request->fakultas_id)->get();
        } else {
            $prodi = Prodi::all();
        }

        // Query mahasiswa
        $mahasiswa = Mahasiswa::with(['prodi.fakultas'])
            ->when($request->fakultas_id, function ($query) use ($request) {
                $query->whereHas('prodi.fakultas', function ($q) use ($request) {
                    $q->where('id', $request->fakultas_id);
                });
            })
            ->when($request->prodi_id, function ($query) use ($request) {
                $query->where('prodi_id', $request->prodi_id);
            })
            ->get();

        return view('mahasiswa.index', compact('fakultas', 'prodi', 'mahasiswa'));
    }

    public function create()
    {
        $fakultas = Fakultas::all();
        return view('mahasiswa.create', compact('fakultas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim',
            'nama' => 'required',
            'prodi_id' => 'required|exists:prodis,id'
        ], [
            'nim.required' => 'NIM harus diisi!',
            'nim.unique' => 'NIM sudah digunakan!',
            'nama.required' => 'Nama harus diisi!',
            'prodi_id.required' => 'Program Studi harus dipilih!'
        ]);

        Mahasiswa::create($request->only('nim', 'nama', 'prodi_id'));

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $fakultas = Fakultas::with('prodi')->get();
        $fakultas_id = $mahasiswa->prodi?->fakultas_id;
        $prodi = $fakultas_id ? Prodi::where('fakultas_id', $fakultas_id)->get() : collect();

        return view('mahasiswa.edit', compact('mahasiswa', 'fakultas', 'prodi'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim,' . $mahasiswa->id,
            'nama' => 'required',
            'prodi_id' => 'required|exists:prodis,id'
        ]);

        $mahasiswa->update($request->only('nim', 'nama', 'prodi_id'));

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diperbarui!');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus!');
    }

    public function getProdiByFakultas($fakultas_id)
    {
        $prodi = Prodi::where('fakultas_id', $fakultas_id)->get();
        return response()->json($prodi);
    }
}
