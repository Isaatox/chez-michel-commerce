<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('css/bootstrap.css') }}">
    <script src="{{ url('js/bootstrap.js') }}"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@3008display-swap" rel="stylesheet">
    <link rel="stylesheet" href="css/navcompte.css"/>
    <script src="https://kit.fontawesome.com/b78998cfc3.js" crossorigin="anonymous"></script>
    <title>Chez Michel</title>
</head>
<body>
@include('layouts.header')
<div class="main">
    @include('layouts.navCompteAdmin')
    @yield('content')
</div>
@include('layouts.footer')
</body>
</html>
