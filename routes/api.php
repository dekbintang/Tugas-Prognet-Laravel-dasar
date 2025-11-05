<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\V1\MahasiswaController as V1MahasiswaController;

// Login tanpa middleware
Route::post('/login', [AuthController::class, 'login']);

// Route dengan proteksi Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Prefix versi API
    Route::prefix('v1')->group(function () {
        Route::apiResource('mahasiswa', V1MahasiswaController::class)
            ->names('api.mahasiswa'); // gunakan prefix nama agar tidak bentrok dengan route web
    });
});
