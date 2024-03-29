<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\Empleado;
use App\Models\Sucursal;
use App\Models\Sucursal_empleado;
use Illuminate\Support\Facades\Auth;

class isEmpleado
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //return 'Hay error';
        //return $next($request);
        if (!session()->has('seccion')) {
            session(['urlSeccion' => url()->current()]);
        }
        if (session()->has('idUsuario')) {

            if (Auth::check()) {

                if (Auth::user()->tipo == 0) {

                    if (Auth::user()->id == 1) {
                        if(Auth::user()->email_verified_at == NULL)
                            return redirect('/email/verify');
                        return $next($request);
                    }

                    $id = Auth::user()->id;
                    $empleado = Empleado::where('idUsuario', '=', $id)->get()->first();
                    $sucursalEmpleado = Sucursal_empleado::where('idSucursal', '=', session('sucursal'))
                        ->where('idEmpleado', '=', $empleado->id)->get()->first();
                    //return $sucursalEmpleado;
                    if (!empty($sucursalEmpleado) && $sucursalEmpleado->status == 'alta') {
                        //                    return redirect('/puntoVenta/home');
                        //$request->session()->regenerate();
                        session(['idUsuario' => Auth::user()->id]);

                        session(['sucursal' => session('sucursal')]);
                        //return $next($request);
                        //return redirect('puntoVenta/sucursal');
                        //    //$sucursal = Sucursal::findOrFail($request->input('opcionSucursal'))->direccion;

                        //    //session(['sucursalNombre' => $sucursal]);
                        if(Auth::user()->email_verified_at == NULL)
                            return redirect('/email/verify');
                        return $next($request); //->intended('/');

                    }

                    /*$id = Auth::user()->id;
                    $empleado = Empleado::where('idUsuario','=',$id)->get()->first();
                    $sucursalEmpleado = Sucursal_empleado::where('idSucursal','=',session('sucursal'))
                    ->where('idEmpleado','=',$empleado->id)->get()->first();
                    if($sucursalEmpleado->count() && $sucursalEmpleado->status == 'alta')
                        return $next($request);*/
                }
                Auth::logout();
            }
            //Auth::logout();
            $idUsuario = session('idUsuario');
            Auth::loginUsingId($idUsuario);
        } else {

            Auth::logout();
            return redirect('/puntoVenta/login');
            //return 'Hay error';

        }
        if (Auth::check()) {
            $idUsuario = Auth::user()->id;
            session(['idUsuario' => $idUsuario]);
        }
        if(Auth::user()->email_verified_at == NULL)
            return redirect('/email/verify');
        return $next($request);
    }
}
