@extends('layouts.app')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0"><i class="bi bi-pencil-square"></i> Edit Mahasiswa</h2>
    <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" name="nim" id="nim" class="form-control @error('nim') is-invalid @enderror"
                           value="{{ old('nim', $mahasiswa->nim) }}" required>
                    @error('nim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="nama" class="form-label">Nama Mahasiswa</label>
                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                           value="{{ old('nama', $mahasiswa->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="fakultas_id" class="form-label">Fakultas</label>
                    <select name="fakultas_id" id="fakultas_id" class="form-select @error('fakultas_id') is-invalid @enderror" required>
                        @foreach($fakultas as $f)
                            <option value="{{ $f->id }}" 
                                {{ old('fakultas_id', $mahasiswa->prodi->fakultas_id ?? '') == $f->id ? 'selected' : '' }}>
                                {{ $f->nama_fakultas }}
                            </option>
                        @endforeach
                    </select>
                    @error('fakultas_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="prodi_id" class="form-label">Program Studi</label>
                    <select name="prodi_id" id="prodi_id" class="form-select @error('prodi_id') is-invalid @enderror" required>
                        @foreach($prodi as $p)
                            <option value="{{ $p->id }}" 
                                {{ old('prodi_id', $mahasiswa->prodi_id) == $p->id ? 'selected' : '' }}>
                                {{ $p->nama_prodi }}
                            </option>
                        @endforeach
                    </select>
                    @error('prodi_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Update
                </button>
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
<script>
document.getElementById('fakultas_id').addEventListener('change', function() {
    const fakultasId = this.value;
    const prodiSelect = document.getElementById('prodi_id');
    
    prodiSelect.innerHTML = '<option value="">Loading...</option>';
    prodiSelect.disabled = true;
    
    if (fakultasId) {
        fetch(`/get-prodi/${fakultasId}`)
            .then(response => response.json())
            .then(data => {
                prodiSelect.innerHTML = '<option value="">Pilih Program Studi</option>';
                
                if (data.length > 0) {
                    data.forEach(prodi => {
                        const option = document.createElement('option');
                        option.value = prodi.id;
                        option.textContent = prodi.nama_prodi;
                        prodiSelect.appendChild(option);
                    });
                    prodiSelect.disabled = false;
                } else {
                    prodiSelect.innerHTML = '<option value="">Tidak ada prodi tersedia</option>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                prodiSelect.innerHTML = '<option value="">Error loading data</option>';
            });
    }
});
</script>

@endsection
