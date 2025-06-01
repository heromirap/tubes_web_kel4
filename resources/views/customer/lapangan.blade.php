<x-customer.layout :title="'Data lapangan'" :notificationCount="$notificationCount">
    <p class="fs-2 text-center mt-5 ">Daftar Lapangan</p>
    <hr class="mt-5">
    <div class="container">
        <div class="d-flex justify-content-between">
            <a class="ms-2 btn btn-success" href="/booking" role="button">Pesan Lapangan</a>

            <form action="/lapangan" method="get">
                <a href="/lapangan" class="link-success">Refresh</a>
                <input type="text" name="keyword" value="{{ request('keyword') }}">
                <button type="submit" class="btn btn-success">Search</button>
            </form>
        </div>

        <table class="mt-2 mb-4 table table-striped">
            <tr>
                <th>No</th>
                <th>No Lapangan</th>
                <th>Harga 1 Jam</th>
                <th>Harga 2 Jam</th>
                <th>Harga 3 Jam</th>
                <th>Deskripsi</th>
                <th>Status</th>
            </tr>
            @foreach ($lapangans as $lapangan)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $lapangan->no_lapangan }}</td>
                    <td>{{ 'Rp. ' . number_format($lapangan->harga_per_jam) }}</td>
                    <td>{{ 'Rp. ' . number_format($lapangan->harga_per_jam * 2) }}</td>
                    <td>{{ 'Rp. ' . number_format($lapangan->harga_per_jam * 3) }}</td>
                    <td>{{ $lapangan->deskripsi }}</td>
                    <td>{{ $lapangan->status }}</td>
                </tr>
            @endforeach
        </table>

        <div class="d-flex justify-content-end">
            {{ $lapangans->links() }}
        </div>
    </div>

</x-customer.layout>