@extends('layouts.app')

@section('title', 'Tambah Program Studi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0"><i class="bi bi-plus-circle"></i> Tambah Program Studi</h2>
    <a href="{{ route('prodi.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('prodi.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nama_prodi" class="form-label">Nama Program Studi</label>
                    <input type="text" name="nama_prodi" id="nama_prodi" 
                           class="form-control @error('nama_prodi') is-invalid @enderror"
                           placeholder="Masukkan nama program studi"
                           value="{{ old('nama_prodi') }}" required>
                    @error('nama_prodi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="fakultas_id" class="form-label">Fakultas</label>
                    <select name="fakultas_id" id="fakultas_id" 
                            class="form-select @error('fakultas_id') is-invalid @enderror" required>
                        <option value="">Pilih Fakultas</option>
                        @foreach($fakultas as $f)
                            <option value="{{ $f->id }}" {{ old('fakultas_id') == $f->id ? 'selected' : '' }}>
                                {{ $f->nama_fakultas }}
                            </option>
                        @endforeach
                    </select>
                    @error('fakultas_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="akreditasi" class="form-label">Akreditasi</label>
                    <select name="akreditasi" id="akreditasi" 
                            class="form-select @error('akreditasi') is-invalid @enderror" required>
                        <option value="">Pilih Akreditasi</option>
                        <option value="A" {{ old('akreditasi') == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ old('akreditasi') == 'B' ? 'selected' : '' }}>B</option>
                        <option value="C" {{ old('akreditasi') == 'C' ? 'selected' : '' }}>C</option>
                    </select>
                    @error('akreditasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="{{ route('prodi.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
