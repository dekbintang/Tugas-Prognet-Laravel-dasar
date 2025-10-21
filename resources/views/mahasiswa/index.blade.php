@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Daftar Mahasiswa</h3>
        <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Mahasiswa
        </a>
    </div>

    <!-- Filter dan Pencarian -->
    <form method="GET" action="{{ route('mahasiswa.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <label class="form-label fw-semibold">Fakultas</label>
            <select name="fakultas_id" id="fakultas_id" class="form-select">
                <option value="">-- Semua Fakultas --</option>
                @foreach($fakultas as $f)
                    <option value="{{ $f->id }}" {{ request('fakultas_id') == $f->id ? 'selected' : '' }}>
                        {{ $f->nama_fakultas }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label fw-semibold">Program Studi</label>
            <select name="prodi_id" id="prodi_id" class="form-select">
                <option value="">-- Semua Prodi --</option>
                @foreach($prodi as $p)
                    @if (!request()->filled('fakultas_id') || $p->fakultas_id == request('fakultas_id'))
                        <option value="{{ $p->id }}" {{ request('prodi_id') == $p->id ? 'selected' : '' }}>
                            {{ $p->nama_prodi }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">🔍 Cari</button>
        </div>
    </form>

    <!-- Pesan sukses/error -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Tabel Mahasiswa -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Fakultas</th>
                        <th>Program Studi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mahasiswa as $index => $m)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $m->nim }}</td>
                            <td>{{ $m->nama }}</td>
                            <td>{{ $m->prodi->fakultas->nama_fakultas }}</td>
                            <td>{{ $m->prodi->nama_prodi }}</td>
                            <td>
                                <a href="{{ route('mahasiswa.edit', $m->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <!-- Tombol Hapus Modal -->
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $m->id }}">
                                    <i class="bi bi-trash3"></i>
                                </button>

                                <!-- Modal Konfirmasi Hapus -->
                                <div class="modal fade" id="deleteModal{{ $m->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $m->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $m->id }}">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Yakin ingin menghapus mahasiswa <strong>{{ $m->nama }}</strong> ({{ $m->nim }})?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('mahasiswa.destroy', $m->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-muted">Belum ada data mahasiswa.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Script AJAX untuk Filter Prodi -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fakultasSelect = document.getElementById('fakultas_id');
    const prodiSelect = document.getElementById('prodi_id');

    fakultasSelect.addEventListener('change', function () {
        const fakultasId = this.value;
        prodiSelect.innerHTML = '<option value="">Memuat...</option>';

        if (fakultasId) {
            fetch(`/get-prodi-by-fakultas/${fakultasId}`)
                .then(res => res.json())
                .then(data => {
                    prodiSelect.innerHTML = '<option value="">-- Semua Prodi --</option>';
                    data.forEach(p => {
                        const opt = document.createElement('option');
                        opt.value = p.id;
                        opt.textContent = p.nama_prodi;
                        prodiSelect.appendChild(opt);
                    });
                });
        } else {
            prodiSelect.innerHTML = '<option value="">-- Semua Prodi --</option>';
        }
    });
});
</script>
@endsection
