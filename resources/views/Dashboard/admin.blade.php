@extends('Layout.Elements.plantilla_dashboard')
<link href="{{ asset('css/custom/db_inicio.css') }}" rel="stylesheet">

@section('cabecera')

@endsection

@section('contenido')
<div class="container-fluid d-flex align-items-center justify-content-center lienzo">
    <div class="panel">
        <h1 class="panel-title">Bienvenido {{ $parametros['usuario']['name'] }}</h1>
        <a class="btn_gestion btn_accion" href="dashboard/producto">Gestionar el stock</a>
    </div>
</div>
@endsection