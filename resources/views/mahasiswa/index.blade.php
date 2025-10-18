@extends('layouts.app')
@section('title', 'Daftar Mahasiswa')

@section('content')
<div class="bg-white shadow-2xl rounded-2xl p-8 max-w-6xl mx-auto relative border border-gray-200">

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-blue-800">🎓 Daftar Mahasiswa</h2>
            <p class="text-gray-500 mt-1">Menampilkan seluruh data mahasiswa yang terdaftar.</p>
        </div>
        <a href="{{ route('mahasiswa.create') }}" 
           class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-white px-5 py-2 rounded-xl shadow-md font-semibold hover:from-yellow-500 hover:to-yellow-600 transition transform hover:scale-105">
           Tambah Mahasiswa
        </a>
    </div>

    {{-- Tabel --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse rounded-xl overflow-hidden shadow-md">
            <thead>
                <tr class="bg-gradient-to-r from-blue-800 to-blue-600 text-white">
                    <th class="py-3 px-4 rounded-tl-xl">#</th>
                    <th class="py-3 px-4">NIM</th>
                    <th class="py-3 px-4">Nama</th>
                    <th class="py-3 px-4">Program Studi</th>
                    <th class="py-3 px-4 text-center rounded-tr-xl">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mahasiswa as $m)
                    <tr class="border-b hover:bg-blue-50 transition duration-200">
                        <td class="py-3 px-4">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4 font-mono">{{ $m->nim }}</td>
                        <td class="py-3 px-4 font-semibold text-gray-800">{{ $m->nama }}</td>
                        <td class="py-3 px-4">{{ $m->prodi }}</td>
                        <td class="py-3 px-4 text-center space-x-2">
                            <a href="{{ route('mahasiswa.edit', $m->id) }}" 
                               class="inline-block bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 transition">
                                Edit
                            </a>
                            <button type="button"
                                    onclick="openConfirmModal({{ $m->id }})"
                                    class="inline-block bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition">
                                Hapus
                            </button>

                            <form id="delete-form-{{ $m->id }}" 
                                  action="{{ route('mahasiswa.destroy', $m->id) }}" 
                                  method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-6 text-center text-gray-500 italic">
                            Belum ada data mahasiswa.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Konfirmasi --}}
<div id="confirmModal" 
     class="hidden fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 transition-opacity duration-300">
    <div class="bg-white rounded-xl shadow-2xl w-[90%] max-w-md p-6 text-center transform scale-95 transition-all duration-300">
        <h2 class="text-xl font-bold text-gray-800 mb-2">Hapus Data Mahasiswa?</h2>
        <p class="text-gray-600 mb-6">Tindakan ini tidak dapat dibatalkan. Apakah kamu yakin ingin menghapus data ini?</p>
        <div class="flex justify-center gap-4">
            <button type="button" onclick="closeConfirmModal()" 
                    class="bg-gray-300 text-gray-700 px-5 py-2 rounded-lg hover:bg-gray-400 transition">
                Batal
            </button>
            <button id="confirmDeleteBtn"
                    class="bg-gradient-to-r from-red-600 to-red-500 text-white px-5 py-2 rounded-lg shadow-md font-semibold hover:from-red-700 hover:to-red-600 transition">
                Ya, Hapus
            </button>
        </div>
    </div>
</div>

<script>
    let deleteId = null;

    function openConfirmModal(id) {
        deleteId = id;
        const modal = document.getElementById('confirmModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex', 'opacity-100');
    }

    function closeConfirmModal() {
        const modal = document.getElementById('confirmModal');
        modal.classList.remove('flex', 'opacity-100');
        modal.classList.add('hidden');
        deleteId = null;
    }

    document.addEventListener('DOMContentLoaded', () => {
        const btn = document.getElementById('confirmDeleteBtn');
        btn.addEventListener('click', () => {
            if (deleteId) {
                document.getElementById('delete-form-' + deleteId).submit();
            }
        });
    });
</script>
@endsection
