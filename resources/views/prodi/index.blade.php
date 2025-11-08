@extends('layouts.app')

@section('title', 'Data Program Studi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0"><i class="bi bi-book"></i> Data Program Studi</h2>

    {{-- Tombol Tambah hanya untuk admin --}}
    @if(Auth::check() && Auth::user()->role == 'admin')
        <a href="{{ route('prodi.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Program Studi
        </a>
    @endif
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        {{-- Filter Fakultas --}}
        <form method="GET" action="{{ route('prodi.index') }}" class="row g-3 align-items-end mb-4">
            <div class="col-md-6">
                <label for="fakultas_id" class="form-label fw-semibold">
                    <i class="bi bi-building"></i> Pilih Fakultas
                </label>
                <select name="fakultas_id" id="fakultas_id" class="form-select">
                    <option value="">-- Semua Fakultas --</option>
                    @foreach($fakultas as $f)
                        <option value="{{ $f->id }}" 
                            {{ request('fakultas_id') == $f->id ? 'selected' : '' }}>
                            {{ $f->nama_fakultas }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i> Tampilkan
                </button>
                <a href="{{ route('prodi.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-repeat"></i> Reset
                </a>
            </div>
        </form>

        {{-- Tabel Data --}}
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Program Studi</th>
                        <th>Fakultas</th>
                        <th width="10%" class="text-center">Akreditasi</th>
                        <th width="10%" class="text-center">Jumlah Mahasiswa</th>

                        {{-- Kolom aksi hanya untuk admin --}}
                        @if(Auth::check() && Auth::user()->role == 'admin')
                            <th width="15%" class="text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($prodi as $index => $p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="fw-semibold">{{ $p->nama_prodi }}</td>
                        <td>{{ $p->fakultas->nama_fakultas ?? '-' }}</td>
                        <td class="text-center">
                            @if($p->akreditasi == 'A')
                                <span class="badge bg-success">{{ $p->akreditasi }}</span>
                            @elseif($p->akreditasi == 'B')
                                <span class="badge bg-primary">{{ $p->akreditasi }}</span>
                            @else
                                <span class="badge bg-warning text-dark">{{ $p->akreditasi }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="badge bg-info">{{ $p->mahasiswa->count() }}</span>
                        </td>

                        {{-- Tombol aksi untuk admin --}}
                        @if(Auth::check() && Auth::user()->role == 'admin')
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="{{ route('prodi.edit', $p->id) }}" 
                                   class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button type="button" 
                                        class="btn btn-sm btn-danger" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal{{ $p->id }}" 
                                        title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>

                            {{-- Modal Hapus --}}
                            <div class="modal fade" id="deleteModal{{ $p->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus program studi:</p>
                                            <p class="fw-bold">{{ $p->nama_prodi }}?</p>
                                            @if($p->mahasiswa->count() > 0)
                                            <div class="alert alert-warning">
                                                <i class="bi bi-exclamation-triangle"></i> 
                                                Program studi ini memiliki {{ $p->mahasiswa->count() }} mahasiswa!
                                            </div>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('prodi.destroy', $p->id) }}" method="POST" class="d-inline">
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
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ Auth::check() && Auth::user()->role == 'admin' ? '6' : '5' }}" class="text-center py-5">
                            <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                            <p class="text-muted mt-2">Belum ada data program studi</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
