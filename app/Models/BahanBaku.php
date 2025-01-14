<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    use HasFactory;

    protected $fillable = ['kode_bahan_baku', 'nama_bahan_baku', 'satuan', 'harga_satuan'];
}
