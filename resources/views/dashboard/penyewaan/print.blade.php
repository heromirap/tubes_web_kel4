<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Data Penyewaan</title>
    {{-- <link rel="stylesheet" href="/css/style.css"> --}}
    <style>

      body {
        font-family: Arial, Helvetica, sans-serif
      }

      .page-title {
        text-align: center
      }

      table {
        width: 100%;
      }

      table, th, td {
        padding: 10px;
        border-collapse: collapse;
        border: 1px solid #000;
      }

      td:first-child ,td:last-child {
        width: 1%;
        text-align: center;
      }

      @media print {
        @page {
          size: auto;
          /* margin: 0; */
          padding: 10px;
        }

        body {
        }
      }
    </style>
</head>

<body onload="window.print()">

    <div class="page-title">
        <h1>Data Penyewaan</h1>
    </div>
    <table>
        <tr>
            <th>No</th>
            <th>No Lapangan</th>
            <th>Username</th>
            <th>Nama Penyewa</th>
            <th>Tanggal Sewa</th>
            <th>Harga per Jam</th>
            <th>Lama Sewa (jam)</th>
            <th>Total Harga</th>
            <th>Uang Bayar</th>
            <th>Uang Kembalian</th>
        </tr>

        @foreach ($penyewaans as $penyewaan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $penyewaan->lapangan->no_lapangan }}</td>
                <td>{{ $penyewaan->customer->username }}</td>
                <td>{{ $penyewaan->customer->name }}</td>
                <td>{{ Carbon\Carbon::parse($penyewaan->tanggal_sewa)->translatedFormat("l, d F Y") }}</td>
                <td>{{ 'Rp. ' . number_format($penyewaan->harga_per_jam) }}</td>
                <td>{{ $penyewaan->lama_sewa }}</td>
                <td>{{ 'Rp. ' . number_format($penyewaan->total_harga) }}</td>
                <td>{{ 'Rp. ' . number_format($penyewaan->uang_bayar) }}</td>
                <td>{{ 'Rp. ' . number_format($penyewaan->uang_kembalian) }}</td>
            </tr>
        @endforeach
    </table>

    <script>
      addEventListener('afterprint', () => [
        window.close()
      ])
    </script>

</body>

</html>
