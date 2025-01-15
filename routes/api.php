<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\BahanBaku;
use App\Models\OverheadPabrik;
use App\Models\TenagaKerja;

Route::get('/get-bahan-baku', function() {
    return BahanBaku::all();
});

Route::get('/get-overhead-pabrik', function() {
    return OverheadPabrik::all();
});

Route::get('/get-tenaga-kerja', function() {
    return TenagaKerja::all();
});