<?php
namespace App\Http\Controllers;

use App\Models\BahanBaku;
use Illuminate\Http\Request;

class BahanBakuController extends Controller
{
    public function index()
    {
        $bahanBakus = BahanBaku::all();
        return view('bahanbaku', compact('bahanBakus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_bahan_baku' => 'required|string|max:255',
            'satuan' => 'required|string|max:255',
            'harga_satuan' => 'required|numeric',
        ]);

        $kodeBahanBaku = 'BB-' . (BahanBaku::count() + 1);
        BahanBaku::create([
            'kode_bahan_baku' => $kodeBahanBaku,
            'nama_bahan_baku' => $validated['nama_bahan_baku'],
            'satuan' => $validated['satuan'],
            'harga_satuan' => $validated['harga_satuan'],
        ]);

        return redirect()->route('bahan-baku.index');
    }

    public function show($id)
    {
        $bahanBaku = BahanBaku::findOrFail($id);
        return response()->json($bahanBaku);
    }
    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_bahan_baku' => 'required|string|max:255',
            'satuan' => 'required|string|max:255',
            'harga_satuan' => 'required|numeric',
        ]);

        $bahanBaku = BahanBaku::findOrFail($id);
        $bahanBaku->update($validated);

        return redirect()->route('bahan-baku.index');
    }

    public function destroy($id)
    {
        BahanBaku::findOrFail($id)->delete();
        return redirect()->route('bahan-baku.index');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $bahanBakus = BahanBaku::where('nama_bahan_baku', 'like', '%' . $query . '%')->get();
        return response()->json($bahanBakus);
    }
}