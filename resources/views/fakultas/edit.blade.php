@extends('layouts.app')

@section('title', 'Edit Fakultas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0"><i class="bi bi-pencil-square"></i> Edit Fakultas</h2>
    <a href="{{ route('fakultas.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('fakultas.update', $fakultas->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nama_fakultas" class="form-label">Nama Fakultas</label>
                    <input type="text" name="nama_fakultas" id="nama_fakultas" 
                           class="form-control @error('nama_fakultas') is-invalid @enderror"
                           value="{{ old('nama_fakultas', $fakultas->nama_fakultas) }}" required>
                    @error('nama_fakultas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="kode_fakultas" class="form-label">Kode Fakultas</label>
                    <input type="text" name="kode_fakultas" id="kode_fakultas"
                           class="form-control @error('kode_fakultas') is-invalid @enderror"
                           value="{{ old('kode_fakultas', $fakultas->kode_fakultas) }}" required>
                    @error('kode_fakultas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Update
                </button>
                <a href="{{ route('fakultas.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
