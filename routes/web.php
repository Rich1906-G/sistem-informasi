<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/auth', [AuthController::class, 'auth'])->name('login.submit');
});

Route::middleware('auth:account')->group(function () {
    Route::middleware(['role:Admin'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
            Route::get('/data-mahasiswa', [AdminController::class, 'mahasiswa'])->name('admin.mahasiswa');
            Route::get('/tugas-mahasiswa', [AdminController::class, 'tugas'])->name('admin.tugas');
            Route::post('/ubah_status_tugas_mahasiswa/{id}', [AdminController::class, 'setujui_tugas'])->name('admin.setujui_tugas');
        });
    });

    Route::middleware(['role:Prodi'])->group(function () {
        Route::prefix('prodi')->group(function () {
            Route::get('/dashboard', [ProdiController::class, 'dashboard'])->name('prodi.dashboard');
        });
    });

    Route::middleware(['role:Mahasiswa'])->group(function () {
        Route::prefix('mahasiswa')->group(function () {
            Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');
            Route::get('/data-mahasiswa', [MahasiswaController::class, 'mahasiswa'])->name('mahasiswa.mahasiswa');
        });
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
