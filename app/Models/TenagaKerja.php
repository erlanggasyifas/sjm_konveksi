<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenagaKerja extends Model
{
    use HasFactory;

    protected $fillable = ['kode_tenaga_kerja', 'nama_tenaga_kerja', 'upah', 'bagian'];
    public function produks()
    {
        return $this->belongsToMany(Produk::class)->withPivot('jumlah');
    }
}
