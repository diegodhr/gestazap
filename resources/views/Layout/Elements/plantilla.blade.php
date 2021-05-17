<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">    
    <title> {{ $parametros['titulo'] }} </title>    
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom/basic.css') }}" rel="stylesheet">
</head>

<body>
    <header>
        @yield('cabecera')
    </header>
    <main class="container-fluid">
        @yield('contenido')
    </main>
    <footer>
        @yield('pie')
    </footer>
</body>

</html>