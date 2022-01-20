<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

    </style>
</head>

<body>

    <h2>Laporan transaksi {{ \Carbon\Carbon::parse($date)->translatedFormat('F Y') }}</h2>

    <table>
        <tr>
            <th>Kode Transaksi</th>
            <th>Harga</th>
            <th>Tanggal</th>
        </tr>
        @forelse ($report as $r)
        <tr>
            <td>{{ $r->code }}</td>
            <td>{{ number_format($r->price_total,2,".",",") }}</td>
            <td>{{ $r->date }}</td>
        </tr>
        @empty
        @endforelse
        <tr>
            <td>Total </td>
            <td colspan="2">{{ number_format($total,2,".",",") }}</td>
        </tr>
    </table>

</body>

</html>
