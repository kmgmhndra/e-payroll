<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman depan (Landing Page)
// Route::view('/', '/login');
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// Rute yang hanya bisa diakses setelah Login & Verifikasi
Route::middleware(['auth', 'verified'])->group(function () {
    
    // 1. Dashboard Utama (Bisa diakses Admin & Pegawai)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Fitur Khusus Administrator (Role: admin)
    Route::middleware(['role:admin'])->group(function () {
        
        // Manajemen Pegawai (CRUD)
        // Menggunakan resource agar otomatis memiliki rute index, create, store, edit, update, destroy
        Route::resource('admin/users', UserController::class)->names([
            'index' => 'admin.users',
            'create' => 'admin.users.create',
            'store' => 'admin.users.store',
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'destroy' => 'admin.users.destroy',
        ]);

        // Fitur Tambahan: Import Pegawai via Excel
        Route::post('admin/users/import', [UserController::class, 'import'])->name('admin.users.import');

        // Manajemen Slip Gaji (Upload Kolektif)
        Route::get('admin/import-salary', [UserController::class, 'showImportSalary'])->name('admin.import');

        // Proses Simpan Data Gaji (Excel)
        Route::post('admin/import-salary', [UserController::class, 'storeSalary'])->name('admin.salary.store');

        // routes/web.php
        // Sesuaikan nama method di sini menjadi 'archive'
        Route::get('admin/arsip-payroll', [UserController::class, 'archive'])->name('admin.arsip');

        // 1. Route untuk Melihat Detail Gaji per Periode (Dari Halaman Arsip)
        Route::get('admin/salary/period/{year}/{month}', [UserController::class, 'showPeriod'])->name('admin.salary.period');

        Route::delete('/admin/salary/archive/{year}/{month}', [\App\Http\Controllers\Admin\UserController::class, 'destroyArchive'])->name('admin.salary.destroy_archive');

        // Download ZIP per Periode
        Route::get('admin/salary/zip/{year}/{month}', [UserController::class, 'downloadZip'])
            ->name('admin.salary.download_zip');

        Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('admin.settings.update');
    });
        
    // 2. Route untuk CETAK PDF (Ini yang membuat error 404 tadi)
    Route::get('admin/salary/{id}/print', [UserController::class, 'printSalary'])->name('admin.salary.print');

    // 3. Fitur Khusus Pegawai (Role: pegawai)
    Route::middleware(['role:pegawai'])->group(function () {
        // Halaman melihat dan download slip gaji sendiri
        Route::get('/my-slips', function () {
            return view('user.slips');
        })->name('user.slips');
    });

    // 4. Pengaturan Profil User (Bawaan Breeze)
    Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
});

// Memuat rute autentikasi bawaan Laravel Breeze (Login, Register, Logout)
require __DIR__.'/auth.php';