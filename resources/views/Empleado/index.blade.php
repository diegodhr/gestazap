@extends('Layout.Elements.plantilla')
{{-- @dump( $empleados) --}}
{{-- @if ($empleados)
    {{ "hay algo" }}
    @dump($empleados)
@else
    {{ "no hay nada" }}
@endif --}}

{{-- @foreach ($empleados as $empleado)
    {{ $empleado }}
@endforeach --}}

{{-- @dump($parametros) --}}

@section('contenido')
<h1>Empleados</h1>
@if ($parametros['empleados']->isNotEmpty())
    <table class="table table-striped">
        <thead>
            <tr>
                <th>num_empleado</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Fecha de nacimiento</th>
                <th>Fecha de contratación</th>
                <th>teléfono</th>
                <th>email</th>
                <th>categoria</th>
                <th>rol</th>
            </tr>
        </thead>
        <tbody>            
            @foreach ($parametros['empleados'] as $empleado)
            <tr>
                <td>{{$empleado->num_empleado}}</td>
                <td>{{$empleado->nombre}}</td>
                <td>{{$empleado->apellido}}</td>
                <td>{{$empleado->dni}}</td>
                <td>{{$empleado->fecha_nacimiento}}</td>
                <td>{{$empleado->fecha_inicio}}</td>
                <td>{{$empleado->telefono}}</td>
                <td>{{$empleado->email}}</td>
                <td>{{$empleado->categoria->nombre}}</td>
                <td>{{$empleado->rol->tipo}}</td>
            </tr>
            @endforeach
        </tbody>
            
    </table>
@else
    <h1>No hay empleados</h1>
@endif

<a href="empleado/create" class="btn btn-primary">Agregar nuevo empleado</a>
<a href="../" class="btn btn-primary">Volver</a>
    
@endsection
