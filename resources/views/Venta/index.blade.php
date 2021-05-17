@extends('Layout.Elements.plantilla_dashboard')
<link href="{{ asset('css/custom/nv_venta.css') }}" rel="stylesheet">


@section('contenido')
<div class="panel">
    <h2 class="panel-title">Nueva venta</h2>
</div>

<div class="panel panel_botones">
    <form action="/venta/cancelar" method="POST">
        @csrf
        <button class="btn_general btn_cancelar d-flex align-items-center justify-content-center">
        <i class="material-icons">close</i>&nbsp;
        <i>Cancelar la venta</i>    
        </button>
    </form>    
    @if (!empty($parametros['productos_venta']))
    <form action="{{route('venta.show',session('venta_id'))}}">
        @csrf
        <button class="btn_general btn_ver d-flex align-items-center justify-content-center">
            <i class="material-icons" >visibility</i>
            <i>Ver venta</i>
        </button>
    </form>
    @endif
</div>

@if ($parametros['productos'])
<div class="tbl_panel">
    <table class="tbl_stock">
        <thead>
            <tr>
                <th class="sticky">Marca</th>
                <th class="sticky">Modelo</th>
                <th class="sticky">Precio</th>
                <th class="sticky">Foto</th>
                <th class="sticky"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($parametros['productos'] as $producto)
            <tr>
                <td>{{ $producto->marca }}</td>
                <td>{{ $producto->modelo }}</td>
                <td>{{ number_format($producto->precio, 2)." €" }}</td>
                <td class="td_imagen"><img style="height: 4em" src="{{ $producto->foto }}" alt="{{ $producto->modelo }}"> </td>
                <td>
                    <a class="btn_accion btn_seleccion d-flex align-items-center justify-content-center" href="{{ route('producto.show',$producto->id) }}">                        
                        <i class="material-icons">add_task</i>&nbsp;
                        <i>Seleccionar</i>
                    </a>
                </td>
            </tr>
            @endforeach
    
        </tbody>
    </table>
</div>
@else
<div class="panel">
    <h1 class="panel-title">NO Productos</h1>
</div>
@endif


@endsection