<x-dashboard.layout :title="'Penyewaan'">
    <div class="page-title">
        <h2>Penyewaan</h2>
    </div>

    <x-flash-message />

    <div>
        <a href="{{ route('penyewaan.create') }}" class="btn btn-primary">Tambah Data</a>
    </div>

    @if ($penyewaans->total())
        <table>
            <tr class="tr-header">
                <th>No</th>
                <th>No Lapangan</th>
                <th>Username</th>
                <th>Tanggal Sewa</th>
                <th>Harga per Jam</th>
                <th>Lama Sewa (jam)</th>
                <th>Total Harga</th>
                <th>Uang Bayar</th>
                <th>Uang Kembalian</th>
                <th>Status</th>
                <th colspan="2">Aksi</th>
            </tr>

            @foreach ($penyewaans as $penyewaan)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $penyewaan->lapangan->no_lapangan }}</td>
                    <td>{{ $penyewaan->customer->username }}</td>
                    <td>{{ Carbon\Carbon::parse($penyewaan->tanggal_sewa)->translatedFormat('l, d F Y') }} <span
                            title="Jam">{{ Carbon\Carbon::parse($penyewaan->tanggal_sewa)->translatedFormat('H:i') }}</span>
                    </td>
                    <td>{{ 'Rp. ' . number_format($penyewaan->harga_per_jam) }}</td>
                    <td>{{ $penyewaan->lama_sewa }}</td>
                    <td>{{ 'Rp. ' . number_format($penyewaan->total_harga) }}</td>
                    <td>{{ 'Rp. ' . number_format($penyewaan->uang_bayar) }}</td>
                    <td>{{ 'Rp. ' . number_format($penyewaan->uang_kembalian) }}</td>
                    <td>
                        @if ($penyewaan->status == 'belum dikonfirmasi')
                            <form action="/penyewaan/accept/{{ $penyewaan->id }}" method="post" class="inline">
                                @csrf
                                <button class="btn btn-primary" type="submit" onclick="return confirm('ada yakin ingin menerima pesanan ini')">Terima pesanan</button>
                            </form>
                            
                            <form action="/penyewaan/reject/{{ $penyewaan->id }}" method="post" class="inline">
                                @csrf
                                <button class="btn btn-danger" type="submit" onclick="return confirm('ada yakin ingin menolak pesanan ini')">Tolak pesanan</button>
                            </form>
                        @elseif ($penyewaan->status == 'pesanan diterima')
                            Pesanan Diterima
                        @elseif ($penyewaan->status == 'pesanan ditolak')
                            Pesanan Ditolak
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('penyewaan.edit', $penyewaan->id) }}" class="btn btn-primary">
                            Edit
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('penyewaan.destroy', $penyewaan->id) }}" method="post">
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

            @if ($penyewaans->total() > 10)
                <div class="pagination">
                    @for ($i = 1; $i <= $penyewaans->lastPage(); $i++)
                        <a href="{{ route('penyewaan.index') . "/?page=$i" }}"
                            class="link @if ($i == $penyewaans->currentPage()) link-active @endif">{{ $i }}</a>
                    @endfor
                </div>
            @endif
        </div>

        <script>
            let printBtn = document.getElementById('js-print-btn')
            let exportPdf = document.getElementById('js-export-pdf-btn')

            printBtn.addEventListener('click', () => {
                window.open('/dashboard/penyewaan/print')
            })

            exportPdf.addEventListener('click', () => [
                alert('Tekan tombol print lalu ubah tujuan menjadi Simpan Sebagai PDF')
            ])
        </script>
    @else
        <p class="text-data-empty">Data kosong</p>
    @endif
</x-dashboard.layout>
