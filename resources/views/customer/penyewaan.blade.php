<x-customer.layout  :title="'Penyewaan'" :notificationCount="$notificationCount">
    <div class="container">
        <div class="mt-2"> {{-- page-title --}}
            <h2 class="" style="text-align: center;">Penyewaan</h2>
        </div>

        @if ($penyewaans->total())
            <table class="table table-striped mt-5">
                <tr class="tr-header">
                    <th>No</th>
                    <th>No Lapangan</th>
                    <th>Tanggal Sewa</th>
                    <th>Harga per Jam</th>
                    <th>Lama Sewa (jam)</th>
                    <th>Total Harga</th>
                    <th>Uang Bayar</th>
                    <th>Uang Kembalian</th>
                    <th>Status</th>
                </tr>

                @foreach ($penyewaans as $penyewaan)
                    <tr>
                        <td>{{ $counter++ }}</td>
                        <td>{{ $penyewaan->lapangan->no_lapangan }}</td>
                        <td>{{ Carbon\Carbon::parse($penyewaan->tanggal_sewa)->translatedFormat('l, d F Y') }} <span
                                title="Jam">{{ Carbon\Carbon::parse($penyewaan->tanggal_sewa)->translatedFormat('H:m') }}</span>
                        </td>
                        <td>{{ 'Rp. ' . number_format($penyewaan->harga_per_jam) }}</td>
                        <td>{{ $penyewaan->lama_sewa }}</td>
                        <td>{{ 'Rp. ' . number_format($penyewaan->total_harga) }}</td>
                        <td>{{ 'Rp. ' . number_format($penyewaan->uang_bayar) }}</td>
                        <td>{{ 'Rp. ' . number_format($penyewaan->uang_kembalian) }}</td>
                        <td>
                            @if ($penyewaan->status == 'belum dikonfirmasi')
                                Pesanan belum dikonfirmasi oleh admin
                            @elseif ($penyewaan->status == 'pesanan diterima')
                                Pesanan Diterima
                            @elseif ($penyewaan->status == 'pesanan ditolak')
                                Pesanan Ditolak
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>

            <div class="d-flex justify-content-end">
                {{ $penyewaans->links() }}
            </div>

            {{-- <div class="export">
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
        </script> --}}
        @else
            <p class="text-data-empty">Data kosong</p>
        @endif
    </div>
</x-customer.layout>
