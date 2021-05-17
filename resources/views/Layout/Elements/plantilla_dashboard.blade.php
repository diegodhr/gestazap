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
</head>

<body>
    {{-- @include('Layout.Navegacion.navbar') --}}
    <header>
        <a class="navbar-brand" href="dashboard">Deporzap</a>
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