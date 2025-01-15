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
    <h1 style="text-align: center;">Laporan Overhead Pabrik</h1>
    <table class="content" style="margin-bottom: 30px;">
        <thead>
            <tr>
                <th class="content">KODE OVERHEAD PABRIK</th>
                <th class="content">NAMA OVERHEAD PABRIK</th>
                <th class="content">SATUAN</th>
                <th class="content">HARGA SATUAN</th>
                <th class="content">KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach($overheadPabriks as $overheadPabrik)
                <tr>
                    <td class="content">{{ $overheadPabrik->kode_overhead }}</td>
                    <td class="content">{{ $overheadPabrik->nama_overhead }}</td>
                    <td class="content">{{ $overheadPabrik->satuan }}</td>
                    <td class="content">Rp. {{ number_format($overheadPabrik->harga_satuan, 2) }}</td>
                    <td class="content">{{ $overheadPabrik->keterangan }}</td>
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