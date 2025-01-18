<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Data Produk</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="h-fit">
        <div class="navbar-layout bg-orange-400 h-16 px-6 flex items-center justify-between">
            <p>SJM Konveksi</p>
            <img src="/assets/sidebar-burger.png" class="h-10 cursor-pointer" id="toggle-sidebar" />
        </div>

        <div class="flex">
        <div class="sidebar-layout bg-white px-6 transition-all duration-300 w-fit h-screen overflow-y-auto" id="sidebar">
            <div>
                <div class="flex gap-3 py-6 items-center">
                    <img src="/assets/profile.png" class="h-12">
                    <div class="text-content">
                        <p>{{ Auth::user()->name }}</p>
                        <p>Administrator</p>
                    </div>
                </div>
                <div class="mb-4">
                    <p class="text-content">Menu Utama</p>
                    <div class="flex items-center gap-3">
                        <img src="/assets/bahan-baku.png" class="h-8 my-1 img-icon">
                        <a href="{{ route('bahan-baku.index') }}"><p class="text-content">Bahan Baku</p></a>
                    </div>
                    <div class="flex items-center gap-3">
                        <img src="/assets/pabrik.png" class="h-8 my-1 img-icon">
                        <a href="{{ route('overhead-pabrik.index') }}"><p class="text-content">Overhead Pabrik</p></a>
                    </div>
                    <div class="flex items-center gap-3">
                        <img src="/assets/person.png" class="h-8 my-1 img-icon">
                        <a href="{{ route('tenaga-kerja.index') }}"><p class="text-content">Tenaga Kerja</p></a>
                    </div>
                    <div class="flex items-center gap-3">
                        <img src="/assets/product.png" class="h-8 my-1 img-icon">
                        <a href="{{ route('produk.index') }}"><p class="text-content">Produk</p></a>
                    </div>
                    <div class="flex items-center gap-3">
                        <img src="/assets/profile.png" class="h-8 my-1 img-icon">
                        <a href="{{ route('hpp.index') }}"><p class="text-content">Hpp</p></a>
                    </div>
                </div>
                <div>
                    <p class="text-content">Laporan</p>
                    <div class="flex items-center gap-3">
                        <img src="/assets/laporan-bb.png" class="h-8 my-1 img-icon">
                        <a href="{{ route('laporan.bahan-baku') }}"><p class="text-content">Laporan Bahan Baku</p></a>
                    </div>
                    <div class="flex items-center gap-3">
                        <img src="/assets/laporan-pabrik.png" class="h-8 my-1 img-icon">
                        <a href="{{ route('laporan.overhead-pabrik') }}"><p class="text-content">Laporan Overhead Pabrik</p></a>
                    </div>
                    <div class="flex items-center gap-3">
                        <img src="/assets/laporan-person.png" class="h-8 my-1 img-icon">
                        <a href="{{ route('laporan.tenaga-kerja') }}"><p class="text-content">Laporan Tenaga Kerja</p></a>
                    </div>
                </div>
            </div>
        </div>

            <div class="w-full p-6 bg-gray-200">
                <div class="flex items-center mb-6 bg-yellow-500 rounded-lg">
                    <div class="m-4">
                        <img src="/assets/product.png" alt="Icon" class="w-12 h-12" />
                    </div>
                    <h1 class="text-2xl font-bold uppercase">Data Produk</h1>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Column 1: Tabel Daftar Produk -->
                    <div class="bg-white shadow rounded-lg p-6 md:col-span-1">
                        <h2 class="text-lg font-semibold mb-4 flex justify-between">
                            Tabel Daftar Produk
                            <button id="button-modal-produk" class="bg-yellow-500 text-white rounded px-3 py-1 text-sm hover:bg-yellow-600">+</button>
                        </h2>
                        <table class="w-full border-collapse border border-gray-300">
                            <thead class="bg-yellow-500">
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2 text-sm text-left">Kode Produk</th>
                                    <th class="border border-gray-300 px-4 py-2 text-sm text-left">Nama Produk</th>
                                </tr>
                            </thead>
                            <tbody style="cursor: pointer;">
                                @if($produks->isNotEmpty()) @foreach($produks as $produk)
                                <tr onclick="loadProdukData({{ $produk->id }})">
                                    <td class="border border-gray-300 px-4 py-2 text-sm text-center">{{ $produk->kode_produk }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-sm text-center">{{ $produk->nama_produk }}</td>
                                </tr>
                                @endforeach @else
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2 text-sm text-center" colspan="2">Tidak ada data.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <!-- Column 2: Bahan Baku, Overhead, Tenaga Kerja Tables -->
                    <div class="md:col-span-2">
                        <!-- Bahan Baku Table -->
                        <div class="bg-white shadow rounded-lg p-6 mb-6">
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex gap-3">
                                    <button class="bg-yellow-500 text-white rounded px-3 py-1 text-sm hover:bg-yellow-600" onclick="openBahanBakuModal()">+</button>
                                    <button class="bg-yellow-500 text-white rounded px-3 py-1 text-sm hover:bg-yellow-600">-</button>
                                    <h2 class="text-lg font-semibold">Tabel Daftar Bahan Baku</h2>
                                </div>
                                <input type="text" placeholder="Cari..." class="border rounded px-3 py-2 text-sm focus:outline-yellow-500" />
                            </div>
                            <table id="bahan-baku-table" class="w-full border-collapse border border-gray-300">
                                <thead class="bg-yellow-500">
                                    <tr>
                                        <th class="border border-gray-300 px-4 py-2 text-sm text-left">Kode Bahan Baku</th>
                                        <th class="border border-gray-300 px-4 py-2 text-sm text-left">Nama Bahan Baku</th>
                                        <th class="border border-gray-300 px-4 py-2 text-sm text-left">Satuan</th>
                                        <th class="border border-gray-300 px-4 py-2 text-sm text-left">Harga Satuan</th>
                                        <th class="border border-gray-300 px-4 py-2 text-sm text-left">Jumlah</th>
                                        <th class="border border-gray-300 px-4 py-2 text-sm text-left">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2 text-sm text-center" colspan="6">Tidak ada data.</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="flex justify-between items-center mt-4">
                                <p>Total Bahan Baku:</p>
                                <p id="total-bahan-baku">0</p>
                            </div>
                        </div>

                        <!-- Overhead Table -->
                        <div class="bg-white shadow rounded-lg p-6 mb-6">
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex gap-3">
                                    <button class="bg-yellow-500 text-white rounded px-3 py-1 text-sm hover:bg-yellow-600" onclick="openOverheadModal()">+</button>
                                    <button class="bg-yellow-500 text-white rounded px-3 py-1 text-sm hover:bg-yellow-600">-</button>
                                    <h2 class="text-lg font-semibold">Tabel Daftar Overhead</h2>
                                </div>
                                <input type="text" placeholder="Cari..." class="border rounded px-3 py-2 text-sm focus:outline-yellow-500" />
                            </div>
                            <table id="overhead-table" class="w-full border-collapse border border-gray-300">
                                <thead class="bg-yellow-500">
                                    <tr>
                                        <th class="border border-gray-300 px-4 py-2 text-sm text-left">Kode Overhead</th>
                                        <th class="border border-gray-300 px-4 py-2 text-sm text-left">Nama Overhead</th>
                                        <th class="border border-gray-300 px-4 py-2 text-sm text-left">Satuan</th>
                                        <th class="border border-gray-300 px-4 py-2 text-sm text-left">Harga Satuan</th>
                                        <th class="border border-gray-300 px-4 py-2 text-sm text-left">Jumlah</th>
                                        <th class="border border-gray-300 px-4 py-2 text-sm text-left">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2 text-sm text-center" colspan="6">Tidak ada data.</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="flex justify-between items-center mt-4">
                                <p>Total Overhead:</p>
                                <p id="total-overhead">0</p>
                            </div>
                        </div>

                        <!-- Tenaga Kerja Table -->
                        <div class="bg-white shadow rounded-lg p-6">
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex gap-3">
                                    <button class="bg-yellow-500 text-white rounded px-3 py-1 text-sm hover:bg-yellow-600" onclick="openTenagaKerjaModal()">+</button>
                                    <button class="bg-yellow-500 text-white rounded px-3 py-1 text-sm hover:bg-yellow-600">-</button>
                                    <h2 class="text-lg font-semibold">Tabel Daftar Tenaga Kerja</h2>
                                </div>
                                <input type="text" placeholder="Cari..." class="border rounded px-3 py-2 text-sm focus:outline-yellow-500" />
                            </div>
                            <table id="tenaga-kerja-table" class="w-full border-collapse border border-gray-300">
                                <thead class="bg-yellow-500">
                                    <tr>
                                        <th class="border border-gray-300 px-4 py-2 text-sm">Kode Tenaga Kerja</th>
                                        <th class="border border-gray-300 px-4 py-2 text-sm">Nama Tenaga Kerja</th>
                                        <th class="border border-gray-300 px-4 py-2 text-sm">Upah/Bulan</th>
                                        <th class="border border-gray-300 px-4 py-2 text-sm">Bagian</th>
                                        <th class="border border-gray-300 px-4 py-2 text-sm">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2 text-sm text-center" colspan="6">Tidak ada data.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="modal-produk" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white rounded-lg p-6 w-1/3">
                <h2 class="text-lg font-semibold mb-4">Tambah Produk</h2>
                <form action="{{ route('produk.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
                        <input type="text" name="nama_produk" class="mt-2 mb-4 block w-full rounded-md border-gray-300 shadow-sm outline outline-1 outline-yellow-500 focus:outline-yellow-500 h-10 px-2 py-2" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama Bahan Baku</label>
                        <select name="bahan_baku_id" class="mt-2 mb-4 block w-full rounded-md border-gray-300 shadow-sm outline outline-1 outline-yellow-500 focus:outline-yellow-500 h-10 px-1 py-2">
                            <option value="" disabled selected>Pilih Bahan Baku</option>
                            @foreach($bahanBakus as $bahanBaku)
                            <option value="{{ $bahanBaku->id }}">{{ $bahanBaku->nama_bahan_baku }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Jumlah Bahan Baku</label>
                        <input type="number" name="jumlah_bahan_baku" min="0" class="mt-2 mb-4 block w-full rounded-md border-gray-300 shadow-sm outline outline-1 outline-yellow-500 focus:outline-yellow-500 h-10 px-2 py-2" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama Overhead</label>
                        <select name="overhead_id" class="mt-2 mb-4 block w-full rounded-md border-gray-300 shadow-sm outline outline-1 outline-yellow-500 focus:outline-yellow-500 h-10 px-1 py-2">
                            <option value="" disabled selected>Pilih Overhead</option>
                            @foreach($overheadPabriks as $overheadPabrik)
                            <option value="{{ $overheadPabrik->id }}">{{ $overheadPabrik->nama_overhead }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Jumlah Overhead</label>
                        <input type="number" name="jumlah_overhead" min="0" class="mt-2 mb-4 block w-full rounded-md border-gray-300 shadow-sm outline outline-1 outline-yellow-500 focus:outline-yellow-500 h-10 px-2 py-2" />
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
                        <input type="number" name="jumlah_tenaga_kerja" min="0" class="mt-2 mb-4 block w-full rounded-md border-gray-300 shadow-sm outline outline-1 outline-yellow-500 focus:outline-yellow-500 h-10 px-2 py-2" />
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-500 text-white rounded px-4 py-2 mr-2" onclick="closeProductModal()">Batal</button>
                        <button type="submit" class="bg-yellow-500 text-white rounded px-4 py-2">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            const modal = document.getElementById("modal-produk");
            const buttonModal = document.getElementById("button-modal-produk");
            const form = modal.querySelector("form"); // Ambil elemen form di dalam modal

            // Buka modal
            buttonModal.addEventListener("click", () => {
                modal.classList.remove("hidden");
            });

            // Tutup modal ketika area luar modal diklik
            modal.addEventListener("click", (event) => {
                if (event.target === modal) {
                    // Cek apakah yang diklik adalah area luar modal
                    closeProductModal();
                }
            });

            // Fungsi untuk menutup modal dan mereset form
            function closeProductModal() {
                modal.classList.add("hidden");
                resetForm(); // Reset semua nilai input
            }

            // Fungsi untuk mereset form
            function resetForm() {
                form.reset(); // Reset semua input di dalam form
            }

            function loadProdukData(produkId) {
                fetch(`/produk/${produkId}`)
                    .then((response) => response.json())
                    .then((data) => {
                        console.log("Data dari server:", data); // Debug respons dari server
                        
                        // Isi tabel dengan data yang diambil
                        fillTable("bahan-baku-table", data.bahan_baku);
                        fillTable("overhead-table", data.overhead);
                        fillTable("tenaga-kerja-table", data.tenaga_kerja);

                        // Hitung total berdasarkan data server
                        const totalBahanBaku = calculateTotal(data.bahan_baku);
                        const totalOverhead = calculateTotal(data.overhead);
                      
                        // Update total di UI
                        document.getElementById("total-bahan-baku").textContent = totalBahanBaku;
                        document.getElementById("total-overhead").textContent = totalOverhead;
                    })
                    .catch((error) => console.error("Error:", error));
            }


            function fillTable(tableId, data) {
                console.log(`Mengisi tabel ${tableId} dengan data:`, data); // Debug isi data
                const tableBody = document.querySelector(`#${tableId} tbody`);
                tableBody.innerHTML = "";

                if (data && Object.keys(data).length > 0) {
                    const row = document.createElement("tr");

                    Object.entries(data).forEach(([key, value]) => {
                        const cell = document.createElement("td");
                        cell.className = "border border-gray-300 px-4 py-2 text-sm text-center";
                        cell.textContent = value;
                        row.appendChild(cell);
                    });

                    tableBody.appendChild(row);
                } else {
                    const row = document.createElement("tr");
                    const cell = document.createElement("td");
                    cell.className = "border border-gray-300 px-4 py-2 text-sm text-center";
                    cell.colSpan = 6;
                    cell.textContent = "Tidak ada data.";
                    row.appendChild(cell);
                    tableBody.appendChild(row);
                }
            }


            function calculateTotal(data) {
                if (!data) return "Rp 0";

                // Ambil jumlah dan harga_satuan untuk menghitung total jika total tidak tersedia
                const jumlah = parseFloat(data.jumlah || 0);
                const hargaSatuan = parseFloat(data.harga_satuan || 0);

                // Hitung total
                const numericTotal = jumlah * hargaSatuan;

                // Format total menjadi "Rp 40.000"
                const formattedTotal = "Rp " + new Intl.NumberFormat("id-ID", {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0,
                }).format(numericTotal);

                return formattedTotal;
            }


            // Fungsi-fungsi lain (opsional)
            function openBahanBakuModal() {
                alert("Open Bahan Baku modal");
            }

            function openOverheadModal() {
                alert("Open Overhead modal");
            }

            function openTenagaKerjaModal() {
                alert("Open Tenaga Kerja modal");
            }
        </script>
    </body>
</html>
