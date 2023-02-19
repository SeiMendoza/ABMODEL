<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PedidoUsuarioController;
use App\Http\Controllers\MenuUsuarioController;
use App\Http\Controllers\PlatillosyBebidasController;
use App\Http\Controllers\ComboController;
use App\Http\Controllers\BusquedaAdmonController;
use Illuminate\Support\Facades\Route;

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

/**Home */
Route::get('/', [HomeController::class, 'index'])
->name('index');
Route::get('/tabla', [HomeController::class, 't'])
->name('t');
Route::get('/billing', [HomeController::class, 'b'])
->name('b');
Route::get('/admonRestaurante', [HomeController::class, 'admonRestaurante'])
->name('admonRestaurante');
Route::get('/profile', [HomeController::class, 'p'])
->name('p');
Route::get('/sing', [HomeController::class, 's'])
->name('s');
Route::get('/rtl', [HomeController::class, 'r'])
->name('r');
Route::get('/registro', [HomeController::class, 'registro'])
->name('registro');

/*****************************
  Rutas Para Menú de usuario
******************************/
Route::get('/menu/usuario/pedido', [PedidoUsuarioController::class, 'create'])
->name('usuario_pedido.create');

 /*****************************
  Rutas Para Menu de cliente
******************************/

Route::get('/menu/cliente', [MenuUsuarioController::class, 'index'])
->name('cliente_menu.index');/*Ruta de visualizacion de menu*/
//Route::get('/menu', [MenuUsuarioController::class,'search'])
//->name('menu.search');

/*****************************
  Rutas Para Platillos y Bebidas
******************************/
Route::get('/bebidasyplatillos/nuevo', [PlatillosyBebidasController::class, 'create'])
->name('bebidasyplatillos.create');

Route::post('/bebidasyplatillos/nuevo',[PlatillosyBebidasController::class, 'store'])
    ->name('bebidasyplatillos.store');

/*****************************
  Rutas Para Combos
******************************/
Route::get('/combos/nuevo', [ComboController::class, 'create'])
->name('combo.create');

Route::post('/combos/nuevo',[ComboController::class, 'store'])
    ->name('combo.store');

  Route::post('/combos/temporal',[ComboController::class, 'temporal'])
    ->name('combo.temporal');

/*****************************
  Rutas Para Administración
******************************/
Route::get('/busqueda', [BusquedaAdmonController::class, 'index'])
    ->name('busqueda.index');
 