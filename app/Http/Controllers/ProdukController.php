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
    
        $produk = Produk::create([
            'kode_produk' => 'P-' . (Produk::count() + 1),
            'nama_produk' => $request->nama_produk,
        ]);

        $produk->bahanBakus()->attach($request->bahan_baku_id, [
            'jumlah_bahan_baku' => $request->jumlah_bahan_baku,
        ]);

        $produk->overheadPabriks()->attach($request->overhead_id, [
            'jumlah_overhead' => $request->jumlah_overhead,
        ]);

        $produk->tenagaKerjas()->attach($request->tenaga_kerja_id, [
            'jumlah_tenaga_kerja' => $request->jumlah_tenaga_kerja,
        ]);
    
        return redirect()->route('produk.index');
    }

    public function storeBahanBakuProduk(Request $request)
    {
        $request->validate([
            'bahan_baku_id' => 'required',
            'bahan_baku_id_produk' => 'required',
            'bahan_baku_jumlah' => 'required|numeric',
        ]);

        $bahanBaku = BahanBaku::find($request->bahan_baku_id);
        $produk = Produk::find($request->bahan_baku_id_produk);

        $produk->bahanBakus()->syncWithoutDetaching([$bahanBaku->id => ['jumlah_bahan_baku' => $request->bahan_baku_jumlah]]);

        return redirect()->route('produk.index');
    }

    public function storeOverheadPabrikProduk(Request $request)
    {
        $request->validate([
            'overhead_id' => 'required',
            'overhead_id_produk' => 'required',
            'overhead_jumlah' => 'required|numeric',
        ]);

        $overheadPabrik = BahanBaku::find($request->overhead_id);
        $produk = Produk::find($request->overhead_id_produk);

        $produk->overheadPabriks()->syncWithoutDetaching([$overheadPabrik->id => ['jumlah_overhead' => $request->overhead_jumlah]]);

        return redirect()->route('produk.index');
    }

    public function storeTenagaKerjaProduk(Request $request)
    {
        $request->validate([
            'tenaga_kerja_id' => 'required',
            'tenaga_kerja_id_produk' => 'required',
            'tenaga_kerja_jumlah' => 'required|numeric',
        ]);

        $tenagaKerja = BahanBaku::find($request->tenaga_kerja_id);
        $produk = Produk::find($request->tenaga_kerja_id_produk);

        $produk->tenagaKerjas()->syncWithoutDetaching([$tenagaKerja->id => ['jumlah_tenaga_kerja' => $request->tenaga_kerja_jumlah]]);

        return redirect()->route('produk.index');
    }

    public function show($id)
    {
        $produk = Produk::find($id);

        $bahanBakus = $produk->bahanBakus->map(function ($bahanBaku) {
            return [
                'kode_bahan_baku' => $bahanBaku->kode_bahan_baku,
                'nama_bahan_baku' => $bahanBaku->nama_bahan_baku,
                'satuan' => $bahanBaku->satuan,
                'harga_satuan' => $bahanBaku->harga_satuan,
                'jumlah' => $bahanBaku->pivot->jumlah_bahan_baku,
                'total' => (float)$bahanBaku->harga_satuan * (float)$bahanBaku->pivot->jumlah_bahan_baku,
            ];
        });

        $overheadPabriks = $produk->overheadPabriks->map(function ($overheadPabrik) {
            return [
                'kode_overhead' => $overheadPabrik->kode_overhead,
                'nama_overhead' => $overheadPabrik->nama_overhead,
                'satuan' => $overheadPabrik->satuan,
                'harga_satuan' => $overheadPabrik->harga_satuan,
                'jumlah' => $overheadPabrik->pivot->jumlah_overhead,
                'total' => (float)$overheadPabrik->harga_satuan * (float)$overheadPabrik->pivot->jumlah_overhead,
            ];
        });

        $tenagaKerjas = $produk->tenagaKerjas->map(function ($tenagaKerja) {
            return [
                'kode_tenaga_kerja' => $tenagaKerja->kode_tenaga_kerja,
                'nama_tenaga_kerja' => $tenagaKerja->nama_tenaga_kerja,
                'upah' => $tenagaKerja->upah,
                'bagian' => $tenagaKerja->bagian,
                'jumlah_tenaga_kerja' => $tenagaKerja->pivot->jumlah_tenaga_kerja,
            ];
        });
        
        $data = [
            'bahan_baku' => $bahanBakus,
            'overhead' => $overheadPabriks,
            'tenaga_kerja' => $tenagaKerjas,
        ];

        return response()->json($data);
    }
}