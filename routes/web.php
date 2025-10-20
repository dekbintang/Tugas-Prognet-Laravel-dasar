<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\FakultasController;
use Illuminate\Support\Facades\Route;

// Halaman default
Route::get('/', [MahasiswaController::class, 'index']);

// Resource route dengan parameter konsisten
Route::resource('fakultas', FakultasController::class)->parameters([
    'fakultas' => 'fakultas'
]);

Route::resource('prodi', ProdiController::class)->parameters([
    'prodi' => 'prodi'
]);

Route::resource('mahasiswa', MahasiswaController::class)->parameters([
    'mahasiswa' => 'mahasiswa'
]);

// Route AJAX dependent dropdown
Route::get('mahasiswa/get-prodi/{fakultas_id}', [MahasiswaController::class, 'getProdiByFakultas']);
