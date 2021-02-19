<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Sucursal;

class AdministracionController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return view('Administracion.index');
    }

    public function empleados()
    {
        return redirect('puntoVenta/empleado');
    }

    public function edit($id)
    {
        $datosD['d'] = Sucursal::findOrFail($id);
        return view('Administracion.index',$datosD);
    }
    public function store(Request $request)
    {
        $datosCliente = request()->except('_token');
        Sucursal::insert($datosCliente);
        
        return redirect('puntoVenta/administracion');
    }

    public function update(Request $request, $id)
    {
        $datosCliente = request()->except(['_token','_method']);
        Sucursal::where('id','=',$id)->update($datosCliente);
        return redirect('puntoVenta/administracion');
    }

    public function destroy($id)//Departamento $departamento)
    {
        Sucursal::destroy($id);
        return redirect('puntoVenta/administracion');
    }

    public function buscador(Request $request)
    {
        $datosConsulta['clienteB'] = Sucursal::where("direccion",'like',$request->texto."%")->get();
        return view('Administracion.form',$datosConsulta);
        //return $datosConsulta;
    }

    public function sucursales()
    {
        return redirect('puntoVenta/sucursal');
    }
}
