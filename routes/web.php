<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\MahasiswaController;


Route::redirect('/', '/mahasiswa');

// ================================
Route::resources([
    'prodi' => ProdiController::class,
    'mahasiswa' => MahasiswaController::class,
]);


// Filter mahasiswa berdasarkan Fakultas & Prodi
Route::get('mahasiswa/filter', [MahasiswaController::class, 'filter'])->name('mahasiswa.filter');

// AJAX untuk dropdown Prodi berdasarkan Fakultas
Route::get('mahasiswa/get-prodi/{fakultas_id}', [MahasiswaController::class, 'getProdiByFakultas'])
    ->name('mahasiswa.getProdi');

Route::get('/get-prodi-by-fakultas/{id}', [MahasiswaController::class, 'getProdiByFakultas']);

Route::resource('fakultas', FakultasController::class)
    ->parameters(['fakultas' => 'fakultas']); 