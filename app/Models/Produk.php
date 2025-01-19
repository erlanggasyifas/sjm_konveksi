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
    ];

    public function bahanBakus()
    {
        return $this->belongsToMany(BahanBaku::class, 'produk_bahan_baku', 'produk_id', 'bahan_baku_id')
                    ->withPivot('jumlah_bahan_baku')
                    ->withTimestamps();
    }

    public function overheadPabriks()
    {
        return $this->belongsToMany(OverheadPabrik::class, 'produk_overhead', 'produk_id', 'overhead_id')
                    ->withPivot('jumlah_overhead')
                    ->withTimestamps();
    }
    
    public function tenagaKerjas()
    {
        return $this->belongsToMany(TenagaKerja::class, 'produk_tenaga_kerja', 'produk_id', 'tenaga_kerja_id')
                    ->withPivot('jumlah_tenaga_kerja')
                    ->withTimestamps();
    }
}