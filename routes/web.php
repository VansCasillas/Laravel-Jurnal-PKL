<?php

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

// Crud user (admin only)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/siswas', [SiswaController::class, 'index'])->name('admin.siswas.index');
    Route::get('/admin/siswas', [SiswaController::class, 'index'])->name('admin.siswas.index');
    Route::get('/admin/siswas/create', [SiswaController::class, 'create'])->name('admin.siswas.create');
    Route::delete('/admin/siswas/{user}/delete', [SiswaController::class, 'delete'])->name('admin.siswas.delete');

    Route::post('/admin/siswas', [SiswaController::class, 'store'])->name('admin.siswas.store');
});