<?php

use App\Http\Controllers\AdministracionController;
use App\Http\Controllers\EcommerceController;

use App\Http\Controllers\LoginClienteController;

use Illuminate\Support\Facades\Route;

//ade
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\SubproductoController;
//use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CreditoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PagoCompraController;
use App\Http\Controllers\DevolucionController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ProductosCaducidadController;


use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\ProductoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Auth::routes();
/*Route::get('/', function () {
    return view('welcome');
});*/
Auth::routes(['verify' => true]);
Route::get('/loginCliente', [LoginClienteController::class,'login'])->name('Login')->middleware('isCliente');
Route::post('/loginCliente', [LoginClienteController::class,'loginPost'])->name('Login');
Route::post('/logoutCliente', [LoginClienteController::class,'logout'])->name('Login');

Route::resource('/', EcommerceController::class)->middleware('isCliente');
Route::get('/idCliente', [EcommerceController::class,'idCliente']);
Route::get('/idEmpleado', [EcommerceController::class,'idEmpleado']);
Route::get('/idSucursal', [EcommerceController::class,'idSucursal']);


    //Rutas ade
    
    
    Route::get('/datosDevoluciones', [DevolucionController::class,'datoDev']);
    Route::get('/datosVentas', [DevolucionController::class,'datosVenta']);
    Route::get('/datosdetalleVenta', [DevolucionController::class,'datosDetalleVenta']);
    Route::get('/datosProducto', [DevolucionController::class,'datosProducto']);
    Route::get('/datosEmpleado', [DevolucionController::class,'datosEmpleado']);
    Route::get('/departamento2', [DepartamentoController::class,'index2']);
    Route::post('/venta/productos', [VentaController::class,'productos']);


    

    Route::get('emple', [EmpleadoController::class,'index2']);
    

    Route::resource('credito', CreditoController::class);
    Route::get('/datosNuevos', [CreditoController::class,'datosNuevos']);
    Route::resource('pago', PagoController::class);
    Route::resource('pagoCompra', PagoCompraController::class);
    Route::resource('devolucion', DevolucionController::class);
    
    
    Route::get('reporteVentas', [ReporteController::class,'index3']);

    Route::get('/empleado/buscadorEmpleado', [EmpleadoController::class,'buscadorEmpleado']);

    Route::get('/producto/buscarProducto', [ProductoController::class,'buscarProducto']);

    Route::get('/producto/buscador', [ProductoController::class,'buscador']);

    Route::get('/departamento/buscador', [DepartamentoController::class,'buscador']);
    Route::get('/cliente/buscador', [ClienteController::class,'buscador']);
    Route::get('/administracion/buscador', [AdministracionController::class,'buscador']);




//Route::get('/departamento/buscadorProducto', [CompraController::class,'buscadorProducto']);

//Route::get('/departamento/buscador2', [DepartamentoController::class,'buscador2']);





// RUTA PARA EL BUSCADOR EN TIEMPO REAL DEPARTAMENTO


//Auth::routes();

