@extends('layouts.app')

@section('title', 'Daftar Fakultas')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-secondary fw-bold">Daftar Fakultas</h2>
        <a href="{{ route('fakultas.create') }}" class="btn btn-success btn-gradient d-flex align-items-center">
            <i class="bi bi-plus-lg me-2"></i> Tambah Fakultas
        </a>
    </div>

    {{-- Flash Message --}}
    @if(session()->has('success'))
        <div class="alert alert-success shadow-sm rounded-3">
            {{ session()->pull('success') }}
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead style="background: linear-gradient(135deg, #a8e6cf, #dcedc1); color: #2c3e50;">
                    <tr>
                        <th>#</th>
                        <th>Nama Fakultas</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fakultas as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_fakultas }}</td>
                        <td class="text-center">
                            <a href="{{ route('fakultas.edit', $item->id) }}" class="btn btn-outline-warning btn-sm me-2">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <button type="button" class="btn btn-outline-danger btn-sm deleteBtn" 
                                data-id="{{ $item->id }}" data-nama="{{ $item->nama_fakultas }}" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="bi bi-trash3"></i> Hapus
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-3">Belum ada fakultas</td>
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda benar-benar ingin menghapus fakultas <strong id="modalNama"></strong>?
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
        form.action = `/fakultas/${id}`; // Update form action
        document.getElementById('modalNama').innerText = nama; // Update nama di modal
    });
});
</script>   
@endpush
