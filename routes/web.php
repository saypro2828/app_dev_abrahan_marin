<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\controladorProductos;

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

Route::get('/', function () {
    return view('/home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/creardata', [controladorProductos::class, 'creardata'])->name('producto.creardata');
Route::post('/editdata', [controladorProductos::class, 'editdata'])->name('producto.editdata');
Route::post('/compra_completa', [HomeController::class, 'getrespuesta'])->name('producto.respuesta');
Route::post('/facturar', [controladorProductos::class, 'facturar'])->name('producto.facturar');
Route::get('/crear_producto', [controladorProductos::class, 'getproducto'])->name('producto.producto');
Route::post('/crear_prod', [controladorProductos::class, 'crear_producto'])->name('producto.prod');
Route::get('/facturar_mostrar/{id} ', [controladorProductos::class, 'mostrarFactura'])->name('producto.facturar_mostrar');
