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

    public function show($id)
    {
        $produk = Produk::find($id);

        $bahanBaku = $produk->bahanBakus->makeHidden(['id', 'created_at', 'updated_at']);
        $overheadPabrik = $produk->overheadPabriks->makeHidden(['id', 'keterangan', 'created_at', 'updated_at']);
        $tenagaKerja = $produk->tenagaKerjas->makeHidden(['id', 'created_at', 'updated_at']);

        $bahanBaku->jumlah = $produk->jumlah_bahan_baku;
        $bahanBaku->total = "Rp " . number_format((float)$bahanBaku->harga_satuan * (float)$bahanBaku->jumlah, 0, ',', '.');

        $overheadPabrik->jumlah = $produk->jumlah_overhead;
        $overheadPabrik->total = "Rp " . number_format((float)$overheadPabrik->harga_satuan * (float)$overheadPabrik->jumlah, 0, ',', '.');

        $tenagaKerja->jumlah = $produk->jumlah_tenaga_kerja;
        
        $data = [
            'bahan_baku' => $bahanBaku,
            'overhead' => $overheadPabrik,
            'tenaga_kerja' => $tenagaKerja,
        ];

        return response()->json($data);
    }
}