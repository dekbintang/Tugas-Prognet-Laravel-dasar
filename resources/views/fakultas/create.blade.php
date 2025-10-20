@extends('layouts.app')

@section('title', 'Tambah Fakultas')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-secondary fw-bold">Tambah Fakultas</h2>
        <a href="{{ route('fakultas.index') }}" class="btn btn-success btn-gradient d-flex align-items-center">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm border-0 p-4">
        <form action="{{ route('fakultas.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nama_fakultas" class="form-label">Nama Fakultas</label>
                <input type="text" name="nama_fakultas" id="nama_fakultas"
                    class="form-control @error('nama_fakultas') is-invalid @enderror"
                    value="{{ old('nama_fakultas') }}">
                @error('nama_fakultas')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success btn-gradient">Simpan Fakultas</button>
        </form>
    </div>
</div>
@endsection
