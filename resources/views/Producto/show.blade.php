@extends('Layout.Elements.plantilla_dashboard')
<link href="{{ asset('css/custom/db_producto.css') }}" rel="stylesheet">

@section('contenido')
<div class="panel">
    @if (auth()->user()->rol_id == config('constantes.ROL.ADMINISTRADOR'))
    {{-- <a href="/dashboard/producto" class="btn btn-primary">Volver</a> --}}
    <a href="/dashboard/producto" class="btn_accion btn_volver d-flex align-items-center justify-content-center">
        <i class="material-icons">arrow_back</i>&nbsp;
        <i>Volver</i>
    </a>
    @else
    {{-- <a href="/venta" class="btn btn-primary">Volver</a> --}}
    <a href="/venta" class="btn_accion btn_volver d-flex align-items-center justify-content-center">
        <i class="material-icons">arrow_back</i>
        <i>Volver</i>&nbsp;
    </a>
    @endif
</div>

<div class="panel">
    @php
    $producto = $parametros['producto'];
    @endphp
    <div class="titulo_img">
        <div>
            <h2 class="panel-title">{{ $producto->marca }}</h2>
            <h3 class="panel-title">{{ $producto->modelo }}</h3>
        </div>
        @if (Session::has('nuevo_stock'))
        <div class="alert alert-info">{{ Session::get('nuevo_stock') }}</div>
        @endif

        @if (Session::has('res_talla'))
        @if (session('res_talla')==1)
        <div class="alert alert-danger">Ya existe esa talla</div>
        @else
        <div class="alert alert-info">Talla añadida correctamente</div>
        @endif
        @php
        Session::forget('res_talla');
        @endphp
        @endif

        <img src="{{ $producto->foto }}" alt="{{ $producto->modelo }}">
    </div>

    @if (auth()->user()->rol_id == config('constantes.ROL.ADMINISTRADOR'))
    @include('Producto.Formulario.stock')
    @else
    @include('Producto.Formulario.compra')
    @endif

</div>



@endsection