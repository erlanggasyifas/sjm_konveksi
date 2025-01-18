<!DOCTYPE html>
<html>
<head>
    <title>Laporan Produksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            margin-bottom: 10px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table, .table th, .table td {
            border: 1px solid #000;
        }
        .table th, .table td {
            padding: 8px;
            text-align: left;
        }
        .total {
            font-weight: bold;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div class="section">
        <h2>1. Biaya Bahan Baku</h2>
        <table class="table">
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Total</th>
            </tr>
            <tr>
                <td>{{ $bahanBaku->kode_bahan_baku }}</td>
                <td>{{ $bahanBaku->nama_bahan_baku }}</td>
                <td>{{ number_format($bahanBaku->harga_satuan, 0, ',', '.') }}</td>
            </tr>
        </table>
        <p class="total">Total Biaya Bahan Baku: {{ number_format($totalBahanBaku, 0, ',', '.') }}</p>
    </div>

    <div class="section">
        <h2>2. Biaya Overhead Pabrik</h2>
        <table class="table">
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Total</th>
            </tr>
            <tr>
                <td>{{ $overhead->kode_overhead }}</td>
                <td>{{ $overhead->nama_overhead }}</td>
                <td>{{ number_format($overhead->harga_satuan, 0, ',', '.') }}</td>
            </tr>
        </table>
        <p class="total">Total Biaya Overhead Pabrik: {{ number_format($totalOverhead, 0, ',', '.') }}</p>
    </div>

    <div class="section">
        <h2>3. Biaya Tenaga Kerja</h2>
        <table class="table">
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Total</th>
            </tr>
            <tr>
                <td>{{ $tenagaKerja->kode_tenaga_kerja }}</td>
                <td>{{ $tenagaKerja->nama_tenaga_kerja }}</td>
                <td>{{ number_format($tenagaKerja->upah, 0, ',', '.') }}</td>
            </tr>
        </table>
        <p class="total">Total Biaya Tenaga Kerja: {{ number_format($totalTenagaKerja, 0, ',', '.') }}</p>
    </div>

    <div class="section">
        <h2>Total Harga Produksi</h2>
        <p class="total">Total: {{ number_format($totalHargaProduksi, 0, ',', '.') }}</p>
        <p>Jumlah Produksi: {{ $jumlahProduksi }}</p>
        <p>Waktu Produksi: {{ $waktuProduksi }} hari</p>
        <p>Harga Produksi per Unit: {{ number_format($hargaPerUnit, 0, ',', '.') }}</p>
    </div>
</body>
</html>
