<x-dashboard.layout :title="'Edit Data Penyewaan'">
    <div class="box-form">
        <h1>Edit Data Penyewaan</h1>

        <form action="{{ route('penyewaan.update', $penyewaan->id) }}" method="post">
            @csrf
            @method('put')
            <div>
                <label for="id_lapangan">No Lapangan</label>
                <select name="id_lapangan" id="id_lapangan">
                    <option value="">-- Pilih Lapangan --</option>
                    @foreach ($lapangans as $lapangan)
                        @if ($lapangan->status == 'tersedia')
                            <option value="{{ $lapangan->id }}"
                                @if ($penyewaan->id_lapangan == $lapangan->id) {{ 'selected' }} @endif>
                                {{ $lapangan->no_lapangan }}
                            </option>
                        @endif
                    @endforeach
                </select>
                @error('id_lapangan')
                    <small class="text-validation-error">{{ $message }}</small>
                @enderror
            </div>
            <div>`
                <label>Harga per Jam</label>
                <input type="text" id="harga_per_jam"
                    value="{{ 'Rp ' . number_format($penyewaan->harga_per_jam) . ',00' }}" readonly>
            </div>
            <div>
                <label for="lama_sewa">Lama Sewa (Jam)</label>
                <input type="number" name="lama_sewa" id="lama_sewa" value="{{ $penyewaan->lama_sewa }}">
                @error('lama_sewa')
                    <small class="text-validation-error">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="total_harga">Total Harga</label>
                <input type="text" id="total_harga" class="form-control"
                    value="{{ 'Rp. ' . number_format($penyewaan->total_harga) }}" readonly>
            </div>
            <div>
                <label for="uang_bayar">Uang Bayar</label>
                <input type="number" name="uang_bayar" id="uang_bayar" value="{{ $penyewaan->uang_bayar }}">
                @error('uang_bayar')
                    <small class="text-validation-error">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="tanggal_sewa">Tanggal Sewa</label>
                <input type="date" name="tanggal_sewa" id="tanggal_sewa"
                    value="{{ Carbon\Carbon::parse($penyewaan->tanggal_sewa)->translatedFormat('Y-m-d') }}">
                @error('tanggal_sewa')
                    <small class="text-validation-error">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="jam_sewa">Jam Sewa</label>
                <input type="time" name="jam_sewa" id="jam_sewa"
                    value="{{ Carbon\Carbon::parse($penyewaan->tanggal_sewa)->translatedFormat('H:i') }}">
                @error('jam_sewa')
                    <small class="text-validation-error">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for=""></label>
                <input type="submit" value="Edit" class="submit-btn">
            </div>
            <div>
                <label for=""></label>
                <a href="{{ route('penyewaan.index') }}" class="btn btn-back">Kembali</a>
            </div>
        </form>
    </div>

    <script>
        let noLapanganSelect, hargaPerJamInput, lamaSewaInput, totalHargaInput

        let idLapangan, xhr, lapangan, hargaPerJam, totalHarga

        noLapanganSelect = document.getElementById('id_lapangan')
        hargaPerJamInput = document.getElementById('harga_per_jam')
        lamaSewaInput = document.getElementById('lama_sewa')
        totalHargaInput = document.getElementById('total_harga')

        let idIDR = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
        });

        // set initial harga per jam
        hargaPerJamInput.setAttribute('data-harga-per-jam', {{ $penyewaan->harga_per_jam }})

        noLapanganSelect.addEventListener('input', () => {
            idLapangan = noLapanganSelect.value

            if (idLapangan !== '') {

                // create ajax object
                xhr = new XMLHttpRequest()

                // cek kesiapan ajax
                xhr.onreadystatechange = function() {

                    hargaPerJamInput.value = 'Loading...'

                    if (xhr.readyState == 4 && xhr.status == 200) {

                        lapangan = JSON.parse(xhr.responseText)

                        hargaPerJam = parseInt(lapangan.harga_per_jam)

                        hargaPerJamInput.value = idIDR.format(hargaPerJam)
                        hargaPerJamInput.setAttribute('data-harga-per-jam', hargaPerJam)

                        if (lamaSewaInput.value !== '') {
                            console.log(hargaPerJam)
                            totalHargaInput.value = idIDR.format(hargaPerJam * parseInt(lamaSewaInput.value))
                        }
                    }

                }

                xhr.open("GET", `/getLapangan/${idLapangan}`, true)
                xhr.send()
            } else {
                hargaPerJamInput.value = "Rp 0"
                totalHargaInput.value = "Rp 0"
            }
        });

        lamaSewaInput.addEventListener('keyup', key => {
            key = key.key

            let numberList = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]

            hargaPerJam = hargaPerJamInput.getAttribute('data-harga-per-jam')

            if (hargaPerJam != '' && hargaPerJam != null) {

                hargaPerJam = parseInt(hargaPerJam)
                lamaSewa = parseInt(lamaSewaInput.value)

                totalHarga = hargaPerJam * lamaSewa

                if (key in numberList) {
                    totalHargaInput.value = idIDR.format(totalHarga)
                } else if (key == 'Backspace') {
                    if (lamaSewaInput.value != '') {
                        totalHargaInput.value = idIDR.format(totalHarga)
                    } else {
                        totalHargaInput.value = 'Rp 0'
                    }
                }
            }
        });
    </script>
</x-dashboard.layout>
