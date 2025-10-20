<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    // Menampilkan daftar mahasiswa
    public function index()
    {
        $mahasiswa = Mahasiswa::with('prodi.fakultas')->get();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    // Form tambah mahasiswa
    public function create()
    {
        $fakultas = Fakultas::all(); // Ambil semua fakultas
        return view('mahasiswa.create', compact('fakultas'));
    }

    // Simpan mahasiswa baru
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim',
            'nama' => 'required',
            'fakultas_id' => 'required|exists:fakultas,id',
            'prodi_id' => 'required|exists:prodis,id'
        ], [
            'nim.required' => 'NIM harus diisi!',
            'nim.unique' => 'NIM sudah digunakan!',
            'nama.required' => 'Nama harus diisi!',
            'fakultas_id.required' => 'Fakultas harus dipilih!',
            'prodi_id.required' => 'Program Studi harus dipilih!'
        ]);

        Mahasiswa::create($request->only('nim', 'nama', 'prodi_id'));

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    // Form edit mahasiswa
    public function edit(Mahasiswa $mahasiswa)
    {
        $fakultas = Fakultas::all();
        $prodi = Prodi::where('fakultas_id', $mahasiswa->prodi->fakultas_id)->get();

        return view('mahasiswa.edit', compact('mahasiswa', 'fakultas', 'prodi'));
    }

    // Update data mahasiswa
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim,' . $mahasiswa->id,
            'nama' => 'required',
            'fakultas_id' => 'required|exists:fakultas,id',
            'prodi_id' => 'required|exists:prodis,id'
        ], [
            'nim.required' => 'NIM harus diisi!',
            'nim.unique' => 'NIM sudah digunakan!',
            'nama.required' => 'Nama harus diisi!',
            'fakultas_id.required' => 'Fakultas harus dipilih!',
            'prodi_id.required' => 'Program Studi harus dipilih!'
        ]);

        $mahasiswa->update($request->only('nim', 'nama', 'prodi_id'));

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diperbarui!');
    }

    // Hapus mahasiswa
    public function destroy(Mahasiswa $mahasiswa)
    {
        try {
            $mahasiswa->delete();
            return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('mahasiswa.index')->with('error', 'Terjadi kesalahan saat menghapus mahasiswa.');
        }
    }

    // Endpoint AJAX untuk dependent dropdown prodi
    public function getProdiByFakultas($fakultas_id)
    {
        $prodi = Prodi::where('fakultas_id', $fakultas_id)->get();
        return response()->json($prodi);
    }
}
