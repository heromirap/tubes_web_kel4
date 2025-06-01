@props(['title'])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coutyz Footsal | {{ $title ?? 'Login Admin' }}</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    {{-- ADMIN LTE THEME --}}
    <link rel="stylesheet" href="/css/adminlte.min.css">
    <link rel="icon" href="/img/ball.png">
    <style>
        .form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 78vh;
        }

        @media (max-width: 768px) {
            .form {
                height: 105vh;
            }
        }
    </style>
</head>

<body>
  {{ $slot }}
</body>

</html>