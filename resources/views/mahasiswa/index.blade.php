@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0"><i class="bi bi-people"></i> Data Mahasiswa</h2>

    {{-- Tombol tambah hanya muncul untuk admin --}}
    @auth
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Mahasiswa
            </a>
        @endif
    @endauth
</div>

<!-- Filter Card -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('mahasiswa.index') }}" class="row g-3">
            <div class="col-md-4">
                <label for="fakultas_id" class="form-label">Filter Fakultas</label>
                <select class="form-select" id="fakultas_id" name="fakultas_id" onchange="this.form.submit()">
                    <option value="">Semua Fakultas</option>
                    @foreach($fakultas as $f)
                        <option value="{{ $f->id }}" {{ request('fakultas_id') == $f->id ? 'selected' : '' }}>
                            {{ $f->nama_fakultas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="prodi_id" class="form-label">Filter Program Studi</label>
                <select class="form-select" id="prodi_id" name="prodi_id">
                    <option value="">Semua Program Studi</option>
                    @foreach($prodi as $p)
                        <option value="{{ $p->id }}" {{ request('prodi_id') == $p->id ? 'selected' : '' }}>
                            {{ $p->nama_prodi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="bi bi-funnel"></i> Filter
                </button>
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle"></i> Reset
                </a>
            </div>
        </form>
    </div>
</div>


<!-- Data Table Card -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Program Studi</th>
                        <th>Fakultas</th>

                        {{-- Kolom aksi hanya muncul untuk admin --}}
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <th width="15%" class="text-center">Aksi</th>
                            @endif
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswa as $index => $mhs)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><span class="badge bg-primary">{{ $mhs->nim }}</span></td>
                        <td>{{ $mhs->nama }}</td>
                        <td>{{ $mhs->prodi->nama_prodi ?? '-' }}</td>
                        <td>{{ $mhs->prodi->fakultas->nama_fakultas ?? '-' }}</td>

                        {{-- Tombol aksi hanya untuk admin --}}
                        @auth
                            @if(Auth::user()->role === 'admin')
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('mahasiswa.edit', $mhs->id) }}" 
                                       class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal{{ $mhs->id }}" 
                                            title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $mhs->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus mahasiswa:</p>
                                                <p class="fw-bold">{{ $mhs->nama }} ({{ $mhs->nim }})?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            @endif
                        @endauth
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                            <p class="text-muted mt-2">Belum ada data mahasiswa</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
