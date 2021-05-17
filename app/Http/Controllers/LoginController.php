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
            // $parametros['titulo']=config('constantes.RUTAS.DASHBOARD');
            // if (auth()->user()->id==config('constantes.ROL.ADMINISTRADOR')) {
            //     return view('Dashboard.admin',compact('parametros'));
            // }else{
            //     return view('Dashboard.empleado',compact('parametros'));
            // }
        }
        return view('Login.index',compact('parametros'));
    }

    public function login(Request $request, Redirector $redirect)
    {
        // $credentials = $request->validated();
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
                // $datos = ['status' => "Estas logeado", 'user' => $user];
                // return $redirect->intended('/dashboard')->with('datos', $datos);

                // return redirect()->intended(route($route, $parameters));

                // $remember = $request->filled('remember');
                // if (Auth::attempt($request->only('email', 'password'), $remember)) {
                //     dd("dentro2");
                //     request()->session()->regenerate();
                //     return $redirect->intended('/dashboard')->with('status', 'Estas logeado');
                // }
            }
        }
        throw ValidationException::withMessages([
            'acceso' => __('auth.failed')
        ]);

    }

    public function logout(Request $request, Redirector $redirect)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->forget('rol');
        return $redirect->to('/');
    }
}
