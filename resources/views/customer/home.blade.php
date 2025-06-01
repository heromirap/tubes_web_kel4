<x-customer.layout :notificationCount="$notificationCount">
    <div class="container" style="margin-top: 139px;">
        <div class="d-flex justify-content-space-between mt-5 main-content">
            <div class="1 me-5">

                <x-flash-message />

                <h1 class="title">Selamat datang di Courtyz Footsal!</h1>
                <h5 class="mt-5 text-opacity-75 text-muted copywriting" style="text-indent: 10px; text-align: justify;">Temukan
                    kemudahan untuk memesan lapangan footsal hanya dengan beberapa tap! Aplikasi kami menawarkan platform
                    yang mudah digunakan dan tanpa hambatan untuk semua kebutuhan footsalmu. Baik jika kamu ingin memesan
                    lapangan untuk bermain bersama teman-teman atau untuk turnamen yang kompetitif, kami siap
                    membantumu.</h5>
                <a href="/booking" class="btn btn-success btn-booking-now">Pesan Sekarang</a>
            </div>
            <div class="2">
                <img src="/img/lapangan-futsal.jpg" alt=""
                    style="max-width: 410px; 
              box-shadow: 34px 41px 1px -1px limegreen;
              -webkit-box-shadow: 34px 41px 1px -1px limegreen;
              -moz-box-shadow: 34px 41px 1px -1px limegreen;
              border-radius: 10px; 
              opacity: 0.9;">
            </div>

        </div>
    </div>


    {{-- <footer id="sticky-footer" class="d-flex justify-content-around flex-shrink-0 py-4 bg-dark text-white-50 bawahan"
        style="margin-top: 100px;">
        <div class="text-white satu" style="margin-left: -100px; width: 350px; text-align: justify;">
            <div class="fs-5 mb-2 fw-semibold">Courtyz Futsal</div>
            <div class="fs-5">Tentang</div>
            <div class="text-white text-opacity-75" style="text-indent: 10px;">Lorem ipsum dolor sit amet, consectetur
                adipiscing elit. Curabitur lobortis nisi eget turpis fermentum, at pulvinar elit auctor. Sed in posuere
                purus. Curabitur at placerat mi. Aliquam laoreet commodo erat at molestie.</div>
        </div>

        <div class="text-white contact">
            <div class="fs-5 mb-2 fw-semibold">Contact Us</div>
            <div class="text-white text-opacity-75">1111111</div>
            <div class="text-white text-opacity-75">Kota Depok, Jawa Barat, 16454</div>
            <div class="mt-3 text-white text-opacity-75">futsal@Courtyz.com</div>
            <div class="text-white text-opacity-75">0882-1308-2159</div>
            <div>
                <img src="/img/fb.png" alt="" style="width: 20px">
                <img src="/img/ig.png" alt="" style="width: 17px">
                <img src="/img/yt.png" alt="" style="width: 18px; margin-left: 2px;">
            </div>
        </div>
    </footer> --}}
</x-customer.layout>
