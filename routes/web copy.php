<?php

use App\Http\Controllers\FakultasController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profil', function () {
    return view('profil');
});

Route::resource('/fakultas', FakultasController::class);
Route::resource('/prodi', ProdiController::class);
Route::resource('/mahasiswa', MahasiswaController::class);
Route::resource('/materi', MateriController::class);
Route::resource('/nilai', NilaiController::class);
Route::resource('/profile', ProfileController::class);
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::get('/dashboard', [DashboardController::class, 'index']);


// Note ini sudah dicopy utk routes/web.php saat sudah selesai npm migrate