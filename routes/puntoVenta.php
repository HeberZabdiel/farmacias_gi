<?php

use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\ProductoController;

use App\Http\Controllers\VentaController;

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\SucursalEmpleadoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AdministracionController;

//ade
use App\Http\Controllers\CompraController;
use App\Http\Controllers\SubproductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CreditoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PagoCompraController;
use App\Http\Controllers\DevolucionController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ProductosCaducidadController;
use App\Http\Controllers\SucursalProductoController;
use App\Models\Producto;
use App\Models\Sucursal_producto;
use Illuminate\Support\Facades\Route;

Route::prefix('/puntoVenta')->group(function()
{
    Route::resource('administracion', AdministracionController::class);
    Route::resource('departamento', DepartamentoController::class);//->middleware('auth');

    Route::resource('sucursal', SucursalController::class);
    Route::resource('sucursalEmpleado', SucursalEmpleadoController::class);

    Route::get('/login', [LoginController::class,'login'])->name('Login');//->middleware('isEmpleado');
    Route::post('/login', [LoginController::class,'loginPost'])->name('Login');
    Route::post('/logout', [LoginController::class,'logout'])->name('Login');

    //AGREGAR PRODUCTOS A SUCURSAL DESDE STOCK
    Route::get('/producto/stock', [ProductoController::class,'stock']);
    Route::get('/sucursalProducto/crear/{id}', [SucursalProductoController::class,'crear']);
    //PRODUCTO
    //ADMINISTRADOR ELIMINA UN PRODUCTO DEL STOCK
    Route::get('/productosTodos', [ProductoController::class,'productosAll']);
    //ELIMINAR PRODUCTO POR EL ADMINISTRADOR DEL STOCK
    Route::get('/eliProd/{id}', [ProductoController::class,'eliProd']);
    
    //Sucursal producto
     Route::resource('sucursalProducto', SucursalProductoController::class);
     //RUTA SUCURSALES INACTIVAS
     Route::get('/sucursalesInactivos', [SucursalController::class,'sucu_inactivas']);
    // dar alta sucursal
    Route::get('/altaSucursal/{id}', [SucursalController::class,'darAltaSucursal']);
    //AGREGAR PRODUCTOS DEL STOCK A LA SUCURSAL ACTUAL
    Route::get('/agregarProdStock/{id}', [SucursalProductoController::class,'agregarProdStock_Suc']);
    //DEVOLVER PRODUCTOS EN BAJA DE ESTA SUCURSAL
    Route::get('/productos_baja', [SucursalProductoController::class,'productos_baja']);
    //DAR DE ALTA PRODUCTOS DADAS DE BAJA EN ESTA SUCURSAL
      Route::get('altaProductoS/{id}', [SucursalProductoController::class,'altaProductoS']);
   Route::get('productoEli/{id}', function($id){
        $producto = Sucursal_producto::where('idProducto','=',$id)->delete();
        return redirect()->back();
    });
/*
    Route::get('productoEli2/{id}', function($id){
        $producto = Sucursal_producto::where('idProducto','=',$id)->get();
        $datosSP['status']= 0;
        $producto->update($datosSP);
        return redirect()->back();
    });
    */

    //ELIMINAR PRODUCTOS DE SUCURSAL
    Route::get('productoEli3/{id}', [ProductoController::class,'eliminar3']);
    
    Route::resource('cliente', ClienteController::class);
    Route::resource('producto', ProductoController::class);
    Route::resource('corteCaja', ReporteController::class);
    Route::get('reporteInventario', [ReporteController::class,'index2']);
    //Route::get('eliminar/{id}', [ProductoController::class,'eliminar']);

    Route::middleware('isEmpleado')->group(function () {
        Route::resource('empleado', EmpleadoController::class);
        //Route::get('/login', [LoginController::class,'login'])->name('Login');
        //->middleware('isEmpleado');
        Route::resource('venta', VentaController::class);
        Route::resource('compra', CompraController::class);
    });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});