<?php

use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\ProductoController;

use App\Http\Controllers\VentaController;

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClienteController;

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
use App\Models\Producto;
use App\Models\Sucursal_producto;
use Illuminate\Support\Facades\Route;

Route::prefix('/puntoVenta')->group(function()
{
    Route::resource('departamento', DepartamentoController::class);//->middleware('auth');

    Route::resource('sucursal', SucursalController::class);

    Route::get('/login', [LoginController::class,'login'])->name('Login');//->middleware('isEmpleado');
    Route::post('/login', [LoginController::class,'loginPost'])->name('Login');
    Route::post('/logout', [LoginController::class,'logout'])->name('Login');


    Route::get('productoEli/{id}', function($id){
        $producto = Sucursal_producto::where('idProducto','=',$id)->delete();
        return redirect()->back();
    });
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