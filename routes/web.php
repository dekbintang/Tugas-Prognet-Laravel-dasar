<?php

// use App\Http\Controllers\ProfileController;
// use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Route::middleware(['auth', 'admin'])->group(function(){
//     Route::resource('mahasiswa', MahasiswaController::class)->except(['index']);
//     Route::resource('prodi', ProdiController::class)->except(['index']);
// });

// require __DIR__.'/auth.php'; -->

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// CRUD untuk admin - exclude index dan show
Route::middleware(['auth', 'admin'])->group(function(){
    Route::resource('mahasiswa', MahasiswaController::class)->except(['index', 'show']);
    Route::resource('fakultas', FakultasController::class)->except(['index', 'show'])->parameters([
        'fakultas' => 'fakultas'
    ]);
    Route::resource('prodi', ProdiController::class)->except(['index', 'show']);
});

// Index untuk semua user (tanpa show)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/get-prodi/{fakultas_id}', [MahasiswaController::class, 'getProdiByFakultas']);
    
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::get('/fakultas', [FakultasController::class, 'index'])->name('fakultas.index');
    Route::get('/prodi', [ProdiController::class, 'index'])->name('prodi.index');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';