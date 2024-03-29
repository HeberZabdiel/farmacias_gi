<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        //return NULL;
        $guards = empty($guards) ? [null] : $guards;
        //return NULL;
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }
        
        if(session()->has('idEmpleado'))
        {
            $idEmpleado = session('idEmpleado');
            Auth::loginUsingId($idEmpleado);
            return redirect('login');// redirect('/');
        }    
        $sucursal = $request->input('opcionSucursal');
        session(['sucursal' => $sucursal]);
        return $next($request);
    }
}