@extends('layouts.app')

@section('title', 'Data Fakultas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0"><i class="bi bi-building"></i> Data Fakultas</h2>

    {{-- Tombol hanya untuk admin --}}
    @if(Auth::check() && Auth::user()->role == 'admin')
        <a href="{{ route('fakultas.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Fakultas
        </a>
    @endif
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Kode Fakultas</th>
                        <th>Nama Fakultas</th>
                        <th width="15%" class="text-center">Jumlah Program Studi</th>
                        
                        {{-- Kolom aksi hanya untuk admin --}}
                        @if(Auth::check() && Auth::user()->role == 'admin')
                            <th width="15%" class="text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($fakultas as $index => $f)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><span class="badge bg-primary">{{ $f->kode_fakultas }}</span></td>
                        <td class="fw-semibold">{{ $f->nama_fakultas }}</td>
                        <td class="text-center">
                            <span class="badge bg-info">{{ $f->prodi->count() }}</span>
                        </td>

                        {{-- Tombol aksi hanya untuk admin --}}
                        @if(Auth::check() && Auth::user()->role == 'admin')
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="{{ route('fakultas.edit', $f->id) }}" 
                                   class="btn btn-sm btn-warning" 
                                   title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button type="button" 
                                        class="btn btn-sm btn-danger" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal{{ $f->id }}" 
                                        title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>

                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade" id="deleteModal{{ $f->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus fakultas:</p>
                                            <p class="fw-bold">{{ $f->nama_fakultas }} ({{ $f->kode_fakultas }})?</p>
                                            @if($f->prodi->count() > 0)
                                            <div class="alert alert-warning mt-2">
                                                <i class="bi bi-exclamation-triangle"></i> 
                                                Fakultas ini memiliki {{ $f->prodi->count() }} program studi!
                                            </div>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('fakultas.destroy', $f->id) }}" method="POST" class="d-inline">
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
                        <td colspan="{{ Auth::check() && Auth::user()->role == 'admin' ? '5' : '4' }}" class="text-center py-5">
                            <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                            <p class="text-muted mt-2">Belum ada data fakultas</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
