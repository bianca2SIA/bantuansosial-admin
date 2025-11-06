<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/program/create', [ProgramController::class, 'create'])->name('program.create');
Route::post('/program', [ProgramController::class, 'store'])->name('program.store');

Route::resource('program', ProgramController::class);

Route::resource('user', UserController::class);

Route::resource('warga', WargaController::class);

Route::get('/auth', [AuthController::class, 'index'])->name('auth.index');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/auth', function () { return view('admin.auth'); })->name('auth');

Route::post('/logout', function () {
    Auth::logout(); // Hapus data login
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('auth'); // Arahkan ke halaman auth.blade.php
})->name('logout');
