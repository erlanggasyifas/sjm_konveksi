<?php

namespace App\Http\Controllers;

use App\Models\OverheadPabrik;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OverheadPabrikController extends Controller
{
    public function index()
    {
        $overheadPabriks = OverheadPabrik::all();
        return view('overheadpabrik', compact('overheadPabriks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_overhead-pabrik' => 'required|string|max:255',
            'satuan' => 'required|string|max:255',
            'harga_satuan' => 'required|numeric',
            'keterangan' => 'required|in:Tetap,Variable', // Add validation for 'keterangan'
        ]);
        $kodeOverheadPabrik = 'OP-' . (OverheadPabrik::count() + 1);
        // Store the data including the keterangan field
        OverheadPabrik::create([
            'kode_overhead' => $kodeOverheadPabrik,
            'nama_overhead' => $validated['nama_overhead-pabrik'],
            'satuan' => $validated['satuan'],
            'harga_satuan' => $validated['harga_satuan'],
            'keterangan' => $validated['keterangan']
        ]);

        return redirect()->route('overhead-pabrik.index')->with('success', 'Data berhasil disimpan');
    }

    public function show($id)
    {
        $overheadPabrik = OverheadPabrik::findOrFail($id);
        return response()->json($overheadPabrik);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_overhead-pabrik' => 'required|string|max:255',
            'satuan' => 'required|string|max:255',
            'harga_satuan' => 'required|numeric',
            'keterangan' => 'required|in:Tetap,Variable', // Add validation for 'keterangan'
        ]);

        $overheadPabrik = OverheadPabrik::findOrFail($id);
        $overheadPabrik->update($validated);

        return redirect()->route('overhead-pabrik.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $overheadPabrik = OverheadPabrik::findOrFail($id);
        $overheadPabrik->delete();

        return redirect()->route('overhead-pabrik.index')->with('success', 'Data berhasil dihapus');
    }
    public function laporanOverheadPabrik()
    {
        $overheadPabriks = OverheadPabrik::all();
        $pdf = Pdf::loadView('laporan.overheadpabrik', compact('overheadPabriks'));
        return $pdf->stream('laporan_overhead_pabrik.pdf');
    }
}