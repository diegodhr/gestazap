<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @dump($parametros)
    <title>{{ request()->route()->getName() }}</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    {{-- <link rel="icon" href="{{ asset('images/favicon.ico') }}"> --}}
    <style>
        html,
        body {
            height: 100%;
        }

        main {
            height: 100%;
        }

        .form-login {
            background-color: rgba(194, 219, 247, 0.562);
            border-radius: .5em;
            padding: 1em;
        }
    </style>
</head>

<body>
    <header>
        @yield('cabecera')
    </header>
    <main class="container">
        @yield('contenido')
    </main>
    <footer>
        @yield('pie')
    </footer>
</body>

</html>