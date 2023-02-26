<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PedidoUsuarioController;
use App\Http\Controllers\MenuUsuarioController;
use App\Http\Controllers\PlatillosyBebidasController;
use App\Http\Controllers\ComboController;
use App\Http\Controllers\BusquedaAdmonController;
use App\Http\Controllers\EditarPlatilloBebidaController;
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
Route::get('dashboard', [HomeController::class, 'd'])
->name('d');
Route::get('/registro', [HomeController::class, 'registro'])
->name('registro');

/*****************************
  Rutas Para Menú de usuario
******************************/
Route::get('/menu/usuario/pedido', [PedidoUsuarioController::class, 'create'])
->name('usuario_pedido.create');
Route::get('/menu/usuario/pedido/crear', [PedidoUsuarioController::class, 'store'])
->name('usuario_pedido.store');
Route::put('/menu/{id}/terminar', [PedidoUsuarioController::class,'terminarp'])
->name('terminar.terminarp')->where('id','[0-9]+');
Route::get('/menu/pedidot', [PedidoUsuarioController::class, 'pedido_terminados'])
->name('pedidost.pedido');
Route::get('/menu/pedidop', [PedidoUsuarioController::class, 'pedido_pendientes'])
->name('pedidosp.pedido');
 /*****************************
  Rutas Para Menu de cliente
******************************/

Route::get('/menu/cliente', [MenuUsuarioController::class, 'index'])
->name('cliente_menu.index');/*Ruta de visualizacion de menu*/
Route::get('/menu/qr', [MenuUsuarioController::class, 'qr'])
->name('cliente_menu.qr');
 
//Route::get('/menu', [MenuUsuarioController::class,'search'])
//->name('menu.search');

/*****************************
  Rutas Para Platillos y Bebidas
******************************/
Route::get('/menu/cliente', [PlatillosyBebidasController::class, 'index'])
->name('cliente_menu.index');
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
  Rutas De estado
******************************/
Route::get('/estado/nuevo', [ComboController::class, 'estado'])
->name('estado.create');

Route::post('/estado/nuevo',[ComboController::class, 'estadoactualizar'])
    ->name('estado.store');

/*****************************
  Rutas Para Administración
******************************/
Route::get('/busqueda', [BusquedaAdmonController::class, 'index'])
    ->name('busqueda.index');

/****************************************
  Rutas Para Editar Platillos y Bebidas
*****************************************/
Route::get('platilloybebida/{id}/editar', [EditarPlatilloBebidaController::class, 'edit'])
      ->name('platobebida.editar');

Route::put('platilloybebida/{id}/edicion', [EditarPlatilloBebidaController::class, 'update'])
      ->name('platobebida.update');




 