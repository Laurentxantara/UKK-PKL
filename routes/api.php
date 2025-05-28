<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GuruController;
use App\Http\Controllers\Api\SiswaController;
use App\Http\Controllers\Api\CountController;
use App\Http\Controllers\Api\FormulirController;
use App\Http\Controllers\Api\IndustriController;

Route::middleware(['auth', 'verified', 'web'])->group(function () {
    Route::get('/counts', [CountController::class, 'index']);
    Route::get('/guru-pembimbing', [GuruController::class, 'index']);

    Route::get('/siswa', [SiswaController::class, 'index']);
    Route::get('/industri', [IndustriController::class, 'index']);

    Route::get('/formulir', [FormulirController::class, 'index']);
    Route::post('/formulir', [FormulirController::class, 'store']);
});