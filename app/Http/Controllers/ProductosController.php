<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Tallaunidades;
use Exception;
use Goutte\Client;
use Illuminate\Http\Request;

use Symfony\Component\DomCrawler\UriResolver;
use Symfony\Component\DomCrawler\Crawler;
use function PHPSTORM_META\type;
use function Psy\debug;

class ProductosController extends Controller
{
    private $productos1 = array();
    private $productos2 = array();
    private $productos3 = array();
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Muestra los productos del almacen
    public function index()
    {
        $productos = Producto::all();

        $parametros = array('productos' => $productos, 'titulo' => config('constantes.RUTAS.PRODUCTOS'));
        return view('Producto.index', compact('parametros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Muestra la pantalla de agregar producto
    public function create()
    {
        $busqueda = null;
        $parametros = array('titulo' => config('constantes.RUTAS.NUEVOPRODUCTO'), 'busqueda' => $busqueda);
        return view('Producto.create', compact('parametros'));
    }

    // Busca el producto
    public function buscar_producto(Request $request)
    {
        $busqueda = array();
        if ($request->criterio) {
            $svd = $this->buscar_t1($request->criterio);
            $jdsports = $this->buscar_t2($request->criterio);
            $one = $this->buscar_t3($request->criterio);

            $busqueda[config('constantes.TIENDA.SVD')] = array();
            $busqueda[config('constantes.TIENDA.JD')] = array();
            $busqueda[config('constantes.TIENDA.ONE')] = array();

            if ($svd) {
                $busqueda[config('constantes.TIENDA.SVD')] = $svd;
            }
            if ($jdsports) {
                $busqueda[config('constantes.TIENDA.JD')] = $jdsports;
            }
            if ($one) {
                $busqueda[config('constantes.TIENDA.ONE')] = $one;
            }
        }
        $parametros = array('titulo' => config('constantes.RUTAS.NUEVOPRODUCTO'), 'busqueda' => $busqueda);
        return view('Producto.create', compact('parametros'));
    }

    public function guardar_producto(Request $request)
    {
        $producto_buscado = json_decode($request->producto);

        $producto = new Producto();
        $producto->marca = $producto_buscado->marca;
        $producto->modelo = $producto_buscado->modelo;
        $producto->precio = $producto_buscado->precio;
        $producto->foto = $producto_buscado->imagen;
        $producto->save();
        $talla_unidades = new Tallaunidades();
        $talla_unidades->talla = $request->talla;
        $talla_unidades->unidades = $request->unidades;
        $producto->tallasUnidades()->save($talla_unidades);

        request()->session()->regenerate();
        return redirect()->intended('/dashboard/producto/');
    }

    // Busca en la primera tienda
    public function buscar_t1($criterio)
    {
        try {            
            $barato = array();
            $criterio_anterior = $criterio;

            $cliente = new Client();
            $cliente->setServerParameter('HTTP_USER_AGENT', 'user agent');

            $crawler = $cliente->request('GET', 'https://www.sivasdescalzo.com/es/catalogsearch');
            $form = $crawler->selectButton('Search')->form();
            $page = $cliente->submit($form, ['q' => $criterio]);

            $page->filter('.grid-col')->each(function ($item) {
                $producto = array();
                $marca = $item->filter('.product-card__title a')->text();
                $modelo = $item->filter('.product-item-link')->text();
                $precio = $item->filter('.price')->text();
                $precio = trim($precio);
                $precio = str_replace(',', '.', $precio);
                $precio = floatval($precio);
                $imagen = $item->filter('img.product-image-photo')->attr('src');

                $producto['marca'] = $marca;
                $producto['modelo'] = $modelo;
                $producto['precio'] = $precio;
                $producto['imagen'] = $imagen;
                $this->productos1[] = $producto;
            });

            foreach ($this->productos1 as $producto) {
                $marca = strtolower($producto['marca']);
                $modelo = explode(" ", strtolower($producto['modelo']));                
                $criterio =  explode(" ", strtolower($criterio_anterior));
                $criterio_nomarca =array_diff($criterio,[$marca]);
                $modelo_bool = true;

                foreach ($criterio_nomarca as $elm_criterio) {
                    if(!in_array($elm_criterio, $modelo)){
                        $modelo_bool=false;
                        break;
                    }
                }

                if (in_array($marca, $criterio) && $modelo_bool) {
                    if (empty($barato)) {
                        $barato = $producto;
                    } else {
                        if ($producto['precio'] < $barato['precio']) {
                            unset($barato);
                            $barato = $producto;
                        }
                    }
                }                
            }

            return $barato;
        } catch (Exception $ex) {
            return false;
        }
    }

    // Busca en la segunda tienda
    public function buscar_t2($criterio)
    {
        try {

            $barato = array();
            $criterio_anterior = $criterio;

            $criterio = $this->formatear_criterio($criterio, '+');

            $url = 'https://www.jdsports.es/search/' . $criterio . '/';
            $cliente = new Client();
            $cliente->setServerParameter('HTTP_USER_AGENT', 'user agent');
            $page = $cliente->request('GET', $url);
            $page->filter('.productListItem ')->each(function ($item) {

                $precio = $item->filter('.itemPrice')->text();
                $precio = trim($precio);
                $precio = explode(' ', $precio);
                if (count($precio) > 1) {
                    $mas_bajo = PHP_FLOAT_MAX;
                    foreach ($precio as  $valor) {
                        $precio_temp = str_replace(',', '.', $precio);
                        $precio_temp = floatval($valor);
                        if (($precio_temp < $mas_bajo) && ($valor != 0)) {
                            $mas_bajo = $precio_temp;
                        }
                    }
                    $precio = $mas_bajo;
                } else {
                    $precio = str_replace(',', '.', $precio);
                    $precio = floatval($precio[0]);
                }

                $producto = array();
                $modelo = $item->filter('.itemTitle>a')->text();
                $marca = explode(" ", $modelo);
                $marca = $marca[0];

                $imagen = $item->filter('.thumbnail')->attr('data-src');

                $producto['marca'] = $marca;
                $producto['modelo'] = $modelo;
                $producto['precio'] = $precio;
                $producto['imagen'] = $imagen;

                $this->productos2[] = $producto;
            });

            foreach ($this->productos2 as $producto) {
                $marca = strtolower($producto['marca']);
                $modelo = explode(" ", strtolower($producto['modelo']));
                $criterio =  explode(" ", strtolower($criterio_anterior));                
                $modelo_bool = true;
                foreach ($criterio as $elm_criterio) {
                    if(!in_array($elm_criterio, $modelo)){
                        $modelo_bool=false;
                        break;
                    }
                }
                
                if (in_array($marca, $criterio) && $modelo_bool) {
                    if (empty($barato)) {
                        $barato = $producto;
                    } else {
                        if ($producto['precio'] < $barato['precio']) {
                            unset($barato);
                            $barato = $producto;
                        }
                    }
                }
            }
            return $barato;
        } catch (Exception $ex) {
            return false;
        }
    }

    // Busca en la tercera tienda
    public function buscar_t3($criterio)
    {
        try {
            $barato = array();
            $criterio_anterior = $criterio;
            $criterio = $this->formatear_criterio($criterio, '%20');
            $url = 'https://www.thesneakerone.com/busqueda?controller=search&s=' . $criterio . '';
            $cliente = new Client();
            $cliente->setServerParameter('HTTP_USER_AGENT', 'user agent');
            $page = $cliente->request('GET', $url);


            $page->filter('.product_item')->each(function ($item) {

                $producto = array();

                $modelo = $item->filter('.product-title')->text();
                $marca = explode(" ", $modelo);
                $marca = $marca[0];
                $precio = $item->filter('.price')->text();
                $precio = trim($precio);
                $precio = str_replace(',', '.', $precio);
                $precio = floatval($precio);
                $imagen = $item->filter('.thumbnail img')->attr('src');

                $producto['marca'] = $marca;
                $producto['modelo'] = $modelo;
                $producto['precio'] = $precio;
                $producto['imagen'] = $imagen;

                $this->productos3[] = $producto;
            });
            foreach ($this->productos3 as $producto) {
                $marca = strtolower($producto['marca']);
                $modelo = explode(" ", strtolower($producto['modelo']));
                $criterio =  explode(" ", strtolower($criterio_anterior));                
                $modelo_bool = true;
                foreach ($criterio as $elm_criterio) {
                    if(!in_array($elm_criterio, $modelo)){
                        $modelo_bool=false;
                        break;
                    }
                }
                
                if (in_array($marca, $criterio) && $modelo_bool) {
                    if (empty($barato)) {
                        $barato = $producto;
                    } else {
                        if ($producto['precio'] < $barato['precio']) {
                            unset($barato);
                            $barato = $producto;
                        }
                    }
                }
            }
            return $barato;
        } catch (Exception $ex) {
            return false;
        }
    }

    //Modifica el criterio de busqueda
    public function formatear_criterio($criterio, $formato)
    {
        $criterio = trim($criterio);
        $criterio = explode(' ', $criterio);
        $criterio = implode($formato, $criterio);
        return $criterio;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Guarda el producto con la talla
    public function store(Request $request)
    {
        $request->validate([
            'cantidad' => ['required', 'numeric'],
        ]);
        $producto = json_decode($request->producto);
        $prod_db = Producto::find($producto->id);
        $stock =  $prod_db->tallasUnidades()->where('producto_id', $producto->id)->where('talla', $request['talla_select'])->first();

        $stock->talla = $request['talla_select'];
        $total = $stock['unidades'] + $request['cantidad'];
        $stock->unidades = $total;
        $prod_db->tallasUnidades()->save($stock);

        request()->session()->regenerate();
        return redirect()->intended('/dashboard/producto/' . $producto->id . '')->with('nuevo_stock', "Stock actualizado");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $producto = Producto::findOrFail($id);
        $parametros = array('titulo' => config('constantes.RUTAS.MODIFICAR'), 'producto' => $producto);

        return view('Producto.show', compact('parametros'));
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
    public function nueva_talla(Request $request)
    {
        $request->validate([
            'nueva_talla' => ['required', 'numeric'],
        ]);
        $producto = json_decode($request->producto);

        $prod_db = Producto::find($producto->id);
        $tallas =  $prod_db->tallasUnidades()->where('producto_id', $producto->id)->get('talla');
        foreach ($tallas as $prod) {
            if ($prod['talla'] == $request['nueva_talla']) {
                request()->session()->regenerate();
                return redirect()->intended('/dashboard/producto/' . $producto->id . '')->with('res_talla', 1);
            }
        }

        $talla_unidades = new Tallaunidades();
        $talla_unidades->talla = $request['nueva_talla'];
        $talla_unidades->unidades = 1;
        $prod_db->tallasUnidades()->save($talla_unidades);
        request()->session()->regenerate();
        return redirect()->intended('/dashboard/producto/' . $producto->id . '')->with('res_talla', 0);
    }
}
