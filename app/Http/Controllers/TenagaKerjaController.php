<?php

namespace App\Http\Controllers;

use App\Models\TenagaKerja;
use Illuminate\Http\Request;

class TenagaKerjaController extends Controller
{
    // Menampilkan daftar tenaga kerja
    public function index()
    {
        $tenagaKerjas = TenagaKerja::all(); // Fetch all workers
        return view('tenagakerja', compact('tenagaKerjas'));
    }    

    // Menyimpan tenaga kerja baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_tenaga_kerja' => 'required|string|max:255',
            'upah' => 'required|numeric',
            'bagian' => 'required|string|max:255',
        ]);

        TenagaKerja::create([
            'kode_tenaga_kerja' => 'TK-' . (TenagaKerja::count() + 1),
            'nama_tenaga_kerja' => $request->nama_tenaga_kerja,
            'upah' => $request->upah,
            'bagian' => $request->bagian,
        ]);

        return redirect()->route('tenaga-kerja.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function show($id)
    {
        return response()->json(TenagaKerja::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_tenaga_kerja' => 'required|string|max:255',
            'upah' => 'required|numeric',
            'bagian' => 'required|string|max:255',
        ]);

        $tenagaKerja = TenagaKerja::findOrFail($id);
        $tenagaKerja->update($request->all());
        return redirect()->route('tenaga-kerja.index')->with('success', 'Data Tenaga Kerja berhasil diperbarui.');
    }

    // Menghapus data tenaga kerja
    public function destroy($id)
    {
        $tenagaKerja = TenagaKerja::findOrFail($id);
        $tenagaKerja->delete();

        return redirect()->route('tenaga-kerja.index')->with('success', 'Data berhasil dihapus!');
    }

    // Pencarian tenaga kerja
    public function search(Request $request)
    {
        $query = $request->get('query', '');
        $tenagaKerjas = TenagaKerja::where('nama_tenaga_kerja', 'like', "%{$query}%")
            ->orWhere('kode_tenaga_kerja', 'like', "%{$query}%")
            ->get();

        return response()->json($tenagaKerjas);
    }
}
