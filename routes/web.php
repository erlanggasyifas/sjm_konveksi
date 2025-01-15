<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\OverheadPabrikController;
use App\Http\Controllers\TenagaKerjaController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::resource('bahan-baku', BahanBakuController::class);
Route::get('search-bahan-baku', [BahanBakuController::class, 'search']);
Route::get('/laporan-bahan-baku', [BahanBakuController::class, 'laporanBahanBaku'])->name('laporan.bahan-baku');
Route::resource('overhead-pabrik', OverheadPabrikController::class);
Route::get('search-overhead-pabrik', [OverheadPabrikController::class, 'search']);
Route::resource('tenaga-kerja', TenagaKerjaController::class);
Route::get('search-tenaga-kerja', [TenagaKerjaController::class, 'search']);