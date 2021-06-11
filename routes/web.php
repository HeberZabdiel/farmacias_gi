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
//use Auth;
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
Route::get('/loginCliente', [LoginClienteController::class,'loginCliente'])->name('Login')->middleware('isCliente');
Route::post('/loginCliente', [LoginClienteController::class,'loginPost'])->name('Login');
Route::post('/logoutCliente', [LoginClienteController::class,'logout'])->name('Login');

Route::get('/buscar', [EcommerceController::class,'buscarProducto'])->middleware('isCliente');
Route::get('/departamento/{departamento}', [EcommerceController::class,'categoria'])->middleware('isCliente');

Route::post('/agregarAlCarrito/{id}', [EcommerceController::class,'addCarrito'])->middleware('isCliente');
//Route::resource('/', EcommerceController::class)->middleware('isCliente');
Route::get('/', [EcommerceController::class,'index'])->middleware('isCliente');

Route::get('/productosNuevos', [EcommerceController::class,'productosNuevos'])->middleware('isCliente');
Route::get('/productosDestacados', [EcommerceController::class,'productosDestacados'])->middleware('isCliente');

Route::get('/registerCliente', [LoginClienteController::class,'register'])->middleware('isCliente');
Route::post('/registerPost', [LoginClienteController::class,'registerPost'])->middleware('isCliente');

Route::get('/producto/{id}', [EcommerceController::class,'verProducto'])->middleware('isCliente');
Route::post('/sucursal/{sucursal}', [EcommerceController::class,'cambiarSucursal'])->middleware('isCliente');
Route::get('/carrito', [EcommerceController::class,'carrito'])->middleware('isCliente');
Route::post('/actualizarCantidadCarrito/{id}', [EcommerceController::class,'actualizarCantidadCarrito'])->middleware('isCliente');
Route::post('/quitarProductoCarrito/{id}', [EcommerceController::class,'quitarProductoDeCarrito'])->middleware('isCliente');

Route::get('/direccionEnvio', [EcommerceController::class,'direccionEnvio'])->middleware('isCliente');
Route::post('/domicilio', [EcommerceController::class,'postDireccion'])->middleware('isCliente');

Route::post('/eliminarDireccion', [EcommerceController::class,'eliminarDireccion'])->middleware('isCliente');
Route::get('/metodoPago', [EcommerceController::class,'formaPago'])->middleware('isCliente');
Route::get('/revisionPedido', [EcommerceController::class,'revisionPedido'])->middleware('isCliente');
Route::get('/menu', [EcommerceController::class,'menu'])->middleware('isCliente');
//Route::post('/', [EcommerceController::class,'menu'])->middleware('isCliente');
//Auth::routes();
Route::get('/pagoPaypal', [EcommerceController::class,'pagoPaypal']);
