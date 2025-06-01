@props(['title'])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewsport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    {{-- <link rel="stylesheet" href="/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css"> --}}
    {{-- <link rel="icon" href="assets/img/Gudang_Garam-2.png"> --}}
    <link rel="icon" href="/img/ball.png">
    <title>Icall Footsal | {{ $title ?? 'Home' }}</title>
</head>

<body>
    <header class="header">
        <div class="container">
            <div class="jumbotron">
                <h1 class="title" title="Icall Punya">Penyewaan Lapangan Futsal</h1>
            </div>
        </div>
    </header>

    <nav class="navbar">
        <div class="container">
            <ul>
                <li><a href="/dashboard" class="{{ Request::is('dashboard') ? 'nav-active' : '' }}">Home</a></li>
                <li><a href="/dashboard/lapangan"
                        class="{{ Request::is('dashboard/lapangan') ? 'nav-active' : '' }}">Lapangan</a></li>
                <li><a href="/dashboard/penyewaan" class="{{ Request::is('dashboard/penyewaan') ? 'nav-active' : '' }}">Penyewaan</a></li>
                <li>
                    <form action="/logout" method="post">
                        @csrf
                        <a href=""><button type="submit" style="cursor: pointer;" onclick="return confirm('anda yakin ingin logout?')">Logout</button></a>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            {{ $slot }}
        </div>
    </main>

   
</body>

</html>
