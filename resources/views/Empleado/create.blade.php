@extends('Layout.Elements.plantilla')
{{-- <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet"> --}}

{{-- @section('cabecera')
@endsection --}}

{{-- @section('contenido') --}}

{{-- @dump(request()->route()->getName()) --}}
{{-- $price = Arr::get($array, 'products.desk.price');
$names = Arr::pluck($array, 'developer.name'); --}}
{{-- @dump($parametros) --}}
@section('contenido')
<div class="row h-100 justify-content-center align-items-center">
    <div class="col-md-8 col-md-offset-8 form-login">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title">Nuevo Usuario</h1>
                <br>
            </div>
            <div class="panel-body">
                <form action="/dashboard/empleado " method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input class="form-control" value="{{ old('nombre') }}" type="text" name="nombre"
                            placeholder="Nombre del empleado" id="nombre" autofocus>
                    </div>
                    @error('nombre')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <br>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input class="form-control" value="{{ old('apellido') }}" type="text" name="apellido"
                            placeholder="Apellido del empleado" id="apellido">
                    </div>
                    @error('apellido')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <br>
                    <div class="form-group">
                        <label for="dni">DNI</label>
                        <input class="form-control" value="{{ old('dni') }}" type="text" name="dni" placeholder="DNI"
                            id="dni">
                    </div>
                    @error('apellido')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <br>
                    <div class="form-group">
                        <label for="fnacimiento">Fecha de nacimiento</label>
                        <input class="form-control" value="{{ old('fnacimiento') }}" type="date" name="fnacimiento"
                            placeholder="Fecha de nacimiento del empleado" id="fnacimiento">
                    </div>
                    @error('fnacimiento')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <br>
                    <div class="form-group">
                        <label for="finicio">Fecha de contratación</label>
                        <input class="form-control" value="{{ old('finicio') }}" type="date" name="finicio"
                            placeholder="Fecha de contratacion" id="finicio">
                    </div>
                    @error('finicio')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <br>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input class="form-control" value="{{ old('telefono') }}" type="text" name="telefono"
                            placeholder="Teléfono" id="telefono">
                    </div>
                    @error('telefono')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <br>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" value="{{ old('email') }}" type="email" name="email"
                            placeholder="Email" id="email">
                    </div>
                    @error('email')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <br>
                    {{-- @dump(data_get($parametros,'roles')) --}}
                    <div class="form-group">
                        <label for="rol">Rol de usuario</label>
                        <select class="form-select" aria-label="Default select example" id="rol" name="rol">
                            @foreach (data_get($parametros,'roles') as $rol)
                            <option value={{ $rol['id'] }} selected> {{ $rol['tipo'] }} </option>
                            @endforeach
                        </select>
                    </div>
                    @error('rol')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <br>
                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <select class="form-select" aria-label="Default select example" id="categoria" name="categoria">
                            @foreach (data_get($parametros,'categorias') as $categoria)
                            <option value={{ $categoria['id'] }} selected> {{ $categoria['nombre'] }} </option>
                            @endforeach
                        </select>
                    </div>
                    @error('categoria')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <br>



                    {{-- fecha_inicio	telefono email	categoria_id	 --}}

                    <br><button class="btn btn-primary col-md-12" type="submit">Agregar</button>
                    @error('acceso')
                    <br><small class="text-danger">{{ $message }}</small>
                    @enderror
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- @endsection --}}