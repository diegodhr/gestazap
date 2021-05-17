@extends('Layout.Elements.plantilla_dashboard')
<link href="{{ asset('css/custom/nv_carrito.css') }}" rel="stylesheet">

@section('contenido')
<div class="panel">
    <h1 class="panel-title">Ver carrito</h1>
</div>
<div class="panel panel_botones">
    <form action="/venta">
        @csrf
        <button class="btn_accion d-flex align-items-center justify-content-center" type="submit">
            <i class="material-icons">arrow_back</i>&nbsp;
            <i>Volver</i>
        </button>
    </form>
    <form action="{{route('venta.finalizar')}}" method="POST">
        @csrf
        <button class="btn_finalizar btn_general d-flex align-items-center justify-content-center" type="submit">
            <i class="material-icons">check_circle_outline</i>&nbsp;
            <i>Finalizar Compra</i>
        </button>
    </form>
</div>

<div class="panel tbl_panel">
    <table class="tbl_venta">
        <thead>
            <tr>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th scope="col">Talla</th>
                <th scope="col">Unidades</th>
                <th scope="col">Precio/unidad</th>
                <th scope="col">Total</th>
                <th scope="col">Foto</th>
            </tr>
        </thead>
        <tbody>
            @php
            $total_compra = 0;
            @endphp

            @foreach ($parametros['venta']->productos as $producto)

            <tr>
                <td>{{ $producto->marca }}</td>
                <td>{{ $producto->modelo }}</td>
                <td>{{ $producto->pivot->talla }}</td>
                <td>{{$producto->pivot->cantidad}}</td>
                <td>{{ number_format($producto->precio, 2)." €" }}</td>
                <td>{{number_format($producto->pivot->precio, 2)." €"}}</td>
                @php
                $total_compra+=$producto->pivot->precio
                @endphp
                <td><img src="{{ $producto->foto }}" alt="" style="height: 5em"></td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5">Total compra</th>
                <th>{{ number_format($total_compra, 2)." €" }}</th>
            </tr>
        </tfoot>


    </table>
</div>



@endsection