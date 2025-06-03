<x-dashboard.layout :title="'Lapangan'">
    <div class="page-title">
        <h2>Lapangan</h2>
    </div>

    <x-flash-message />

    <div>
        <a href="{{ route('lapangan.create') }}" class="btn btn-primary">Tambah Data</a>
    </div>

    @if ($lapangans->total())
        <table>
            <tr class="tr-header">
                <th>No</th>
                <th>No Lapangan</th>
                <th>Harga Sewa Per Jam</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th colspan="2">Aksi</th>
            </tr>

            @foreach ($lapangans as $lapangan)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $lapangan->no_lapangan }}</td>
                    <td>{{ 'Rp. ' . number_format($lapangan->harga_per_jam) }}</td>
                    <td>{{ $lapangan->deskripsi }}</td>
                    <td>{{ $lapangan->status }}</td>
                    <td>
                        <a href="{{ route('lapangan.edit', $lapangan->id) }}" class="btn btn-primary">
                            Edit
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('lapangan.destroy', $lapangan->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" type="submit"
                                onclick="return confirm('anda yakin ingin menghapus ini?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        <div class="export">
            <div>
                <button class="btn btn-primary export-btn" id="js-print-btn">Print</button>
                <button class="btn btn-primary export-btn" id="js-export-pdf-btn">Export PDF</button>
            </div>

            @if ($lapangans->total() > 10)
                <div class="pagination">
                    @for ($i = 1; $i <= $lapangans->lastPage(); $i++)
                        <a href="{{ route('lapangan.index') . "/?page=$i" }}"
                            class="link @if ($i == $lapangans->currentPage()) link-active @endif">{{ $i }}</a>
                    @endfor
                </div>
            @endif
        </div>

        <script>
            let printBtn = document.getElementById('js-print-btn')
            let exportPdf = document.getElementById('js-export-pdf-btn')

            printBtn.addEventListener('click', () => {
                window.open('/dashboard/lapangan/print')
            })

            exportPdf.addEventListener('click', () => [
                alert('Tekan tombol print lalu ubah tujuan menjadi Simpan Sebagai PDF')
            ])
        </script>
    @else
        <p class="text-data-empty">Data kosong</p>
    @endif
</x-dashboard.layout>
