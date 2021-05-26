<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ $parametros['titulo'] }} </title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom/basic.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom/dashboard.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/custom/buttons.css') }}" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
</head>

<body>
    {{-- @include('Layout.Navegacion.navbar') --}}
    <header>
        <a class="navbar-brand" href="">Deporzap</a>
        <form class="d-flex justify-content-end" action="/logout" method="POST">
            @csrf
            <button class="material-icons btn btn_salir">logout</button>
        </form>
        @yield('cabecera')
    </header>
    <main>
        @yield('contenido')
    </main>
    <footer>
        @yield('pie')
    </footer>

</body>

</html>