<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Bahan Baku</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .content {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f4b084;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Laporan Bahan Baku</h1>
    <table class="content" style="margin-bottom: 30px;">
        <thead>
            <tr>
                <th class="content">KODE BAHAN BAKU</th>
                <th class="content">NAMA BAHAN BAKU</th>
                <th class="content">SATUAN</th>
                <th class="content">HARGA SATUAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bahanBakus as $bahanBaku)
                <tr>
                    <td class="content">{{ $bahanBaku->kode_bahan_baku }}</td>
                    <td class="content">{{ $bahanBaku->nama_bahan_baku }}</td>
                    <td class="content">{{ $bahanBaku->satuan }}</td>
                    <td class="content">Rp. {{ number_format($bahanBaku->harga_satuan, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer Section -->
    <div class="footer">
        <table>
            <tr>
                <td></td>
                <td><p>{{ date('d-m-Y') }}</p></td>
            </tr>
            <tr>
                <td><strong>Pimpinan</strong></td>
                <td><strong>Admin Keuangan</strong></td>
            </tr>
        </table>
    </div>
</body>
</html>