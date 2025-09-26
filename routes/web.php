<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home')->middleware(['redirectTo:admin', 'redirectTo:mahasiswa']);

Route::middleware('guest')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/login', [AuthController::class, 'loginAdmin'])->name('login.admin');
        Route::post('/auth-admin', [AuthController::class, 'authAdmin'])->name('login.admin.submit');
    });

    Route::prefix('mahasiswa')->group(function () {
        Route::get('/login', [AuthController::class, 'loginMahasiswa'])->name('login.mahasiswa');
        Route::post('/auth-mahasiswa', [AuthController::class, 'authMahasiswa'])->name('login.mahasiswa.submit');
    });
});

Route::middleware('auth:account')->group(function () {
    Route::middleware(['role:Admin'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
            Route::get('/data-mahasiswa', [AdminController::class, 'mahasiswa'])->name('admin.mahasiswa');
            Route::get('/data-tugas', [AdminController::class, 'tugas'])->name('admin.data.tugas');
            Route::post('/data-tugas-create/{idAdmin}', [AdminController::class, 'createTugas'])->name('admin.data.tugas.create');
            Route::post('/data-tugas-update', [AdminController::class, 'updateTugas'])->name('admin.data.tugas.update');
            Route::post('/data-tugas-delete', [AdminController::class, 'deleteTugas'])->name('admin.data.tugas.delete');
            Route::get('/tugas-mahasiswa', [AdminController::class, 'tugasMahasiswa'])->name(name: 'admin.tugas.mahasiswa');

            Route::get('/detail-project/{tugas:slug}', [AdminController::class, 'project'])->name('admin.project');
            Route::post('/tambah-project', [AdminController::class, 'tambahProject'])->name('admin.tambah.project');
            Route::post('/edit-project', [AdminController::class, 'editProject'])->name('admin.edit.project');
            Route::post('/delete-project', [AdminController::class, 'deleteProject'])->name('admin.delete.project');

            Route::post('/ubah_status_tugas_mahasiswa/{id}', [AdminController::class, 'setujui_tugas'])->name('admin.setujui_tugas');
            Route::get('/cari-data-mahasiswa', [AdminController::class, 'cari_data_mahasiswa'])->name('admin.cari_data_mahasiswa');
        });
    });

    Route::middleware(['role:Mahasiswa'])->group(function () {
        Route::prefix('mahasiswa')->group(function () {
            Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');
            Route::get('/data-mahasiswa', [MahasiswaController::class, 'mahasiswa'])->name('mahasiswa.mahasiswa');
            Route::get('/tugas-mahasiswa', [MahasiswaController::class, 'tugas'])->name('mahasiswa.tugas');
            Route::post('/upload-project-mahasiswa', [MahasiswaController::class, 'uploadProject'])->name('mahasiswa.upload.project');
            Route::post('/update-project-mahasiswa', [MahasiswaController::class, 'updateProject'])->name('mahasiswa.update.project');
        });
    });

    Route::get('/logout-admin', [AuthController::class, 'logoutAdmin'])->name('logout.admin');
    Route::get('/logout-mahasiswa', [AuthController::class, 'logoutMahasiswa'])->name('logout.mahasiswa');
});
