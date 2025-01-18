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
                <div class="mb-6 bg-yellow-500 rounded-lg">
                    <div class="flex items-center">
                        <div class="m-4">
                            <img src="/assets/product.png" alt="Icon" class="w-12 h-12" />
                        </div>
                        <h1 class="text-2xl font-bold uppercase">Data Produk</h1>
                    </div>
                    <div class="w-fit px-6 flex gap-8">
                    <select name="produk_id" class="mt-2 mb-4 h-full block rounded-md border-gray-300 shadow-sm outline outline-1 outline-yellow-500 focus:outline-yellow-500 h-10 px-1 py-2" onchange="loadProdukData(this.value)">
                        <option value="">Select a product</option> <!-- Optional: Add a default option -->
                        @foreach($produks as $produk)
                            <option value="{{ $produk->id }}">{{ $produk->nama_produk }}</option>
                        @endforeach
                    </select>
                            <input type="number" class="h-fit" placeholder="Jumlah Produksi" id="jumlah_produksi">
                            <input type="number" class="h-fit" placeholder="Estimasi Waktu Produksi" id="waktu_produksi">
                    </div>
                    <button id="generate-button">Generate</button>
                </div>

                <div id="pdf-container" class="mt-8 bg-red h-full"></div>
            </div>

            <script>
    let produkData = {}; // Store fetched product data

    function loadProdukData(produkId) {
        if (!produkId) {
            console.log("No product selected.");
            return; // Exit if no product is selected
        }

        fetch(`/produk/${produkId}`)
            .then((response) => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then((data) => {
                console.log("Data dari server:", data); 
                produkData = data; // Store the fetched data for later use
            })
            .catch((error) => console.error("Error:", error));
    }

    // Add event listener for the Generate button
    document.getElementById("generate-button").addEventListener("click", generatePdf);

    function generatePdf() {
        const jumlahProduksi = document.getElementById("jumlah_produksi").value;
        const produkId = document.querySelector('select[name="produk_id"]').value;

        if (!jumlahProduksi || !produkData.bahan_baku || !produkData.overhead) {
            console.log("Please enter a valid quantity of production.");
            return; // Exit if no quantity is entered or data is not available
        }

        // Calculate total for bahan baku
        const totalBahanBaku = produkData.bahan_baku.total * jumlahProduksi;
        // Calculate total for overhead
        const totalOverhead = produkData.overhead.total * jumlahProduksi;
        // Calculate total for tenaga kerja
        const totalUpah = parseInt(produkData.tenaga_kerja.upah);
        const totalProductId = parseInt(produkId);

        // Prepare data for the request
        const url = `/generate-pdf?produk_id=${totalProductId}&jumlah_produksi=${jumlahProduksi}&total_bahan_baku=${totalBahanBaku}&total_overhead=${totalOverhead}&total_tenaga_kerja=${totalUpah}&waktu_produksi=${document.getElementById("waktu_produksi").value}`;
        
        fetch(url)
            .then(response => response.blob()) // Fetch PDF as a Blob
            .then(blob => {
                const pdfUrl = URL.createObjectURL(blob);
                document.getElementById("pdf-container").innerHTML = `<iframe src="${pdfUrl}" width="100%" class="h-full"></iframe>`;
            })
            .catch(error => console.error("Error generating PDF:", error));
    }
</script>

    </body>
</html>
