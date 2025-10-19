<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterController;
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

    Route::prefix('dokter')->group(function () {
        Route::get('/login', [AuthController::class, 'loginDokter'])->name('login.dokter');
        Route::post('/auth-dokter', [AuthController::class, 'authDokter'])->name('login.dokter.submit');
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
            Route::get('/tugas-mahasiswa', [AdminController::class, 'tugasMahasiswa'])->name('admin.tugas.mahasiswa');

            Route::get('/detail-project/{tugas:slug}', [AdminController::class, 'project'])->name('admin.project');
            Route::post('/tambah-project', [AdminController::class, 'tambahProject'])->name('admin.tambah.project');
            Route::post('/edit-project', [AdminController::class, 'editProject'])->name('admin.edit.project');
            Route::post('/delete-project', [AdminController::class, 'deleteProject'])->name('admin.delete.project');

            Route::get('/detail-project-mahasiswa/{mahasiswa:slug}/{tugas:slug}', [AdminController::class, 'projectMahasiswa'])->name('admin.project.mahasiswa');
            Route::post('/setujui-tugas-mahasiswa', [AdminController::class, 'setujui_tugas'])->name('admin.setujui.tugas');
            Route::post('/tolak-tugas-mahasiswa', [AdminController::class, 'tolakTugas'])->name('admin.tolak.tugas');
            Route::get('/cari-data-mahasiswa', [AdminController::class, 'cari_data_mahasiswa'])->name('admin.cari_data_mahasiswa');
        });
    });

    Route::middleware(['role:Dokter'])->group(function () {
        Route::prefix('dokter')->group(function () {
            Route::get('/dashboard', [DokterController::class, 'dashboard'])->name('dokter.dashboard');
            Route::get('/data-tugas', [DokterController::class, 'tugas'])->name('dokter.data.tugas');
            Route::post('/data-tugas-create/{id}', [DokterController::class, 'createTugas'])->name('dokter.data.tugas.create');
            Route::post('/data-tugas-update/{id}', [DokterController::class, 'updateTugas'])->name('dokter.data.tugas.update');
            Route::post('/data-tugas-delete', [DokterController::class, 'deleteTugas'])->name('dokter.data.tugas.delete');

            Route::get('/detail-project/{tugas:slug}', [DokterController::class, 'project'])->name('dokter.project');
            Route::post('/tambah-project', [DokterController::class, 'tambahProject'])->name('dokter.tambah.project');
            Route::post('/edit-project', [DokterController::class, 'editProject'])->name('dokter.edit.project');
            Route::post('/delete-project', [DokterController::class, 'deleteProject'])->name('dokter.delete.project');

            Route::get('/detail-project-mahasiswa/{mahasiswa:slug}/{tugas:slug}', [DokterController::class, 'projectMahasiswa'])->name('dokter.project.mahasiswa');
            Route::post('/setujui-tugas-mahasiswa', [DokterController::class, 'setujui_tugas'])->name('dokter.setujui.tugas');
            Route::post('/tolak-tugas-mahasiswa', [DokterController::class, 'tolakTugas'])->name('dokter.tolak.tugas');
            Route::get('/tugas-mahasiswa', [DokterController::class, 'tugasMahasiswa'])->name('dokter.tugas.mahasiswa');
        });
    });

    Route::middleware(['role:Mahasiswa'])->group(function () {
        Route::prefix('mahasiswa')->group(function () {
            Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');
            Route::get('/data-mahasiswa', [MahasiswaController::class, 'mahasiswa'])->name('mahasiswa.mahasiswa');
            Route::get('/tugas-mahasiswa', [MahasiswaController::class, 'tugas'])->name('mahasiswa.tugas');
            Route::get('/project-mahasiswa/{tugas:slug}', [MahasiswaController::class, 'project'])->name('mahasiswa.project');
            Route::post('/upload-project-mahasiswa', [MahasiswaController::class, 'uploadProject'])->name('mahasiswa.upload.project');
            Route::post('/update-project-mahasiswa', [MahasiswaController::class, 'updateProject'])->name('mahasiswa.update.project');
        });
    });

    Route::get('/logout-admin', [AuthController::class, 'logoutAdmin'])->name('logout.admin');
    Route::get('/logout-dokter', [AuthController::class, 'logoutDokter'])->name('logout.dokter');
    Route::get('/logout-mahasiswa', [AuthController::class, 'logoutMahasiswa'])->name('logout.mahasiswa');
});
