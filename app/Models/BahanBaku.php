<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;

class BahanBaku extends Model
{
    use HasFactory;

    protected $fillable = ['kode_bahan_baku', 'nama_bahan_baku', 'satuan', 'harga_satuan'];

    public function produks()
    {
        return $this->belongsToMany(Produk::class, 'produk_bahan_baku', 'bahan_baku_id', 'produk_id')
                    ->withPivot('jumlah_bahan_baku')
                    ->withTimestamps();
    }
}
