<!DOCTYPE html>
<html>
<head>
    <title>Struk Klinik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .info {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
        }

        .total {
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Klinik ABC</h1>
        <p>Jalan Kesehatan No. 123</p>
        <p>Kota Sehat, Negara Medis</p>
        <p>Telp: (012) 345-6789</p>
    </div>

    <div class="info">
        <p>Tanggal: {{ $vitalSign->Tanggal_Pembayaran }}</p>
        <p>Nomor Antrian: {{ $vitalSign->Nomor_antrian }}</p>
    </div>

    <div class="info">
        <h3>Nama Pasien: {{ $vitalSign->Nama_pasien }}</h3>
        <h3>Nomor Tindakan Medis: {{ $vitalSign->id_tindakan_medis }}</h3>
    </div>

    <table>
        <tr>
            <th>Deskripsi Layanan</th>
            <th>Harga</th>
        </tr>
        @foreach ($obat  as $item)
        <tr>
                <td>{{ $item->nama_obat }}</td>
                <td>Rp {{ number_format($item->harga_obat, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>

    <div class="total">
        <h2>Total: {{ $vitalSign->total_pembayaran }}</h2>
    </div>
</body>
</html>