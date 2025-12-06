<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\PenerimaController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('program', ProgramController::class);
Route::get('/program/{id}/dokumen', [ProgramController::class, 'mediaList'])
    ->name('program.media.list');
Route::delete('/media/{id}', [MediaController::class, 'destroy'])->name('media.destroy');

Route::resource('user', UserController::class);

Route::resource('warga', WargaController::class);

Route::get('/', [AuthController::class, 'index'])->name('auth.index');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/auth', function () {return view('pages.admin.auth');})->name('auth');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('auth');
})->name('logout');

Route::resource('pendaftar', PendaftarController::class);
Route::get('/pendaftar/{id}/dokumen', [PendaftarController::class, 'mediaList'])
     ->name('pendaftar.media.list');


Route::resource('verifikasi', VerifikasiController::class);

Route::resource('penerima', PenerimaController::class);

Route::resource('riwayat', RiwayatController::class);

Route::get('/media/view/{id}', [MediaController::class, 'view'])->name('media.view');
Route::delete('/media/delete/{id}', [MediaController::class, 'delete'])->name('media.delete');
Route::post('/media/update-caption/{id}', [MediaController::class, 'updateCaption'])->name('media.updateCaption');
