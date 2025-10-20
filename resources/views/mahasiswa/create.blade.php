@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-secondary fw-bold">Tambah Mahasiswa</h2>
        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary btn-gradient d-flex align-items-center">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <p class="text-muted mb-4">Gunakan form berikut untuk menambahkan mahasiswa baru ke sistem.</p>

            <form action="{{ route('mahasiswa.store') }}" method="POST">
                @csrf

                {{-- NIM --}}
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM <span class="text-danger">*</span></label>
                    <input type="text" name="nim" id="nim" 
                        class="form-control @error('nim') is-invalid @enderror" 
                        value="{{ old('nim') }}" placeholder="Masukkan NIM">
                    @error('nim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nama --}}
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                    <input type="text" name="nama" id="nama" 
                        class="form-control @error('nama') is-invalid @enderror" 
                        value="{{ old('nama') }}" placeholder="Masukkan nama lengkap">
                    @error('nama')
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

                {{-- Prodi --}}
                <div class="mb-3">
                    <label for="prodi_id" class="form-label">Program Studi <span class="text-danger">*</span></label>
                    <select name="prodi_id" id="prodi_id" 
                        class="form-select @error('prodi_id') is-invalid @enderror" 
                        {{ old('prodi_id') ? '' : 'disabled' }}>
                        <option value="">-- Pilih Prodi --</option>
                    </select>
                    @error('prodi_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success btn-gradient d-flex align-items-center">
                    <i class="bi bi-plus-lg me-2"></i> Simpan Mahasiswa
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const fakultasSelect = document.getElementById('fakultas_id');
const prodiSelect = document.getElementById('prodi_id');

// Load Prodi otomatis jika ada old value dari Controller
@if(old('fakultas_id'))
fetch(`/mahasiswa/get-prodi/{{ old('fakultas_id') }}`)
.then(res => res.json())
.then(data => {
    prodiSelect.innerHTML = '<option value="">-- Pilih Prodi --</option>';
    data.forEach(function(prodi){
        let opt = document.createElement('option');
        opt.value = prodi.id;
        opt.text = prodi.nama_prodi;
        if(prodi.id == {{ old('prodi_id') ?? 'null' }}) opt.selected = true;
        prodiSelect.add(opt);
    });
    prodiSelect.disabled = false;
});
@endif

// Update Prodi saat Fakultas diubah
fakultasSelect.addEventListener('change', function() {
    let fakultasId = this.value;
    prodiSelect.innerHTML = '<option value="">-- Pilih Prodi --</option>';
    if(fakultasId){
        fetch(`/mahasiswa/get-prodi/${fakultasId}`)
        .then(res => res.json())
        .then(data => {
            data.forEach(function(prodi){
                let opt = document.createElement('option');
                opt.value = prodi.id;
                opt.text = prodi.nama_prodi;
                prodiSelect.add(opt);
            });
            prodiSelect.disabled = false;
        });
    } else {
        prodiSelect.disabled = true;
    }
});
</script>
@endpush
