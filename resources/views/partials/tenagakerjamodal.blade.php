<div id="{{ $id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-6 w-1/3">
        <h2 class="text-lg font-semibold mb-4">Tambah Tenaga Kerja</h2>
        <form action="{{ $route }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Kode Produk</label>
                <input readonly type="text" name="tenaga_kerja_id_produk" class="mt-2 mb-4 block w-full rounded-md border-gray-300 shadow-sm outline outline-1 outline-yellow-500 focus:outline-yellow-500 h-10 px-2 py-2" placeholder="Kode Produk" />
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nama Tenaga Kerja</label>
                <select name="tenaga_kerja_id" class="mt-2 mb-4 block w-full rounded-md border-gray-300 shadow-sm outline outline-1 outline-yellow-500 focus:outline-yellow-500 h-10 px-1 py-2">
                    <option value="" disabled selected>Pilih Tenaga Kerja</option>
                    @foreach($tenagaKerjas as $tenagaKerja)
                    <option value="{{ $tenagaKerja->id }}">{{ $tenagaKerja->nama_tenaga_kerja }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Jumlah Tenaga Kerja</label>
                <input type="number" name="tenaga_kerja_jumlah" min="0" class="mt-2 mb-4 block w-full rounded-md border-gray-300 shadow-sm outline outline-1 outline-yellow-500 focus:outline-yellow-500 h-10 px-2 py-2" />
            </div>
            <div class="flex justify-end">
                <button type="button" class="bg-gray-500 text-white rounded px-4 py-2 mr-2" onclick="closeProductModal()">Batal</button>
                <button type="submit" class="bg-yellow-500 text-white rounded px-4 py-2">Simpan</button>
            </div>
        </form>
    </div>
</div>