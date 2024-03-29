<?php

namespace App\Http\Controllers;

use App\Models\Devolucion;
use App\Models\Venta;
use App\Models\Detalle_venta;
use App\Models\Producto;
use App\Models\Empleado;
use App\Models\Pago_venta;
use App\Models\Sucursal;
use App\Models\Sucursal_empleado;
use App\Models\Sucursal_producto;
use App\Models\Venta_cliente;
use Illuminate\Http\Request;

class DevolucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = ['verDevolucion','crearDevolucion','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        $ventas= Venta::all(['id','tipo', 'pago','status','idSucursalEmpleado','created_at','updated_at']);
        $detalleVenta= Detalle_venta::all(['idVenta','idProducto', 'cantidad','precioIndividual']);
        $productos= Producto::all(['id','codigoBarras', 'nombre','descripcion','receta' ,'idDepartamento']);
        $idSucursal = session('sucursal');
        $empleados= Empleado::all();
        $devolucions = Devolucion::all();
        $idSucursal = session('sucursal');
        $ventaCliente = Venta_cliente::all(['id','estado','idCliente','idVenta','created_at','updated_at']);
        $sucursalEmpleado = Sucursal_empleado::where('idSucursal', '=', $idSucursal)
        ->get(['id','idSucursal','idEmpleado','status','created_at','updated_at']);
        $pagosVenta = Pago_venta::all();
        $productX_Sucursal = Sucursal_producto::where('idSucursal','=', $idSucursal)->get();
/*
        $ventasFiltro = [];
        foreach($ventas as $v)
        {
            $bandera = true;
            foreach($sucursalEmpleado as $suc_emp)
            {
                if($suc_emp->id == $v->idSucursalEmpleado){
                    array_push($ventasFiltro,$v);
                }
            }
        }
        */
        route('clear.cache');
        return view('Devolucion.index', compact('ventas','pagosVenta', 'ventaCliente','detalleVenta', 'productos', 'empleados', 'devolucions', 'sucursalEmpleado',  'productX_Sucursal', 'ventas'));
    
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
        $usuarios = ['crearDevolucion','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        $cantProducto= $request->input('cantidad');
        $detalle= $request->input('detalle');
        $precio= $request->input('precio');
        $idProducto= $request->input('idProducto');
        $idVenta= $request->input('idVenta');
        
        $idSucEmp = session('idSucursalEmpleado');


            $devolucion = new Devolucion;
            $devolucion->idProducto = $idProducto;
            $devolucion->idEmpSuc = $idSucEmp;
            $devolucion->idVenta = $idVenta;
            $devolucion->cantidad = $cantProducto;
            $devolucion->observacion= $detalle;
            $devolucion->precio = $precio;
            $devolucion->save();
    
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Devolucion  $devolucion
     * @return \Illuminate\Http\Response
     */
    public function show(Devolucion $devolucion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Devolucion  $devolucion
     * @return \Illuminate\Http\Response
     */
    public function edit(Devolucion $devolucion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Devolucion  $devolucion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Devolucion $devolucion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Devolucion  $devolucion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Devolucion $devolucion)
    {
        //
    }
    public function datosDevoluciones(){
        $devolucions = Devolucion::all();
        return compact('devolucions');
    }
    public function datosVenta(){
        $ventas= Venta::all();
        if(!session()->has('sucursal')) return;
        $idSucursal= session('sucursal');
        $ventas_sucursal = [];
        foreach ($ventas as $venta) 
        {
            $sucursal_empleado = Sucursal_empleado::where('id','=',$venta->idSucursalEmpleado)->first();
            
            if($sucursal_empleado->idSucursal == $idSucursal)
            {
                array_push($ventas_sucursal,$venta);
            }

        }
        return json_encode($ventas_sucursal);
        //return compact('ventas_sucursal');
    }
    
    public function datosDetalleVenta(){
        $detalleVenta= Detalle_venta::all();
        return compact('detalleVenta');
    }
    public function datosProducto(){
        $productos= Producto::all();
        return compact('productos');
    }
    public function datosEmpleado(){
        $empleados= Empleado::all();
        return compact('empleados');
    }

    public function datoDev()
    {
        $devolucions = Devolucion::all();
        return $devolucions;
    }

}
