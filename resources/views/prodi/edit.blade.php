@extends('layouts.app')

@section('title', 'Edit Prodi')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Edit Prodi</h5>
            <a href="{{ route('prodi.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('prodi.update', $prodi->id) }}" method="POST" novalidate>
                @csrf
                @method('PUT')

                {{-- Nama Prodi --}}
                <div class="mb-3">
                    <label for="nama_prodi" class="form-label">Nama Prodi</label>
                    <input type="text" 
                           class="form-control @error('nama_prodi') is-invalid @enderror" 
                           id="nama_prodi" 
                           name="nama_prodi" 
                           value="{{ old('nama_prodi', $prodi->nama_prodi) }}">
                    @error('nama_prodi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Fakultas --}}
                <div class="mb-3">
                    <label for="fakultas_id" class="form-label">Fakultas</label>
                    <select class="form-select @error('fakultas_id') is-invalid @enderror" 
                            id="fakultas_id" name="fakultas_id">
                        <option value="">-- Pilih Fakultas --</option>
                        @foreach($fakultas as $f)
                            <option value="{{ $f->id }}" {{ old('fakultas_id', $prodi->fakultas_id) == $f->id ? 'selected' : '' }}>
                                {{ $f->nama_fakultas }}
                            </option>
                        @endforeach
                    </select>
                    @error('fakultas_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Akreditasi --}}
                <div class="mb-3">
                    <label for="akreditasi" class="form-label">Akreditasi</label>
                    <input type="text" 
                           class="form-control @error('akreditasi') is-invalid @enderror" 
                           id="akreditasi" 
                           name="akreditasi" 
                           value="{{ old('akreditasi', $prodi->akreditasi) }}">
                    @error('akreditasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('prodi.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
