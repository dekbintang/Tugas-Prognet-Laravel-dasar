<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\HelloController;

// contoh dari latihan sebelumnya
Route::get('/hello-controller', [HelloController::class, 'index']);
Route::get('/hello', function () {
    return 'Hello Laravel!';
});

// redirect halaman utama ke daftar mahasiswa
Route::get('/', function () {
    return redirect()->route('mahasiswa.index');
});

// route otomatis untuk semua aksi CRUD mahasiswa
Route::resource('mahasiswa', MahasiswaController::class);
