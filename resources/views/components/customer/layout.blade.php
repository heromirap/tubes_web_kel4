@props(['title', 'notificationCount'])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css --}}
    {{-- "> --}}
    <link rel="icon" href="/img/ball.png">
    @if (Request::is('/'))
        <style>
            .alert-message {
                width: 100%;
                background-color: var(--main-color);
                color: #fff;
                padding: 10px;
                border-radius: 3px;

                margin: 10px 0;

                display: flex;
                justify-content: space-between;
            }

            .alert-message .close {
                cursor: pointer;

                user-select: none;
                -moz-user-select: none;
                -webkit-user-select: none;
            }

            .alert-message .close:hover {
                color: #ccc;
            }

            .title {
                text-align: center;
            }
        </style>
    @endif
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <title>Coutyz Footsal | {{ $title ?? 'Home' }}</title>
    <style>
        @media screen and (max-width: 765px) {
            .main-content {
                flex-direction: column;
            }

            /* .main-content > .copywriting {
                width: 100%;
            } */

            .btn-booking-now {
                margin-bottom: 20px;
            }

            .bawahan {
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .bawahan>.satu {
                margin-left: 0;
            }

            .bawahan>.contact {
                margin-top: 50px;
                margin-left: -235px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a href="/">
                <img class="me-2" src="img/ball.png" alt="" style="width: 60px;">
            </a>
            <a class="navbar-brand text-secondary" href="/">Courtyz Footsal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link link-secondary {{ Request::is('/') ? 'link-dark' : '' }}"
                            href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-secondary {{ last(explode('/', url()->current())) == 'lapangan' ? 'link-dark' : '' }}"
                            href="/lapangan">Lapangan</a>
                    </li>
                    @can('is_customer')
                        <li class="nav-item">
                            <a class="nav-link link-secondary {{ last(explode('/', url()->current())) == 'booking' ? 'link-dark' : '' }}"
                                href="/booking">Booking</a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link link-secondary {{ last(explode('/', url()->current())) == 'penyewaan' ? 'link-dark' : '' }}"
                                href="/penyewaan">Penyewaan</a>
                        </li>
                    @endcan
                </ul>
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="btn btn-success" href="/register">Daftar</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link link-success" href="/login">Login</a>
                        </li>
                    @endguest

                    @can('is_customer')
                        <li class="nav-item">
                            <a href="/notifications" class="btn btn-info">
                                Notifications
                                <span class="badge badge-light rounded-circle"
                                    style="background-color: rgb(72, 240, 72);">{{ $notificationCount }}</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <form action="/logout" method="post">
                                @csrf
                                <button class="btn btn-warning" type="submit">Logout</button>
                            </form>
                        </li>
                    @endcan

                    @can('is_admin')
                        <li class="nav-item">
                            <a class="nav-link link-success" href="/dashboard">Dashboard admin</a>
                        </li>
                    @endcan
                </ul>
            </div>
        </div>
    </nav>
    <main class="badan">
        {{ $slot }}
    </main>

    <footer id="sticky-footer" class="d-flex justify-content-around flex-shrink-0 py-4 bg-dark text-white-50 bawahan"
        {{-- 139px --}}
        style="@if (Request::is('/')) margin-top: 139px; @else  margin-top: 50px; @endif">
        <div class="text-white satu" style="margin-left: -100px; width: 350px; text-align: justify;">
            <div class="fs-5 mb-2 fw-semibold">Courtyz Footsal</div>
            <div class="fs-5">Tentang</div>
            <div class="text-white text-opacity-75" style="text-indent: 10px;">Courtyz Futsal adalah platform pemesanan lapangan futsal yang praktis dan efisien. Melalui website ini, customer dapat dengan mudah melihat jadwal ketersediaan lapangan, melakukan pemesanan secara online,
                serta mendapatkan informasi terbaru mengenai promo dan event yang berlangsung di lapangan futsal pilihan mereka.</div>
        </div>

        <div class="text-white contact">
            <div class="fs-5 mb-2 fw-semibold">Contact Us</div>
            <div class="text-white text-opacity-75">Jalan teluk 1140</div>
            <div class="text-white text-opacity-75">Purwokerto, Jawa tengah, 1995</div>
            <div class="mt-3 text-white text-opacity-75">footsal@courtyz.com</div>
            <div class="text-white text-opacity-75">0812-0812-0812</div>
            <div>
                <img src="/img/fb.png" alt="" style="width: 20px">
                <img src="/img/ig.png" alt="" style="width: 17px">
                <img src="/img/yt.png" alt="" style="width: 18px; margin-left: 2px;">
            </div>
        </div>
    </footer>

    <script src="/bootstrap/js/bootstrap.js"></script>
</body>

</html>
