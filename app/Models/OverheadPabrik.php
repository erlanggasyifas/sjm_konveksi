<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;

class OverheadPabrik extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_overhead',
        'nama_overhead',
        'satuan',
        'harga_satuan',
        'keterangan',
    ];

    public function produks()
    {
        return $this->hasMany(Produk::class, 'overhead_id');
    }
}
