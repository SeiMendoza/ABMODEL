<?php

use App\Http\Controllers\PedidoUsuarioController;
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

Route::get('/', function () {
    return view('welcome');
});


/*****************************
  Rutas Para Menú de usuario
******************************/
Route::get('/menu/usuario/pedido', [PedidoUsuarioController::class, 'create'])
->name('usuario_pedido.create');
