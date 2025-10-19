<?php

use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\PembimbingController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Auth routes (login / logout)
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', [DashboardController::class,'admin'])->name('admin.dashboard');
Route::middleware(['auth', 'role:siswa'])->get('/siswa/dashboard', [DashboardController::class,'siswa'])->name('siswa.dashboard');

// Crud user (admin only)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/siswas', [SiswaController::class, 'index'])->name('admin.siswas.index');
    Route::get('/admin/siswas/create', [SiswaController::class, 'create'])->name('admin.siswas.create');
    Route::delete('/admin/siswas/{user}/delete', [SiswaController::class, 'delete'])->name('admin.siswas.delete');

    Route::get('/admin/pembimbings', [PembimbingController::class, 'index'])->name('admin.pembimbings.index');
    Route::get('/admin/pembimbings/create', [PembimbingController::class, 'create'])->name('admin.pembimbings.create');
    Route::delete('/admin/pembimbings/{user}/delete', [PembimbingController::class, 'delete'])->name('admin.pembimbings.delete');

    Route::get('/admin/kelas', [KelasController::class, 'index'])->name('admin.kelas.index');
    Route::get('/admin/kelas/create', [KelasController::class, 'create'])->name('admin.kelas.create');
    Route::delete('/admin/kelas/{user}/delete', [KelasController::class, 'delete'])->name('admin.kelas.delete');

    Route::get('/admin/jurusan', [JurusanController::class, 'index'])->name('admin.jurusans.index');
    Route::get('/admin/jurusan/create', [JurusanController::class, 'create'])->name('admin.jurusans.create');
    Route::delete('/admin/jurusan/{user}/delete', [JurusanController::class, 'delete'])->name('admin.jurusans.delete');

    Route::post('/admin/siswas', [SiswaController::class, 'store'])->name('admin.siswas.store');
    Route::post('/admin/pembimbings', [PembimbingController::class, 'store'])->name('admin.pembimbings.store');
});

// Crud user (siswa only)
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/siswas', [SiswaController::class, 'index'])->name('siswas.index');
});