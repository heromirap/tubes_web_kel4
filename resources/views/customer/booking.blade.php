<x-customer.layout :title="'Booking'" :notificationCount="$notificationCount">
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h2 fw-bold mb-5 mx-1 mx-md-4 mt-4">Booking Lapangan</p>

                                    <form class="mx-1 mx-md-4" action="/booking" method="POST">
                                        @csrf
                                        {{-- <select class="form-select" name="id_member" aria-label="Default select example">
                      <option>Member</option>
                      <option value="<?= '' ?>"><?= 'nama' ?></option>
                      <label for="">Pilih Member</label>
                    </select> --}}
                                        <div class="d-flex flex-row align-items-center mb-1">
                                            <select class="form-select mt-4 mb-4" name="id_lapangan"
                                                aria-label="Default select example" id="id_lapangan">
                                                <option value="">-- Pilih Lapangan --</option>
                                                @foreach ($lapangans as $lapangan)
                                                    <option value="{{ $lapangan->id }}">
                                                        {{ $lapangan->no_lapangan }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <div class="form-outline flex-fill mb-0 " style="width: 100%;">
                                                <input type="text" id="harga_per_jam" class="form-control" readonly>
                                                <label id="harga_per_jam">Harga per Jam</label>
                                            </div>
                                        </div>


                                        <div class="d-flex flex-row align-items-center mb-2"
                                            style="width: 340px; margin-left: -17px;">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0 " style="width: 100%;">
                                                <input type="date" id="form3Example4c" name="tanggal_sewa"
                                                    class="form-control" />
                                                <label class="form-label" for="form3Example4c">Tanggal Sewa</label>
                                                @error('tanggal_sewa')
                                                  <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-2"
                                            style="width: 340px; margin-left: -17px;">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0 " style="width: 100%;">
                                                <input type="time" id="form3Example4c" name="jam_sewa"
                                                    class="form-control" />
                                                <label class="form-label" for="form3Example4c">Jam Sewa</label>
                                                @error('jam_sewa')
                                                  <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-2"
                                            style="width: 340px; margin-left: -17px;">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0 " style="width: 100%;">
                                                <input type="number" id="lama_sewa" name="lama_sewa"
                                                    class="form-control" />
                                                <label class="form-label" for="lama_sewa">Lama Sewa (jam)</label>
                                                @error('lama_sewa')
                                                  <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div>
                                            <input type="text" id="total_harga" class="form-control" readonly>
                                            <label for="total_harga">Total Harga</label>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4"
                                            style="width: 340px; margin-left: -17px;">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="number" id="form3Example4cd" name="uang_bayar"
                                                    class="form-control" />
                                                <label class="form-label" for="form3Example4cd">Uang Bayar</label>
                                                @error('uang_bayar')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- <div class="ms-1">
                      <a href="member.php">Become a member</a>
                    </div> --}}

                                        <div class="d-flex justify-content-center mb-3 mb-lg-4 mt-2">
                                            <button type="submit" class="btn btn-success btn-lg"
                                                style="width: 500px;">Booking</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                            // console.log(totalHargaInput)
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
</x-customer.layout>
