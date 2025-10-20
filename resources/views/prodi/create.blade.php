@extends('layouts.app')

@section('title', 'Tambah Program Studi')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-secondary fw-bold">Tambah Program Studi</h2>
        <a href="{{ route('prodi.index') }}" class="btn btn-success btn-gradient d-flex align-items-center">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="card shadow-sm border-0 p-4">
        <form action="{{ route('prodi.store') }}" method="POST">
            @csrf

            {{-- Nama Prodi --}}
            <div class="mb-3">
                <label for="nama_prodi" class="form-label">Nama Program Studi <span class="text-danger">*</span></label>
                <input type="text" name="nama_prodi" id="nama_prodi" 
                       class="form-control @error('nama_prodi') is-invalid @enderror" 
                       value="{{ old('nama_prodi') }}" placeholder="Masukkan Nama Program Studi">
                @error('nama_prodi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Fakultas --}}
            <div class="mb-3">
                <label for="fakultas_id" class="form-label">Fakultas <span class="text-danger">*</span></label>
                <select name="fakultas_id" id="fakultas_id" 
                        class="form-select @error('fakultas_id') is-invalid @enderror">
                    <option value="">-- Pilih Fakultas --</option>
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

            <button type="submit" class="btn btn-success btn-gradient">Simpan</button>
        </form>
    </div>
</div>
@endsection
