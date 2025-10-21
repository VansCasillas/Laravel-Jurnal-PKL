<?php

use App\Http\Controllers\Admin\DudiController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\PembimbingController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Siswa\ProfileController;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Route;

// Auth routes (login / logout)
Route::middleware('guest')->group(function () {
    Route::get('/', function () {return view('auth.login');});
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
Route::middleware(['auth', 'role:siswa'])->get('/siswa/dashboard', [DashboardController::class, 'siswa'])->name('siswa.dashboard');

// Crud user (admin only)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['auth', 'role:admin'])->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('siswa', SiswaController::class);
        Route::resource('pembimbing', PembimbingController::class);
        Route::resource('kelas', KelasController::class);
        Route::resource('jurusan', JurusanController::class);
        Route::resource('dudi', DudiController::class);
    });
});

// Crud user (siswa only)
Route::prefix('siswa')->name('siswa.')->group(function () {
    Route::middleware(['auth', 'role:siswa'])->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('profile', ProfileController::class);
    });
});
