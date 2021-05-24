@extends('Layout.Elements.plantilla_dashboard')
{{-- <link rel="stylesheet" href="{{'css/custom/db_listaprod.css'}}"> --}}
<link href="{{ asset('css/custom/db_listaprod.css') }}" rel="stylesheet">

@section('contenido')

<div class="panel">
    <h1 class="panel-title">Almacén de productos</h1>
    <div class="botones">
        <a href="producto/create" class="btn_accion d-flex align-items-center justify-content-center">
            <i class="material-icons">add_circle_outline</i>&nbsp;
            <i>Agregar producto</i>
        </a>
        <a href="../" class="btn_accion d-flex align-items-center justify-content-center">
            <i class="material-icons">arrow_back</i>&nbsp;
            <i>Volver</i>
        </a>
    </div>
</div>

@if ($parametros['productos']->isNotEmpty())

<div class="tbl_panel">
    <table class="tbl_stock">
        <thead>
            <tr>
                <th class="sticky" scope="col">Marca</th>
                <th class="sticky" scope="col">Modelo</th>
                <th class="sticky" scope="col">Talla</th>
                <th class="sticky" scope="col">Unidades</th>
                <th class="sticky" scope="col">Precio</th>
                <th class="sticky" scope="col">Imagen</th>
                <th class="sticky" scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @php
            $pos = "impar"
            @endphp
            @foreach ($parametros['productos'] as $producto)

            @php
            $span = count($producto->tallasUnidades);
            $primero = true;
            @endphp
            @foreach ($producto->tallasUnidades as $detalles)
            <tr>
                @if ($primero)
                <td class="{{ $pos }}" rowspan="{{ $span }}">{{ $producto->marca }}</td>
                <td class="{{ $pos }}" rowspan="{{ $span }}">{{ $producto->modelo }}</td>
                @endif

                <td class="{{ $pos }}">{{ $detalles->talla }}</td>
                <td class="{{ $pos }}">{{ $detalles->unidades }}</td>

                @if ($primero)
                <td class="{{ $pos }}" rowspan="{{ $span }}">{{ number_format($producto->precio, 2)." €"  }}</td>
                <td class="{{ $pos }} td_imagen" rowspan="{{ $span }}"> <img style="height: 4em"
                        src="{{ $producto->foto }}" alt=""> </td>
                <td class="{{ $pos }}" rowspan="{{ $span }}">
                    <a href="{{ route('producto.show',$producto->id) }}"
                        class="btn_accion d-flex align-items-center justify-content-center">
                        <i class="material-icons">edit</i>
                        <i>Editar</i>
                    </a>
                </td>
                @php
                $primero=false;
                @endphp
                @endif
            </tr>
            @endforeach
            @php
            $pos = ($pos=="impar")?$pos="par":$pos="impar";
            @endphp
            @endforeach

        </tbody>

    </table>
    @else
    <h1>No hay productos</h1>
    @endif
</div>

@endsection