<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categoria</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
</head>
<body>
    <form method="POST">
        @csrf
        <div class="form-group">
            <label for="id_nombre">Nombre categoria</label>
            <input type="text" name="nombre" id="id_nombre">
        </div>
        <div class="form-group">
            <label for="salario">Salario</label>
            <input type="text" name="salario" id="salario">
        </div>
        <br><button class="btn btn-primary col-md-12" type="submit">Nueva</button>
    </form>
</body>
</html>