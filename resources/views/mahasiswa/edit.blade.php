@extends('layouts.app')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="container mt-4">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Edit Mahasiswa</h5>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card-body">
            <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST" novalidate>
                @csrf
                @method('PUT')

                {{-- NIM --}}
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" value="{{ old('nim', $mahasiswa->nim) }}">
                    @error('nim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nama --}}
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Mahasiswa</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $mahasiswa->nama) }}">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Fakultas --}}
                <div class="mb-3">
                    <label for="fakultas" class="form-label">Fakultas</label>
                    <select class="form-select @error('fakultas_id') is-invalid @enderror" id="fakultas" name="fakultas_id">
                        <option value="">-- Pilih Fakultas --</option>
                        @foreach($fakultas as $f)
                            <option value="{{ $f->id }}" {{ old('fakultas_id', $mahasiswa->prodi->fakultas_id ?? '') == $f->id ? 'selected' : '' }}>
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
                    <label for="prodi" class="form-label">Program Studi</label>
                    <select class="form-select @error('prodi_id') is-invalid @enderror" id="prodi" name="prodi_id">
                        <option value="">-- Pilih Prodi --</option>
                    </select>
                    @error('prodi_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script AJAX untuk Dependent Dropdown --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fakultasSelect = document.getElementById('fakultas');
    const prodiSelect = document.getElementById('prodi');
    const selectedProdi = "{{ old('prodi_id', $mahasiswa->prodi_id) }}";

    function loadProdi(fakultasId, selected = null) {
        if (!fakultasId) {
            prodiSelect.innerHTML = '<option value="">-- Pilih Prodi --</option>';
            return;
        }

        fetch(`/mahasiswa/get-prodi/${fakultasId}`)
            .then(res => res.json())
            .then(data => {
                let options = '<option value="">-- Pilih Prodi --</option>';
                data.forEach(p => {
                    options += `<option value="${p.id}" ${selected == p.id ? 'selected' : ''}>${p.nama_prodi}</option>`;
                });
                prodiSelect.innerHTML = options;
            })
            .catch(() => {
                prodiSelect.innerHTML = '<option value="">Gagal memuat data</option>';
            });
    }

    // Load prodi awal sesuai fakultas mahasiswa
    if (fakultasSelect.value) {
        loadProdi(fakultasSelect.value, selectedProdi);
    }

    // Saat fakultas berubah
    fakultasSelect.addEventListener('change', function() {
        loadProdi(this.value);
    });
});
</script>
@endsection
