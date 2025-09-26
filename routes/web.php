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
    Route::prefix('admin')->group(function () {
        Route::get('/login', [AuthController::class, 'loginAdmin'])->name('login.admin');
        Route::post('/auth-admin', [AuthController::class, 'authAdmin'])->name('login.admin.submit');
    });
    Route::prefix('prodi')->group(function () {
        Route::get('/login', [AuthController::class, 'loginProdi'])->name('login.prodi');
        Route::post('/auth-prodi', [AuthController::class, 'authProdi'])->name('login.prodi.submit');
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
            Route::get('/tugas-mahasiswa', [AdminController::class, 'tugas'])->name('admin.tugas');
            Route::post('/ubah_status_tugas_mahasiswa/{id}', [AdminController::class, 'setujui_tugas'])->name('admin.setujui_tugas');
            Route::get('/cari-data-mahasiswa', [AdminController::class, 'cari_data_mahasiswa'])->name('admin.cari_data_mahasiswa');
        });
    });

    Route::middleware(['role:Prodi'])->group(function () {
        Route::prefix('prodi')->group(function () {
            Route::get('/dashboard', [ProdiController::class, 'dashboard'])->name('prodi.dashboard');
            Route::get('/tugas-mahasiswa', [ProdiController::class, 'tugasMahasiswa'])->name('prodi.tugas.mahasiswa');
            Route::post('/setujui-status-tugas/{id}/mahasiswa/{mahsiswa_id}', [ProdiController::class, 'setujui_tugas'])->name('prodi.setujui.tugas');
            Route::post('/tolak-status-tugas/{id}/mahasiswa/{mahsiswa_id}', [ProdiController::class, 'tolak_tugas'])->name('prodi.tolak.tugas');
            Route::post('/tambah-tugas-mahasiswa/{prodi_id}', [ProdiController::class, 'tambahTugasMahasiswa'])->name('prodi.tambah.tugas.mahasiswa');
            Route::post('/tambah-project-mahasiswa', [ProdiController::class, 'tambahProjectMahasiswa'])->name('prodi.tambah.project.mahasiswa');
            Route::get('/project-mahasiswa', [ProdiController::class, 'projectMahasiswa'])->name('prodi.project.mahasiswa');
            Route::get('/logout', [AuthController::class, 'logoutDosen'])->name('logout.dosen');
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
