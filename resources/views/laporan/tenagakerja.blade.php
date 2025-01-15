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
                <th class="content">KODE TENAGA KERJA</th>
                <th class="content">NAMA TENAGA KERJA</th>
                <th class="content">UPAH / BULAN</th>
                <th class="content">BAGIAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tenagaKerjas as $tenagaKerja)
                <tr>
                    <td class="content">{{ $tenagaKerja->kode_tenaga_kerja }}</td>
                    <td class="content">{{ $tenagaKerja->nama_tenaga_kerja }}</td>
                    <td class="content">Rp. {{ number_format($tenagaKerja->upah, 2) }}</td>
                    <td class="content">{{ $tenagaKerja->bagian }}</td>
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