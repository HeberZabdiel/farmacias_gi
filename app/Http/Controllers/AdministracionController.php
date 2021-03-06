<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sucursal;
use App\Models\Sucursal_empleado;
use App\Models\Departamento;


class AdministracionController extends Controller
{
    public function __construct()
    {

    }
    public function index()
    {
        $sucursalesInac = Sucursal::where('status', '=', 0)->get();
        $depa =Departamento::all();
      //  $sucursalesInac = Sucursal::where('status', '=', 0)->get();
        return view('Administracion.index', $sucursalesInac, compact('depa'));
    }

    public function empleados()
    {
        return redirect('puntoVenta/empleado');
    }

    public function edit($id)
    {
        $depa = Departamento::all();
        $datosD['d'] = Sucursal::findOrFail($id);
        $sucursal = Sucursal::findOrFail($id);
        return view('Administracion.index',$datosD,compact('sucursal', 'depa'));
    }
    public function store(Request $request)
    {
        $datosCliente = request()->except('_token');
        $datosCliente['status'] = 1;
        //Sucursal::insert($datosCliente);
        $sucursal = Sucursal::create($datosCliente);
        Sucursal_empleado::create([
            'idSucursal' => $sucursal->id,
            'idEmpleado' => 1,
            'status' => 'alta'
        ]);
        return redirect('puntoVenta/administracion');
    }

    public function update(Request $request, $id)
    {
            $datosCliente = request()->except(['_token','_method']);
            $dir = $request['direccion'];
            $telefono = $request['telefono'];

            $sucursal = Sucursal::findOrFail($id);
            $dirAnt= $sucursal->direccion;
            $telefonoAnt= $sucursal->telefono;
            if( $dir == $dirAnt && $telefono == $telefonoAnt )
            {
                return redirect()->back()->withErrors(['mensajeError' => 'PARA EDITAR DEBE MODIFICAR AL MENOS UN ELEMENTO']);  
            }
            else{
            $sucursal->update($datosCliente);
            return redirect('puntoVenta/administracion')->withErrors(['mensajeConf' => 'ESTA SUCURSAL SE EDITO CORRECTAMENTE']);
        }
        /*
        $datosCliente = request()->except(['_token','_method']);
        Sucursal::where('id','=',$id)->update($datosCliente);
        return redirect('puntoVenta/administracion');
        */
    }

    public function destroy($id)//Departamento $departamento)
    {
        
    }

    public function buscador(Request $request)
    {
      //  $idSucursal = session('sucursal');
       // $depa = Departamento::all();
        $datosConsulta['sucursalB'] = Sucursal::where("direccion",'like',$request->texto."%")->get();
        return view('Administracion.form',$datosConsulta);
        //return $datosConsulta;
    }

    public function sucursales()
    {
        return redirect('puntoVenta/sucursal');
    }
}
