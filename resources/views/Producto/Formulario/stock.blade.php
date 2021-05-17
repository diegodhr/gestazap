<div class="cont_talla">
    <form action="{{route('producto.talla')}}" method="POST">
        @csrf
        <input type="hidden" name="producto" value="{{json_encode($producto,TRUE)}}">
        <label class="lbl_talla" for="id_talla">Nueva talla</label>
        <input type="number" name="nueva_talla" id="id_talla">
        <button class="btn_accion d-flex align-items-center justify-content-center" type="submit">
            <i class="material-icons">add_circle_outline</i>&nbsp;
            <i>Agregar</i>
        </button>
    </form>
    @error('nueva_talla')
    <small class="text-danger">{{ $message }}</small>
    @enderror

    {{-- @if (Session::has('res_talla'))
    @if (session('res_talla')==1)
    <div class="alert alert-danger">Ya existe esa talla</div>
    @else
    <div class="alert alert-info">Talla añadida correctamente</div>
    @endif
    @php
    Session::forget('res_talla');
    @endphp
    @endif --}}
</div>
{{-- @if (Session::has('nuevo_stock'))
<div class="alert alert-info">{{ Session::get('nuevo_stock') }}</div>
@endif --}}
<div class="cont_stock">
    <table class="tbl_tallas">
        <thead>
            <tr>
                <th class="sticky">Talla</th>
                <th class="sticky">Stock</th>
                <th class="sticky">Cantidad</th>
                <th class="sticky"></th>
            </tr>
        </thead>
        <tbody>
            <div>
                @foreach ($producto->tallasUnidades as $opcion)
                <form action="{{ route('producto.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="producto" value="{{json_encode($producto,TRUE)}}">
                    <input type="hidden" name="talla_select" value="{{$opcion->talla}}">
                    <tr>
                        <td>{{ $opcion->talla }}</td>
                        <td>{{ $opcion->unidades }}</td>
                        <td><input class="unidades" type="number" name="cantidad" id=""></td>
                        <td>
                            <button class="btn_add_stock btn_accion" type="submit">
                                <i class="material-icons">add_circle_outline</i>&nbsp;
                                <i>Agregar al stock</i>
                            </button> 
                        </td>
                    </tr>
                </form>
                @endforeach

                @error('cantidad')
                <small class="text-danger">{{ $message }}</small>
                @enderror



                @php
                Session::forget('nuevo_stock');
                @endphp

            </div>
        </tbody>
    </table>
</div>