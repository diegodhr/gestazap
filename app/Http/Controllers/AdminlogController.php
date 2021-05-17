<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class AdminlogController extends Controller
{
    public function categoria(){        
        // dump(auth()->user());
        // if(){
        //     return  view('Empleado.create');
        // }
        return view('Adminlog.categoria');
    }
    public function nueva_categoria(Request $request)
    {
        echo "Agregar categoria";
        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->salario = $request->salario;
        $categoria->save();
        return view('Adminlog.categoria');
    }
}
