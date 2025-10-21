@extends('layouts.app')

@section('title', 'Tambah Fakultas')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Tambah Fakultas</h5>
            <a href="{{ route('fakultas.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('fakultas.store') }}" method="POST" novalidate>
                @csrf

                <div class="mb-3">
                    <label for="nama_fakultas" class="form-label">Nama Fakultas</label>
                    <input type="text" class="form-control @error('nama_fakultas') is-invalid @enderror" id="nama_fakultas" name="nama_fakultas" value="{{ old('nama_fakultas') }}">
                    @error('nama_fakultas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kode_fakultas" class="form-label">Kode Fakultas</label>
                    <input type="text" class="form-control @error('kode_fakultas') is-invalid @enderror" id="kode_fakultas" name="kode_fakultas" value="{{ old('kode_fakultas') }}">
                    @error('kode_fakultas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
