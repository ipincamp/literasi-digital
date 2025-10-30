<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\DomainKognitifController;
use App\Http\Controllers\IndikatorLiterasiController;
use App\Http\Controllers\TesletController;
use App\Http\Controllers\PetunjukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\RefinementController;
use App\Http\Controllers\PaketController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [UserController::class, 'show'])->name('profile.show');
Route::get('/change-password', [UserController::class, 'changePasswordForm'])->name('password.change');
Route::post('/change-password', [UserController::class, 'updatePassword'])->name('password.update');

Route::get('/petunjuk', [PetunjukController::class, 'index'])->name('petunjuk.index');
Route::get('/petunjuk', [PetunjukController::class, 'index'])->name('petunjuk.index');
Route::post('/petunjuk', [PetunjukController::class, 'store'])->name('petunjuk.store');
Route::put('/petunjuk/{id}', [PetunjukController::class, 'update'])->name('petunjuk.update');
Route::delete('/petunjuk/{id}', [PetunjukController::class, 'destroy'])->name('petunjuk.destroy');

Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index');
Route::delete('/nilai/{percobaan}/{id_siswa}', [NilaiController::class, 'destroy'])->name('nilai.destroy');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
    Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
    Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

    Route::get('/soal', [SoalController::class, 'index'])->name('soal.index');
    Route::post('/soal', [SoalController::class, 'store'])->name('soal.store');
    Route::put('/soal/{id}', [SoalController::class, 'update'])->name('soal.update');
    Route::delete('/soal/{id}', [SoalController::class, 'destroy'])->name('soal.destroy');

    Route::get('/domain-kognitif', [DomainKognitifController::class, 'index'])->name('domain.index');
    Route::post('/domain-kognitif', [DomainKognitifController::class, 'store'])->name('domain.store');
    Route::put('/domain-kognitif/{id}', [DomainKognitifController::class, 'update'])->name('domain.update');
    Route::delete('/domain-kognitif/{id}', [DomainKognitifController::class, 'destroy'])->name('domain.destroy');

    Route::get('/indikator-literasi', [IndikatorLiterasiController::class, 'index'])->name('indikator.index');
    Route::post('/indikator-literasi', [IndikatorLiterasiController::class, 'store'])->name('indikator.store');
    Route::put('/indikator-literasi/{id}', [IndikatorLiterasiController::class, 'update'])->name('indikator.update');
    Route::delete('/indikator-literasi/{id}', [IndikatorLiterasiController::class, 'destroy'])->name('indikator.destroy');

    Route::get('/teslet', [TesletController::class, 'index'])->name('teslet.index');
    Route::post('/teslet', [TesletController::class, 'store'])->name('teslet.store');
    Route::put('/teslet/{id}', [TesletController::class, 'update'])->name('teslet.update');
    Route::delete('/teslet/{id}', [TesletController::class, 'destroy'])->name('teslet.destroy');

    Route::get('/soal', [SoalController::class, 'index'])->name('soal.index');
    Route::post('/soal', [SoalController::class, 'store'])->name('soal.store');
    Route::put('/soal/{id}', [SoalController::class, 'update'])->name('soal.update');
    Route::delete('/soal/{id}', [SoalController::class, 'destroy'])->name('soal.destroy');

    Route::get('/paket', [PaketController::class, 'index'])->name('paket.index');
    Route::post('/paket', [PaketController::class, 'store'])->name('paket.store');
    Route::put('/paket/{id}', [PaketController::class, 'update'])->name('paket.update');
    Route::delete('/paket/{id}', [PaketController::class, 'destroy'])->name('paket.destroy');
    Route::get('/paket/{id}', [PaketController::class, 'show'])->name('paket.show');

});

Route::middleware(['auth', 'siswa'])->group(function () {
    Route::get('/ujian', [UjianController::class, 'index'])->name('ujian.index');
    Route::post('/ujian/jawab', [UjianController::class, 'submit'])->name('ujian.submit');
    Route::get('/ujian/selesai', [UjianController::class, 'selesai'])->name('ujian.selesai');
    Route::get('/refinement/{id_siswa}/{percobaan}', [RefinementController::class, 'show'])->name('refinement.show');
    Route::get('/refinement/{id_siswa}/{percobaan}', [RefinementController::class, 'download'])->name('refinement.show');

});