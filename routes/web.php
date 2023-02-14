<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PedidoUsuarioController;
use App\Http\Controllers\PlatillosyBebidasController;
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
Route::get('/dashboard', [HomeController::class, 'd'])
->name('d');
Route::get('/profile', [HomeController::class, 'p'])
->name('p');
Route::get('/sing', [HomeController::class, 's'])
->name('s');
Route::get('/rtl', [HomeController::class, 'r'])
->name('r');


/*****************************
  Rutas Para Menú de usuario
******************************/
Route::get('/menu/usuario/pedido', [PedidoUsuarioController::class, 'create'])
->name('usuario_pedido.create');

Route::get('/menu/usuario', [PedidoUsuarioController::class, 'index'])
->name('usuario_menu.index');/*Ruta de visualizacion de menu*/

/*****************************
  Rutas Para Platillos y Bebidas
******************************/
Route::get('/bebidasyplatillos/nuevo', [PlatillosyBebidasController::class, 'create'])
->name('bebidasyplatillos.create');

Route::post('/bebidasyplatillos/nuevo',[PlatillosyBebidasController::class, 'store'])
    ->name('bebidasyplatillos.store');
