@extends('Layout.Elements.plantilla_dashboard')
<link href="{{ asset('css/custom/buscar.css') }}" rel="stylesheet">

@section('contenido')
<div class="panel">
    <h3 class="panel-title">Buscando producto</h3>
</div>
<div class="panel">
    <a href="../producto" class="btn_accion btn_volver d-flex align-items-center justify-content-center">
        <i class="material-icons">arrow_back</i>&nbsp;
        <i>Volver</i>
    </a>
    <form class="form_buscar" action="/dashboard/producto/buscar" method="post">
        @csrf
        <input class="txt_busqueda" type="text" name="criterio" id="id_criterio"
            placeholder="marca y modelo de zapatilla">
        <button class="btn_accion d-flex align-items-center justify-content-center" type="submit">
            <i class="material-icons">search</i>&nbsp;
            <i>Buscar</i>
        </button>
    </form>
</div>
@if ($parametros['busqueda'] != null)
<div class="panel panel_res">    
        @foreach ($parametros['busqueda'] as $key => $producto)
        @if ($producto)
        <form action="/dashboard/producto/guardar_producto" method="post" class="card" style="width: 18rem;">
            @csrf
            @php
            $producto['tienda'] = $key;
            @endphp
            <input type="hidden" name="producto" value="{{json_encode($producto,TRUE)}}">
            <h5 class="card-title">{{ $key }}</h5>
            <img src="{{$producto['imagen']}}" class="card-img" alt="{{$producto['modelo']}}">
            <div class="card-body">
                <h5 class="lbl_marca">{{ $producto['marca'] }}</h5>
                <p class="card-text">{{ $producto['modelo'] }}</p>
                <p class="card-text">{{ number_format($producto['precio'], 2)." €"}}</p>
            </div>
            <label class="lbl_datos" for="id_unidades">Unidades</label>
            <input class="txt_datos" type="number" name="unidades" id="id_unidades">
            <label class="lbl_datos" for="id_talla">Talla</label>
            <input class="txt_datos" type="number" name="talla" id="id_talla">
            <button class="btn_accion btn_agregar d-flex align-items-center justify-content-center" type="submit">
                <i class="material-icons">add_circle_outline</i>
                <i>Agregar</i>
            </button>
        </form>
        @endif
        @endforeach    
</div>
@else
<div class="panel">
    <h1 class="panel-title">No hay zapatilla</h1>
</div>
@endif




{{-- @if ($parametros['busqueda'] != null)
<div class="row h-100 justify-content-center align-items-top">
    @foreach ($parametros['busqueda'] as $key => $producto)
    @if ($producto)
    <form action="/dashboard/producto/guardar_producto" method="post" class="card" style="width: 18rem;">
        @csrf
        @php
        $producto['tienda'] = $key;
        @endphp
        <input type="hidden" name="producto" value="{{json_encode($producto,TRUE)}}">
<h5 class="card-title">{{ $key }}</h5>
<img src="{{$producto['imagen']}}" class="card-img-top" alt="{{$producto['modelo']}}">
<div class="card-body">
    <h5 class="card-title">{{ $producto['marca'] }}</h5>
    <p class="card-text">{{ $producto['modelo'] }}</p>
    <p class="card-text">{{ $producto['precio'] }}</p>
</div>
<label for="id_unidades">Unidades</label>
<input type="number" name="unidades" id="id_unidades">
<label for="id_talla">Talla</label>
<input type="number" name="talla" id="id_talla">
<button class="btn btn-primary col-md-12" type="submit">Agregar</button>
</form>
@endif
@endforeach
</div>
@endif --}}



@endsection