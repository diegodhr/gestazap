<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::all()->sortBy('marca');
        session(['nueva_venta' => 1]);
        $productos_venta = array();
        if(!session('venta_id')){
            $this->agregarVenta();            
        }        
        if(session('venta_id')){
            $prod_venta = Venta::findOrFail(session('venta_id'));
            if (count($prod_venta->productos()->get())>0) {
                $productos_venta = $prod_venta->productos();
            }
        }
        $parametros = ['usuario'=>auth()->user(),'titulo'=>config('constantes.RUTAS.NUEVAVENTA'),'productos'=>$productos,'productos_venta'=>$productos_venta];
        return view('Venta.index',compact('parametros'));
    }

    public function agregarVenta(){
        $usuario = auth()->user();
        $now = new \DateTime();
        $hoy = $now->format('Y-m-d H:i:s');

        $venta = new Venta();
        $venta->user_id = $usuario->id;
        $venta->fecha = $hoy;
        $venta->finalizada = false;
        $venta->save();
        session(['venta_id' => $venta->id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prod_temp = json_decode($request->producto);
        $producto = new Producto();
        $producto = Producto::find($prod_temp->id);

        $venta = new Venta();
        $venta = Venta::find(session('venta_id'));
        $venta->productos()->attach($producto, ['cantidad' => $request['cantidad'],'precio'=>($producto->precio*$request['cantidad']),'talla'=>$request['talla']]);

        $stock =  $producto->tallasUnidades()->where('producto_id', $producto->id)->where('talla', $request['talla'])->first();
        $stock->talla = $request['talla'];
        $total = $stock['unidades']-$request['cantidad'];        
        $stock->unidades = $total;
        $producto->tallasUnidades()->save($stock);
        if($stock->unidades<1){
            $stock->delete();
        }

        request()->session()->regenerate();
        return redirect()->intended('/venta');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
        $venta = Venta::findOrFail($id);
        
        $parametros = ['titulo'=>config('constantes.RUTAS.VERCARRITO'),'venta'=>$venta];
        return view('Venta.show',compact('parametros'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function finalizar(Request $request){
        /*Finalizar la venta, añadiendo a la tabla de venta*/
        $suma_total = 0;
        $venta = Venta::findOrFail(session('venta_id'));
        foreach ($venta->productos as $producto) {            
            $suma_total =  $producto->pivot->precio + $suma_total;
        }
        $venta->total = $suma_total;
        $venta->finalizada = 1;

        $venta->save();
        $this->cerrar($request);
        return redirect()->intended('/dashboard');
    }
    public function cancelar(Request $request){
        $venta = Venta::find(session('venta_id'));
        if($venta->productos()){
            $venta->productos()->detach();
        }
        $venta->delete();        
        $this->cerrar($request);

        return redirect()->intended('/dashboard');
    }
    public function cerrar($request)
    {
        $request->session()->forget('nueva_venta');
        $request->session()->forget('venta_id');
        request()->session()->regenerate();
        
    }
}
