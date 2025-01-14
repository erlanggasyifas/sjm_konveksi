<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
