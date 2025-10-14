@extends('layouts.app')
@section('title', 'Tambah Mahasiswa')

@section('content')
<div class="bg-white shadow-xl rounded-2xl p-8 max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold text-blue-800 mb-6 border-b pb-3">Tambah Mahasiswa Baru</h2>

    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('mahasiswa.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label class="block font-semibold text-gray-700 mb-1">NIM</label>
            <input type="text" name="nim" value="{{ old('nim') }}" 
                   class="w-full border-gray-300 rounded-lg p-3 border focus:ring-2 focus:ring-blue-600 focus:outline-none">
        </div>

        <div>
            <label class="block font-semibold text-gray-700 mb-1">Nama</label>
            <input type="text" name="nama" value="{{ old('nama') }}" 
                   class="w-full border-gray-300 rounded-lg p-3 border focus:ring-2 focus:ring-blue-600 focus:outline-none">
        </div>

        <div>
            <label class="block font-semibold text-gray-700 mb-1">Program Studi</label>
            <input type="text" name="prodi" value="{{ old('prodi') }}" 
                   class="w-full border-gray-300 rounded-lg p-3 border focus:ring-2 focus:ring-blue-600 focus:outline-none">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="gold-btn px-6 py-2 rounded-lg font-semibold shadow-lg transition">
                Simpan Data
            </button>
        </div>
    </form>
</div>
@endsection
