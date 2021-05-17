<div class="cont_stock">
    <table class="tbl_tallas">
        <thead>
            <tr>
                <th class="sticky">Talla</th>
                <th class="sticky">Stock</th>
                <th class="sticky">Unidades a comprar</th>
                <th class="sticky"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($producto->tallasUnidades as $opcion)
            <form action="{{ route('venta.store') }}" method="POST">
                @csrf
                <input type="hidden" name="producto" value="{{json_encode($producto,TRUE)}}">
                <input type="hidden" name="talla" value="{{$opcion->talla}}">
                <tr>
                    <td>{{ $opcion->talla }}</td>
                    <td>{{ $opcion->unidades }}</td>
                    <td> <input type="number" name="cantidad" id="" max="{{ $opcion->unidades }}"> </td>
                    <td>
                        <button class="btn_add_stock btn_accion" type="submit">                            
                            <i class="material-icons">add_circle_outline</i>&nbsp;
                            <i>Agregar a la compra</i>
                        </button>
                    </td>
                </tr>
            </form>
            @endforeach
        </tbody>
    </table>
</div>