<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\Venta;
use App\Models\Pago_venta;
use App\Models\Devolucion;
use App\Models\Pago_compra;
use App\Models\Compra;
use App\Models\Empleado;
use App\Models\Producto;
use App\Models\Departamento;
use App\Models\Detalle_compra;
use App\Models\Detalle_venta;
use App\Models\Proveedor;
use App\Models\Sucursal_empleado;
use App\Models\Sucursal_producto;
use Illuminate\Http\Request;
//use PDF;
use Barryvdh\DomPDF\Facade as PDF;

class ReporteController extends Controller
{
    public function __construct()
    {
        //$usuarios = ['admin',];//,'admin'];
        //Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = ['verCorte','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        //CORTE DE CAJA INDEX
        $ventas = Venta::all();
        $pagos = Pago_venta::all();
        $devoluciones = Devolucion::all();
        $pagoCompras= Pago_compra::all();
        $compras = Compra::all();
        $empleados = Empleado::all();
        //Seleccionar empleados que son cajeros
        $idSucursal = session('sucursal');
        $sucursalEmpleados = Sucursal_empleado::where('idSucursal', '=', $idSucursal)->get();
        //return $sucursalEmpleados;
        return view('Reportes.corteCaja', compact('empleados','ventas', 'pagos', 'devoluciones','pagoCompras','compras','sucursalEmpleados'));
    }

    public function index2()
    {
        //REPORTE INVENTARIO INDEX
        $usuarios = ['verReporte','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        $empleados = Empleado::all();
        $idSucursal = session('sucursal');
        $sucursalEmpleados = Sucursal_empleado::where('idSucursal', '=', $idSucursal)->get();
        $compras= Compra::all();
        $detalleCompra= Detalle_compra::all();
        $productos= Producto::all();
        $devoluciones= Devolucion::all();
        $departamentos= Departamento::all();
        $ventas = Venta::all();
        $detalle_ventas = Detalle_venta::all();
        $sucursal_productos = Sucursal_producto::where('idSucursal','=', $idSucursal)->get();
        return view('Reportes.reporteInventario', compact('empleados','compras','detalleCompra', 'productos','devoluciones', 'departamentos','ventas', 'detalle_ventas', 'sucursal_productos', 'sucursalEmpleados'));
    }
    public function index3()
    {
        $empleados = Empleado::all();
        $idSucursal = session('sucursal');
        $sucursalEmpleados = Sucursal_empleado::where('idSucursal', '=', $idSucursal)->get();
        $productos= Producto::all();
        $departamentos= Departamento::all();
        $ventas = Venta::all();
        $detalle_ventas = Detalle_venta::all();
        $sucursal_productos = Sucursal_producto::where('idSucursal','=', $idSucursal)->get();
        return view('Reportes.reporteVentas', compact('empleados','sucursalEmpleados','productos','departamentos','ventas','detalle_ventas', 'sucursal_productos'));
    }

    public function index4()
    {
        $usuarios = ['verReporte','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        $empleados = Empleado::all();
        $idSucursal = session('sucursal');
        $sucursalEmpleados = Sucursal_empleado::where('idSucursal', '=', $idSucursal)->get();
        $compras= Compra::all();
        $detalleCompra= Detalle_compra::all();
        $productos= Producto::all();
        $devoluciones= Devolucion::all();
        $departamentos= Departamento::all();
        $ventas = Venta::all();

        $comprasFiltro = [];
        foreach($compras as $c)
        {
            $bandera = true;
            foreach($sucursalEmpleados as $suc_emp)
            {
                if($suc_emp->id == $c->idSucursalEmpleado){
                    array_push($comprasFiltro,$c);
                }
            }
        }

        $ventasFiltro = [];
        foreach($ventas as $v)
        {
           // $bandera = true;
            foreach($sucursalEmpleados as $suc_emp)
            {
                if($suc_emp->id == $v->idSucursalEmpleado){
                    array_push($ventasFiltro,$v);
                }
            }
        }



        $proveedores = Proveedor::where('status','=', 1)->get();
        $detalle_ventas = Detalle_venta::all();
        $sucursal_productos = Sucursal_producto::where('idSucursal','=', $idSucursal)->get();
        return view('Reportes.entradas_salidas', compact('empleados', 'compras', 'detalleCompra', 'productos', 'devoluciones', 'departamentos', 'ventas', 'detalle_ventas', 'sucursal_productos', 'sucursalEmpleados','proveedores','comprasFiltro','ventasFiltro'));    
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function show(Reporte $reporte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function edit(Reporte $reporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reporte $reporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reporte $reporte)
    {
        //
    }

    function pdf() {

        $ventas = Venta::all();
        $pagos = Pago_venta::all();
        $devoluciones = Devolucion::all();
        $pagoCompras= Pago_compra::all();
        $compras = Compra::all();
        $empleados = Empleado::all();
        //Seleccionar empleados que son cajeros
        $idSucursal = session('sucursal');
        $sucursalEmpleados = Sucursal_empleado::where('idSucursal', '=', $idSucursal)->get();
        //return $sucursalEmpleados;
      //  return view('Reportes.corteCaja', compact('empleados','ventas', 'pagos', 'devoluciones','pagoCompras','compras','sucursalEmpleados'));

     //  $datos = compact('empleados','ventas', 'pagos', 'devoluciones','pagoCompras','compras','sucursalEmpleados');
       
       $data = [
            'empleados' => $empleados,
            'ventas' => $ventas,
            'pagos' => $pagos,
            'devoluciones' => $devoluciones,
            'pagoCompras' => $pagoCompras,
            'compras' =>$compras,
            'sucursalEmpleados' => $sucursalEmpleados
        ];
        
        
        $pdf = PDF::loadHTML('Reportes\corteCaja', $data)
        ->setPaper('a4', 'landscape');
        
        //return $pdf;
        $pdf->save('corteCaja10.pdf');
        return back(); 
    }
/*
    function pdf2(){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->guardar());
       }
    public function guardar()
    {
    $data = [
        'titulo' => 'Styde.net'
    ];

    $pdf = \PDF::loadView('Reportes\corteCaja', $data);

    return $pdf->save('corte_caja.pdf');
    }

    */
}
