<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{

    public function index(Redirector $redirect)
    {
        $parametros = ['usuario'=>auth()->user(),'titulo'=>config('constantes.RUTAS.LOGIN')];        
        if (Auth::user()) {            
            return $redirect->intended('/dashboard');
        }
        return view('Login.index',compact('parametros'));
    }

    public function login(Request $request, Redirector $redirect)
    {
        $request->validate([
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string']
        ]);

        $user = User::where('email', $request->email)->first();
        
        if ($user) {
            if ($user->password === md5($request->password)) {
                Auth::login($user);
                session(['rol' => $user->rol->tipo]);
                request()->session()->regenerate();
                return $redirect->intended('/dashboard');
            }
        }
        throw ValidationException::withMessages([
            'acceso' => __('auth.failed')
        ]);
    }

    public function logout(Request $request, Redirector $redirect)
    {
        if (auth()->user()->rol_id == config('constantes.ROL.EMPLEADO') && session('venta_id')!=null) {
            app(VentasController::class)->cancelar($request);
        }
        Auth::logout();
        session()->forget('rol');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return $redirect->to('/');
    }
}
