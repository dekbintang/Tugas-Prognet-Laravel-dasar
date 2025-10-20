@extends('layouts.app')

@section('title', 'Daftar Program Studi')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-secondary fw-bold">Daftar Program Studi</h2>
        <a href="{{ route('prodi.create') }}" class="btn btn-success btn-gradient d-flex align-items-center">
            <i class="bi bi-plus-lg me-2"></i> Tambah Program Studi
        </a>
    </div>

    @if(session()->has('error'))
        <div class="alert alert-danger shadow-sm rounded-3 py-2 px-3 mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead style="background: linear-gradient(135deg, #a8e6cf, #dcedc1); color: #2c3e50;">
                    <tr>
                        <th>#</th>
                        <th>Nama Program Studi</th>
                        <th>Fakultas</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($prodi as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_prodi }}</td>
                        <td>{{ $item->fakultas->nama_fakultas ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('prodi.edit', $item->id) }}" class="btn btn-outline-warning btn-sm me-2">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <button type="button" class="btn btn-outline-danger btn-sm deleteBtn" 
                                data-id="{{ $item->id }}" data-nama="{{ $item->nama_prodi }}" 
                                data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="bi bi-trash3"></i> Hapus
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-3">Belum ada program studi</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus program studi <strong id="modalNama"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.deleteBtn').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.dataset.id;
        const nama = this.dataset.nama;
        const form = document.getElementById('deleteForm');
        form.action = `/prodi/${id}`;
        document.getElementById('modalNama').innerText = nama;
    });
});
</script>
@endpush
