<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\PenerimaController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('auth');
Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware(['checkislogin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('checkrole:Super Admin')->group(function () {

        Route::resource('program', ProgramController::class);
        Route::resource('user', UserController::class);

        Route::post('program/{id}/media', [ProgramController::class, 'uploadMedia'])->name('program.media.upload');
        Route::get('program/media/{mediaId}/download', [ProgramController::class, 'downloadFile'])->name('program.media.download');
        Route::delete('program/media/{mediaId}', [ProgramController::class, 'deleteFile'])->name('program.media.delete');
    });

    Route::middleware('checkrole:Admin Bansos,Super Admin')->group(function () {
        Route::resource('pendaftar', PendaftarController::class);
        Route::resource('penerima', PenerimaController::class);
        Route::resource('riwayat', RiwayatController::class);

        Route::post('riwayat/{id}/media', [RiwayatController::class, 'uploadMedia'])->name('riwayat.media.upload');
        Route::get('riwayat/media/{mediaId}/download', [RiwayatController::class, 'downloadFile'])->name('riwayat.media.download');
        Route::delete('riwayat/media/{mediaId}', [RiwayatController::class, 'deleteFile'])->name('riwayat.media.delete');

        Route::post('pendaftar/{id}/media', [PendaftarController::class, 'uploadMedia'])->name('pendaftar.media.upload');
        Route::get('pendaftar/media/{mediaId}/download', [PendaftarController::class, 'downloadFile'])->name('pendaftar.media.download');
        Route::delete('pendaftar/media/{mediaId}', [PendaftarController::class, 'deleteFile'])->name('pendaftar.media.delete');
    });

    Route::middleware('checkrole:Petugas Lapangan,Admin Bansos,Super Admin')->group(function () {
        Route::resource('verifikasi', VerifikasiController::class);

        Route::post('verifikasi/{id}/media', [VerifikasiController::class, 'uploadMedia'])->name('verifikasi.media.upload');
        Route::get('verifikasi/media/{mediaId}/download', [VerifikasiController::class, 'downloadFile'])->name('verifikasi.media.download');
        Route::delete('verifikasi/media/{mediaId}', [VerifikasiController::class, 'deleteFile'])->name('verifikasi.media.delete');
    });

    Route::resource('warga', WargaController::class);

    Route::get('/about-developer', function () {return view('pages.admin.about-developer');})->name('about.developer');

});
