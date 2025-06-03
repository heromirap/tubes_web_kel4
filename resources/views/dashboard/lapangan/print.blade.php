<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Data Lapangan</title>
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
        <h1>Data Lapangan</h1>
    </div>
    <table>
        <tr>
            <th>No</th>
            <th>No Lapangan</th>
            <th>Harga per Jam</th>
            <th>Deskripsi</th>
        </tr>

        @foreach ($lapangans as $lapangan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $lapangan->no_lapangan }}</td>
                <td>{{ $lapangan->harga_per_jam }}</td>
                <td>{{ $lapangan->deskripsi }}</td>
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
