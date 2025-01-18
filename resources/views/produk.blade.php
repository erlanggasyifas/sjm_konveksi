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
                                    <button id="button-modal-bahan-baku" class="bg-yellow-500 text-white rounded px-3 py-1 text-sm hover:bg-yellow-600">+</button>
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
                                    <button id="button-modal-overhead" class="bg-yellow-500 text-white rounded px-3 py-1 text-sm hover:bg-yellow-600">+</button>
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
                                    <button id="button-modal-tenaga-kerja" class="bg-yellow-500 text-white rounded px-3 py-1 text-sm hover:bg-yellow-600">+</button>
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

        <!-- Modal Produk -->
        @include('partials.produkmodal', ['id' => 'modal-produk', 'route' => route('produk.store')])

        <!-- Modal Bahan Baku -->
        @include('partials.bahanbakumodal', ['id' => 'modal-tabel-bahan-baku', 'route' => route('bahan-baku.store')])

        <!-- Modal Overhead Pabrik -->
        @include('partials.overheadpabrikmodal', ['id' => 'modal-tabel-overhead', 'route' => route('overhead-pabrik.store')])

        <!-- Modal Tenaga Kerja -->
        @include('partials.tenagakerjamodal', ['id' => 'modal-tabel-tenaga-kerja', 'route' => route('tenaga-kerja.store')])

        <script>
            const modalProduk = document.getElementById("modal-produk");
            const modalBahanBaku = document.getElementById("modal-tabel-bahan-baku");
            const modalOverhead = document.getElementById("modal-tabel-overhead");
            const modalTenagaKerja = document.getElementById("modal-tabel-tenaga-kerja");

            const buttonModalProduk = document.getElementById("button-modal-produk");
            const buttonModalBahanBaku = document.getElementById("button-modal-bahan-baku");
            const buttonModalOverhead = document.getElementById("button-modal-overhead");
            const buttonModalTenagaKerja = document.getElementById("button-modal-tenaga-kerja");

            const formProduk = modalProduk.querySelector("form");
            const formBahanBaku = modalBahanBaku.querySelector("form");
            const formOverhead = modalOverhead.querySelector("form");
            const formTenagaKerja = modalTenagaKerja.querySelector("form");

            // Buka modal
            buttonModalProduk.addEventListener("click", () => {
                modalProduk.classList.remove("hidden");
            });

            buttonModalBahanBaku.addEventListener("click", () => {
                modalBahanBaku.classList.remove("hidden");
            });

            buttonModalOverhead.addEventListener("click", () => {
                modalOverhead.classList.remove("hidden");
            });

            buttonModalTenagaKerja.addEventListener("click", () => {
                modalTenagaKerja.classList.remove("hidden");
            });

            // Tutup modal ketika area luar modal diklik
            modalProduk.addEventListener("click", (event) => {
                if (event.target === modalProduk) {
                    closeProductModal();
                }
            });

            modalBahanBaku.addEventListener("click", (event) => {
                if (event.target === modalBahanBaku) {
                    closeProductModal();
                }
            });

            modalOverhead.addEventListener("click", (event) => {
                if (event.target === modalOverhead) {
                    closeProductModal();
                }
            });

            modalTenagaKerja.addEventListener("click", (event) => {
                if (event.target === modalTenagaKerja) {
                    closeProductModal();
                }
            });

            // Fungsi untuk menutup modal dan mereset form
            function closeProductModal() {
                modalProduk.classList.add("hidden");
                modalBahanBaku.classList.add("hidden");
                modalOverhead.classList.add("hidden");
                modalTenagaKerja.classList.add("hidden");

                resetForm(); // Reset semua nilai input
            }

            // Fungsi untuk mereset form
            function resetForm() {
                formProduk.reset();
                formBahanBaku.reset();
                formOverhead.reset();
                formTenagaKerja.reset();
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
        </script>
    </body>
</html>
