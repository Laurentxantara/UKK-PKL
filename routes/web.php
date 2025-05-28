<?php

use App\Http\Controllers\Dashboard\FormulirController;
use App\Http\Controllers\Dashboard\GuruController;
use App\Http\Controllers\Dashboard\SiswaController;
use App\Http\Controllers\Dashboard\IndustriController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/pending', function () {
    return Inertia::render('PendingPage');
})->middleware(['auth', 'redirect.role'])->name('pending-role');

Route::middleware(['auth', 'verified', 'has.role'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });
    
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('guru-pembimbing', [GuruController::class, 'index'])
        ->name('guru');

    Route::get('siswa', [SiswaController::class, 'index'])
        ->name('siswa');

    Route::get('industri', [IndustriController::class, 'index'])
        ->name('industri');

    Route::get('formulir', [FormulirController::class, 'index'])
        ->middleware('role_or_permission:admin|siswa') 
        ->name('formulir');

    Route::get('formulir-guru', function() {
        return Inertia::render('FormulirGuruPage');
    })->middleware('role:guru')
        ->name('formulir.guru');
});


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
