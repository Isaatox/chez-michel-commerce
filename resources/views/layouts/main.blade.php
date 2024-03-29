<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ url('css/bootstrap.css') }}">
    <script src="{{ url('js/bootstrap.js') }}"></script>
    <script src="https://kit.fontawesome.com/b78998cfc3.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="{{ asset('image/chez_michel.png') }}" type="image/x-icon">
    <title>Chez Michel</title>
</head>

<body>
    @include('layouts.header')
    @yield('content')
    @include('layouts.footer')
</body>

</html>
