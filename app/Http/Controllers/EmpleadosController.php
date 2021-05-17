<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Rol;
use App\Models\Categoria;
use Illuminate\Http\Request;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $parametros = ['usuario'=>auth()->user(),'titulo'=>config('constantes.RUTAS.DASHBOARD')];
        $empleados = Empleado::all();
        $parametros = array('empleados' => $empleados, 'titulo' => config('constantes.RUTAS.EMPLEADOS'));
        return view('Empleado.index', compact('parametros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Rol::all();
        $categorias = Categoria::all();        
        $parametros = array('roles' => $roles, 'categorias' => $categorias, 'titulo' => config('constantes.RUTAS.NUEVOEMPLEADO'));
        return view('Empleado.create', compact('parametros'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $empleados = Empleado::all();
        $num_empleado = $this->colocar_ceros(count($empleados));
        
        $empleado = new Empleado();
        $empleado->num_empleado = $num_empleado;
        $empleado->nombre = $request->nombre;
        $empleado->apellido = $request->apellido;
        $empleado->dni = $request->dni;
        $empleado->fecha_nacimiento = $request->fnacimiento;
        $empleado->fecha_inicio = $request->finicio;
        $empleado->telefono = $request->telefono;
        $empleado->email = $request->email;
        $empleado->rol_id = $request->rol;
        $empleado->categoria_id = $request->categoria;
        $empleado->save();

        return $this->index();
    }
    public function colocar_ceros($numero){
        if ($numero < 10) {
            return "00".$numero;            
        } elseif($numero < 99) {
            return "0".$numero;
        }else{
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        // return "Añadido";
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
}
