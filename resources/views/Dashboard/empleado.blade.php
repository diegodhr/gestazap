@extends('Layout.Elements.plantilla_dashboard')
<link href="{{ asset('css/custom/db_inicio.css') }}" rel="stylesheet">

@section('cabecera')
@endsection

@section('contenido')
<div class="container-fluid d-flex align-items-center justify-content-center lienzo">
    <div class="panel">
        <h1 class="panel-title">Bienvenido {{ $parametros['usuario']['name'] }}</h1>
        <form class="btn_gestion" action="/venta">
            @csrf
            <button class="btn_accion">Nueva venta</button>
        </form>
    </div>
</div>
@endsection