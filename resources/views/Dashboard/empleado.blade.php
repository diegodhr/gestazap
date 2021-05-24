@extends('Layout.Elements.plantilla_dashboard')
<link href="{{ asset('css/custom/db_inicio.css') }}" rel="stylesheet">

@section('cabecera')
@endsection

@section('contenido')
@if (Session::has('venta_cancelada'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">&times;</span></span>
    <strong>{{ Session::get('venta_cancelada') }}</strong>
</div>
@endif
@if (Session::has('venta_finalizada'))
<div class="alert alert-success alert-dismissible" role="alert">
    <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">&times;</span></span>
    <strong>{{ Session::get('venta_finalizada') }}</strong>
</div>
@endif
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
@php
Session::forget('venta_cancelada');
Session::forget('venta_finalizada');
@endphp