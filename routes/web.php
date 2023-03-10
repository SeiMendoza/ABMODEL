<?php

use App\Http\Controllers\BebidaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KioskoController;
use App\Http\Controllers\PedidoUsuarioController;
use App\Http\Controllers\MenuUsuarioController;
use App\Http\Controllers\PlatilloController;
use App\Http\Controllers\PlatillosyBebidasController;
use App\Http\Controllers\ComboController;
use App\Http\Controllers\BusquedaAdmonController;
use App\Http\Controllers\EditarPlatilloController;
use App\Http\Controllers\EditarBebidaController;
use App\Http\Controllers\PiscinaController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\ReservacionController;
use App\Http\Controllers\ReservacionTotalController;
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

/* Rutas Administracion de Restaurante */
Route::get('/admonRestaurante', [HomeController::class, 'indexAdmon'])
->name('menuAdmon.index');
Route::put('admonRestaurante/{id}/activarBebida', [BebidaController::class, 'activar'])
->name('menuAdmon.activarBebida');
Route::put('admonRestaurante/{id}/activarPlatillo', [PlatilloController::class, 'activar'])
->name('menuAdmon.activarPlatillo');
Route::put('admonRestaurante/{id}/activarCombo', [ComboController::class, 'activar'])
->name('menuAdmon.activarCombo');

/** Rutas de Prueba AmonMenu */
Route::get('/pruebaAdmon', [HomeController::class, 'pruebaAdmon'])
->name('menuAdmon.prueba');


Route::get('/profile', [HomeController::class, 'p'])
->name('p');
Route::get('/sing', [HomeController::class, 's'])
->name('s');
Route::get('/rtl', [HomeController::class, 'r'])
->name('r');
Route::get('dashboard', [HomeController::class, 'd'])
->name('d');
Route::get('/sing-up', [HomeController::class, 'u'])
->name('u');
Route::get('/registro', [HomeController::class, 'registro'])
->name('registro');

/*****************************
  Rutas Para Men?? de usuario
******************************/
Route::get('/menu/usuario/pedido', [PedidoUsuarioController::class, 'create'])
->name('usuario_pedido.create');
Route::post('/menu/usuario/pedido/crear', [PedidoUsuarioController::class, 'store'])
->name('usuario_pedido.store');
Route::put('/menu/{id}/terminar', [PedidoUsuarioController::class,'terminarp'])
->name('terminar.terminarp')->where('id','[0-9]+');/*terminar pedidos en caja*/
Route::get('/menu/pedidot', [PedidoUsuarioController::class, 'pedido_terminados'])
->name('pedidost.pedido');/*lista de pedidos pendientes de terminar en caja*/
Route::put('/menu/{id}/pendiente_cocina', [PedidoUsuarioController::class,'pedidosPendientes_Cocina'])
->name('pedidosPendientes_Cocina.pedidosPendientes_Cocina')->where('id','[0-9]+');/*terminar pedido en cocina*/
Route::get('/menu/pedidop', [PedidoUsuarioController::class, 'pedido_pendientes'])
->name('pedidosp.pedido');/*lista de pedidos pendientes en cocina*/
Route::get('/menu/pedidos/terminados', [PedidoUsuarioController::class, 'terminados'])
->name('terminados.terminados'); /*lista de pedidos terminados*/
Route::get('/menu/pedidot/{id}', [PedidoUsuarioController::class, 'detalle_pedido_terminados'])
->name('pedidost.detalle');/*detalle de pedidos pendientes de terminar en caja*/
Route::get('/menu/pedidop/{id}', [PedidoUsuarioController::class, 'detalle_pedido_pendientes'])
->name('pedidosp.detalle');/*detalle de pedidos pendientes en cocina*/
Route::get('/menu/pedidos/terminados/{id}', [PedidoUsuarioController::class, 'detalle_terminados'])
->name('terminados.detalle'); /*lista de pedidos terminados*/

 /*****************************
  Rutas Para Menu de cliente
******************************/

Route::get('/menu/cliente/buscar', [MenuUsuarioController::class, 'search'])
->name('cliente_menu.search');
Route::get('/menu/qr', [MenuUsuarioController::class, 'qr'])
->name('cliente_menu.qr');
Route::get('/menu/prueba', [MenuUsuarioController::class, 'prueba'])
->name('cliente_prueba');
 
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

Route::post('/combos/{id}',[ComboController::class, 'destroy'])
  ->name('combo.destroy');

  Route::get('combo/{id}/borrar', [ComboController::class, 'destroyC'])
  ->name('combo.borrar');

/*****************************
  Rutas De estado
******************************/
Route::get('/estado/nuevo', [ComboController::class, 'estado'])
->name('estado.create');

Route::post('/estado/nuevo',[ComboController::class, 'estadoactualizar'])
    ->name('estado.store');



/*****************************
  Rutas Para Administraci??n
******************************/
Route::get('/busqueda', [BusquedaAdmonController::class, 'index'])
    ->name('busqueda.index');



/****************************************
  Rutas Para Editar Platillos y Bebidas
*****************************************/
Route::get('platillo/{id}/editar', [EditarPlatilloController::class, 'edit'])
    ->name('plato.editar');

Route::put('platillo/{id}/edicion', [EditarPlatilloController::class, 'update'])
    ->name('plato.update');

Route::get('bebida/{id}/editar', [EditarBebidaController::class, 'edit'])
    ->name('bebida.editar');
  
Route::put('bebida/{id}/edicion', [EditarBebidaController::class, 'update'])
    ->name('bebida.update');

/*lista de pedidos anteriores*/
Route::get('/menu/pedidos/anteriores', [PedidoUsuarioController::class, 'pedidos_anteriores'])
    ->name('pedidoant.pedidos_anteriores'); 
/*Borrar pedidos anteriores*/
Route::post('/EliminarDatos', [PedidoUsuarioController::class, 'borrarDatos'])
    ->name('borrar.borrarDatos');
/* Detalles pedidos anteriores */
Route::post('/menu/pedido/anterior/{id}', [PedidoUsuarioController::class, 'detalles_anteriores'])
->name('pedidoAnterior.detalle'); 

/****************************************
  Rutas Para eliminar Platillos y Bebidas
*****************************************/
 Route::get('platillo/{id}/borrar', [PlatilloController::class, 'destroy'])
    ->name('platillo.borrar');
 Route::get('bebida/{id}/borrar', [BebidaController::class, 'destroy'])
    ->name('bebida.borrar');

/****************************************
  Rutas Para Kioskos
*****************************************/
Route::get('/kioskos', [KioskoController::class, 'index'])->
name('kiosko.index');

Route::get('/kioskos/create', [KioskoController::class, 'create'])->
name('kiosko.create');

Route::post('/kiosko', [KioskoController::class, 'store'])->
name('kiosko.store');

Route::get('/kiosko/{id}/edit', [KioskoController::class, 'edit'])->
name('kiosko.edit');

Route::put('/kiosko/{id}/update', [KioskoController::class, 'update'])->
name('kiosko.update');

/*Route::post('/kiosko/{id}/destroy', [KioskoController::class, 'destroy'])->
name('kiosko.destroy');*/

Route::get('/kiosko/{id}/destroy', [KioskoController::class, 'destroy'])->
name('kiosko.destroy');

  /****************************************
  Rutas Para Piscina
*****************************************/
//Route::get('/piscina/productos', [PiscinaController::class, 'index'])->
Route::get('/productos', [PiscinaController::class, 'index'])->
name('prodpiscina.index');
Route::get('/piscina/producto/buscar', [PiscinaController::class, 'search'])
->name('producto.search');
Route::get('/piscina/create', [PiscinaController::class, 'create'])->
name('piscina.create');

Route::post('/piscina/create', [PiscinaController::class, 'store'])->
name('piscina.store');
Route::get('piscina/{id}/editar', [PiscinaController::class, 'edit'])
    ->name('producto.edit');
    Route::delete('/piscina/{id}/borrar', [PiscinaController::class, 'destroy'])
    ->name('prodpiscina.destroy')->where('id','[0-9]+');
Route::put('piscina/{id}/edicion', [PiscinaController::class, 'update'])
    ->name('producto.update');

/****************************************
  Rutas Para Mesas
*****************************************/

/**
 * Registro de mesas
*/

Route::get('/mesas/registro', [MesaController::class, 'index'])
->name('mesas_reg.index');

Route::post('/mesas/registro/nuevo',[MesaController::class, 'store'])
->name('mesas_reg.store');

Route::put('/mesas/registro/{id}/edicion', [MesaController::class, 'update'])
->name('mesas_reg.update')->where('id','[0-9]+');

Route::delete('/mesas/registro/{id}/borrar', [MesaController::class, 'destroy'])
->name('mesas_reg.destroy')->where('id','[0-9]+');

Route::get('/mesas/registro/buscar', [MesaController::class, 'search'])
->name('mesas_reg.search');

/**
 * Reservaciones de mesas
*/

Route::get('/mesas/reservaciones', [ReservacionController::class, 'index2'])
->name('mesas_res.index');

Route::post('/mesas/reservaciones/nuevo',[ReservacionController::class, 'store'])
->name('mesas_res.store');

Route::put('/mesas/reservaciones/{id}/edicion', [ReservacionController::class, 'update'])
->name('mesas_res.update')->where('id','[0-9]+');

Route::delete('/mesas/reservaciones/{id}/borrar', [ReservacionController::class, 'destroy'])
->name('mesas_res.destroy')->where('id','[0-9]+');

Route::get('/mesas/reservaciones/buscar', [ReservacionController::class, 'search2'])
->name('mesas_res.search');


/* Rutas para reservar local*/
Route::get('Reser/Local', [ReservacionTotalController::class, 'reservaLocal'])
       ->name('cliente.reservaLocal');

Route::get('/Local/create', [ReservacionTotalController::class, 'create'])
       -> name('ReserLocal.create');

Route::post('/Reservacion/Local', [ReservacionTotalController::class, 'store'])
->name('ReserLocal.store');

Route::get('Cliente/{id}/Editando', [ReservacionTotalController::class, 'edit'])
  ->name('ResCliente.editar');

Route::put('Cliente/{id}/edicion', [ReservacionTotalController::class, 'update'])
  ->name('resCliente.update');

Route::get('cliente/{id}/borrar', [ReservacionTotalController::class, 'destroy'])
  ->name('cliente.borrar');
