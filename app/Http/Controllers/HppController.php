<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use App\Models\BahanBaku;
use App\Models\OverheadPabrik;
use App\Models\TenagaKerja;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class HppController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        $bahanBakus = BahanBaku::all();
        $overheadPabriks = OverheadPabrik::all();
        $tenagaKerjas = TenagaKerja::all();

        return view('hpp', compact('produks', 'bahanBakus', 'overheadPabriks', 'tenagaKerjas'));
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
    
    public function generatePdf(Request $request)
{
    $produkId = $request->get('produk_id');
    $jumlahProduksi = $request->get('jumlah_produksi');
    $waktuProduksi = $request->get('waktu_produksi');
    
    // Fetch product and related data
    $produk = Produk::find($produkId);
    $bahanBaku = $produk->bahanBakus;
    $overhead = $produk->overheadPabriks;
    $tenagaKerja = $produk->TenagaKerjas;

    // Calculate totals
    $totalBahanBaku = $bahanBaku->harga_satuan * $jumlahProduksi;
    $totalOverhead = $overhead->harga_satuan * $jumlahProduksi;
    $totalTenagaKerja = $tenagaKerja->upah / 30;

    // Calculate the total production cost
    $totalHargaProduksi = $totalBahanBaku + $totalOverhead + $totalTenagaKerja;

    // Calculate the price per unit
    $hargaPerUnit = $totalHargaProduksi / $jumlahProduksi;

    // Data for the view
    $data = [
        'produk' => $produk,
        'bahanBaku' => $bahanBaku,
        'overhead' => $overhead,
        'tenagaKerja' => $tenagaKerja,
        'totalBahanBaku' => $totalBahanBaku,
        'totalOverhead' => $totalOverhead,
        'totalTenagaKerja' => $totalTenagaKerja,
        'totalHargaProduksi' => $totalHargaProduksi,
        'jumlahProduksi' => $jumlahProduksi,
        'waktuProduksi' => $waktuProduksi,
        'hargaPerUnit' => $hargaPerUnit,
    ];

    // Generate PDF
    $pdf = Pdf::loadView('laporan.hpp', $data);

    // Return the PDF as a Blob response (for embedding on the page)
    return response()->stream(function () use ($pdf) {
        echo $pdf->output();
    }, 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="laporan_produksi.pdf"',
    ]);
}

}
