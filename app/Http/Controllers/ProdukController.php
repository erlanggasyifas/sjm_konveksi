<?php
namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\BahanBaku;
use App\Models\OverheadPabrik;
use App\Models\TenagaKerja;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        $bahanBakus = BahanBaku::all();
        $overheadPabriks = OverheadPabrik::all();
        $tenagaKerjas = TenagaKerja::all();

        return view('produk', compact('produks', 'bahanBakus', 'overheadPabriks', 'tenagaKerjas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'bahan_baku_id' => 'required',
            'jumlah_bahan_baku' => 'required|numeric',
            'overhead_id' => 'required',
            'jumlah_overhead' => 'required|numeric',
            'tenaga_kerja_id' => 'required',
            'jumlah_tenaga_kerja' => 'required|numeric',
        ]);
    
        Produk::create([
            'kode_produk' => 'P-' . (Produk::count() + 1),
            'nama_produk' => $request->nama_produk,
            'bahan_baku_id' => $request->bahan_baku_id,
            'jumlah_bahan_baku' => $request->jumlah_bahan_baku,
            'overhead_id' => $request->overhead_id,
            'jumlah_overhead' => $request->jumlah_overhead,
            'tenaga_kerja_id' => $request->tenaga_kerja_id,
            'jumlah_tenaga_kerja' => $request->jumlah_tenaga_kerja,
        ]);
    
        return redirect()->route('produk.index');
    }
}