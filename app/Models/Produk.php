<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BahanBaku;
use App\Models\overheadPabrik;
use App\Models\TenagaKerja;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'bahan_baku_id',
        'jumlah_bahan_baku',
        'overhead_id',
        'jumlah_overhead',
        'tenaga_kerja_id',
        'jumlah_tenaga_kerja',
    ];

    public function bahanBakus()
    {
        return $this->belongsTo(BahanBaku::class, 'bahan_baku_id');
    }

    public function overheadPabriks()
    {
        return $this->belongsTo(OverheadPabrik::class, 'overhead_id');
    }

    public function TenagaKerjas()
    {
        return $this->belongsTo(TenagaKerja::class, 'tenaga_kerja_id');
    }
}