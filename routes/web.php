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
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\LoginController;
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
Route::get('/', [LoginController::class, 'show'])
->name('login'); 
Route::get('/ab', [HomeController::class, 'index'])
->name('index');
Route::get('/tabla', [HomeController::class, 't'])
->name('t');
Route::get('/billing', [HomeController::class, 'b'])
->name('b');

/** LOGIN */
Route::get('/registro', [RegistroController::class, 'show']);

Route::post('/registro', [RegistroController::class, 'registro']);

Route::get('/login', [LoginController::class, 'show']);

Route::post('/login', [LoginController::class, 'login']);

Route::get('/CerrarSesión', [LoginController::class, 'cerrar'])
   ->name('cerrarSes.cerrar');

/**PERFIL USUARIO */
Route::get("/perfil", [LoginController::class, "perfil"])
->name('usuarios.perfil')->where('id', '[0-9]+');






/* Rutas Administracion de Restaurante */

Route::get('/admonRestauranteP', [HomeController::class, 'indexPlatillos'])
->name('menuAdmon.platillos');
Route::get('/admonRestauranteB', [HomeController::class, 'indexBebidas'])
->name('menuAdmon.bebidas');
Route::get('/admonRestauranteC', [HomeController::class, 'indexComplementos'])
->name('menuAdmon.complementos');


Route::get('/admonRestaurante', [HomeController::class, 'indexAdmon'])
->name('menuAdmon.index');
Route::put('bebida/{id}/activar', [BebidaController::class, 'activar'])
->name('bebida.activar');
Route::put('platillo/{id}/activar', [PlatilloController::class, 'activar'])
->name('platillo.activar');
Route::put('combo/{id}/activar', [ComboController::class, 'activar'])
->name('combo.activar');

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
  Rutas Para Menú de usuario
******************************/

Route::put('/menu/{id}/terminar', [PedidoUsuarioController::class,'terminarp'])
->name('terminar.terminarp')->where('id','[0-9]+');/*terminar pedidos en caja*/
Route::put('/menu/{id}/envcocina', [PedidoUsuarioController::class,'env_a_cocina'])
->name('env.env_a_cocina')->where('id','[0-9]+');/*enviar a cocina*/
Route::get('/pedidos/caja', [PedidoUsuarioController::class, 'pedido_terminados'])
->name('pedidos.caja');/*lista de pedidos pendientes de terminar en caja*/
Route::get('/pedidos/caja/search', [PedidoUsuarioController::class, 'psearch'])
->name('pedidos.psearch');/*buscar pedidos en caja*/
Route::put('/pedidos/{id}/pendiente_cocina', [PedidoUsuarioController::class,'pedidosPendientes_Cocina'])
->name('pedidosPendientes_Cocina.pedidosPendientes_Cocina')->where('id','[0-9]+');/*terminar pedido en cocina*/
Route::get('/pedidos/cocina', [PedidoUsuarioController::class, 'pedido_pendientes'])
->name('pedidosp.pedido');/*lista de pedidos pendientes en cocina*/
Route::get('/menu/pedidop/cocina', [PedidoUsuarioController::class, 'pcsearch'])
->name('pedidosp.pcsearch');/*buscar pedidos en cocina*/
Route::get('/pedidos/terminados', [PedidoUsuarioController::class, 'terminados'])
->name('terminados.terminados'); /*lista de pedidos terminados*/
Route::get('/menu/pedidost', [PedidoUsuarioController::class, 'search'])
->name('pedidost.search');/*buscar pedidos terminados*/
Route::get('/pedidos/caja/detalle/{id}', [PedidoUsuarioController::class, 'detalle_pedido_terminados'])
->name('pedidost.detalle');/*detalle de pedidos pendientes de terminar en caja*/
Route::delete('/pedidos/detalles/{id}/borrar', [PedidoUsuarioController::class, 'destroy'])
->name('detallep.destroy')->where('id','[0-9]+');/**borrar detalle de caja */
Route::get('/pedidos/{pedido_id}/detalles/{detalle_id}/editar', [PedidoUsuarioController::class, 'edit'])
    ->name('detallep.edit');
Route::put('/pedidos/{pedido_id}/detalles/{detalle_id}/editar', [PedidoUsuarioController::class, 'update'])
->name('detallep.update')->where('id','[0-9]+');/**editar detalle de caja */
Route::get('/pedidos/cocina/detalle/{id}', [PedidoUsuarioController::class, 'detalle_pedido_pendientes'])
->name('pedidosp.detalle');/*detalle de pedidos pendientes en cocina*/
Route::get('/pedidos/terminados/detalle/{id}', [PedidoUsuarioController::class, 'detalle_terminados'])
->name('terminados.detalle'); /*lista de pedidos terminados*/

Route::post('/obtener-precio',[PedidoUsuarioController::class, 'obtenerPrecio'])
->name('obtener-precio');

 /*****************************
  Rutas Para Menu de cliente
******************************/

Route::post('/menu/pedido/detalles', [MenuUsuarioController::class, 'details'])
->name('cliente_menu.details');
Route::get('/menu/qr', [MenuUsuarioController::class, 'qr'])
->name('cliente_menu.qr');
Route::get('/menu/prueba', [MenuUsuarioController::class, 'prueba'])
->name('cliente_prueba');
Route::get('/menu/usuario/pedido', [MenuUsuarioController::class, 'create'])
->name('usuario_pedido.create');
Route::post('/menu/usuario/pedido', [MenuUsuarioController::class, 'store'])
->name('cliente_pedido.store');
Route::put('/menu/detalles/{id}/editar', [MenuUsuarioController::class, 'edit'])
->name('cliente_detalles.edit')->where('id','[0-9]+');
Route::delete('/menu/detalles/{id}/borrar', [MenuUsuarioController::class, 'destroy'])
->name('cliente_detalles.destroy')->where('id','[0-9]+');
 
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

Route::delete('/combos/{id}',[ComboController::class, 'destroy'])
  ->name('combo.destroy');

  Route::delete('combo/{id}/borrar', [ComboController::class, 'destroyC'])
  ->name('combo.borrar');

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
  Rutas Para Editar Productos
*****************************************/
Route::get('platillo/{id}/editar', [EditarPlatilloController::class, 'edit'])
    ->name('plato.editar');

Route::put('platillo/{id}/edicion', [EditarPlatilloController::class, 'update'])
    ->name('plato.update');

Route::get('bebida/{id}/editar', [EditarBebidaController::class, 'edit'])
    ->name('bebida.editar');
  
Route::put('bebida/{id}/edicion', [EditarBebidaController::class, 'update'])
    ->name('bebida.update');

Route::get('complemento/{id}/editar', [PlatillosyBebidasController::class, 'edit'])
    ->name('complemento.editar');
  
Route::put('complemento/{id}/edicion', [PlatillosyBebidasController::class, 'update'])
    ->name('complemento.update');

/****************************************
  Rutas Para Editar Combos
*****************************************/
Route::get('combo/{id}/editar', [ComboController::class, 'edit'])
    ->name('combo.editar');
  
Route::put('combo/{id}/edicion', [ComboController::class, 'update'])
    ->name('combo.update');




/*lista de pedidos anteriores*/
Route::get('/menu/pedidos/anteriores', [PedidoUsuarioController::class, 'pedidos_anteriores'])
    ->name('pedidoant.pedidos_anteriores'); 
/*Borrar pedidos anteriores*/
Route::delete('/EliminarDatos', [PedidoUsuarioController::class, 'borrarDatos'])
    ->name('borrar.borrarDatos');
/* Detalles pedidos anteriores */
Route::post('/menu/pedido/anterior/{id}', [PedidoUsuarioController::class, 'detalles_anteriores'])
->name('pedidoAnterior.detalle'); 

/****************************************
  Rutas Para eliminar Platillos y Bebidas
*****************************************/
 Route::delete('platillo/{id}/borrar', [PlatilloController::class, 'destroy'])
    ->name('platillo.borrar');
 Route::delete('bebida/{id}/borrar', [BebidaController::class, 'destroy'])
    ->name('bebida.borrar');

/****************************************
  Rutas Para Kioskos
*****************************************/
Route::controller(KioskoController::class)-> group( function (){
  Route::get('/kioskos', 'index')->name('kiosko.index');
  Route::get('/kioskos/create', 'create')->name('kiosko.create');
  Route::post('/kiosko', 'store')->name('kiosko.store');
  Route::get('/kiosko/{id}/edit', 'edit')->name('kiosko.edit');
  Route::put('/kiosko/{id}/update','update')->name('kiosko.update');
  Route::delete('/kiosko/{id}/destroy', 'destroy')->name('kiosko.destroy');
});
/*Route::post('/kiosko/{id}/destroy', [KioskoController::class, 'destroy'])->
name('kiosko.destroy');*/

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
Route::post('/piscina/agregar/{id}', [PiscinaController::class, 'agregar'])->
name('piscina.agregar');
Route::post('/piscina/restar/{id}', [PiscinaController::class, 'restar'])->
name('piscina.restar');
Route::get('piscina/{id}', [PiscinaController::class, 'show'])
    ->name('piscina.show');

/****************************************
  Rutas Para Mesas
*****************************************/

/**
 * Reservaciones de mesas
*/

Route::get('/mesas/reservaciones', [MesaController::class, 'indexR'])
->name('mesas_res.index');

Route::get('/mesas/reservaciones/detalles', [MesaController::class, 'show'])
->name('mesas_res.show');

/**
 * Registro de mesas
*/

Route::get('/mesas/registro', [MesaController::class, 'index'])
->name('mesas_reg.index');
/**ruta para qr por id de mesa */
Route::get('/mesas/{id}/qr', [MesaController::class, 'Codigo_Qr'])
->name('mesa.Codigo_Qr')->where('id','[0-9]+');

Route::get('/mesas/registro/nuevo',[MesaController::class, 'create'])
->name('mesas_reg.create');

Route::post('/mesas/registro/nuevo',[MesaController::class, 'store'])
->name('mesas_reg.store');

Route::get('/mesas/registro/{id}/edicion', [MesaController::class, 'edit'])
->name('mesas_reg.edit')->where('id','[0-9]+');

Route::put('/mesas/registro/{id}/edicion', [MesaController::class, 'update'])
->name('mesas_reg.update')->where('id','[0-9]+');

Route::delete('/mesas/registro/{id}/borrar', [MesaController::class, 'destroy'])
->name('mesas_reg.destroy')->where('id','[0-9]+');

Route::get('/mesas/registro/buscar', [MesaController::class, 'search'])
->name('mesas_reg.search');

/**
 * Reservaciones de kioskos
*/

Route::get('/kiosko/reservaciones', [ReservacionController::class, 'index2'])
->name('kiosko_res.index');

Route::get('/kiosko/reservaciones/nuevo',[ReservacionController::class, 'create'])
->name('kiosko_res.create');

Route::post('/kiosko/reservaciones/nuevo',[ReservacionController::class, 'store'])
->name('kiosko_res.store');

Route::get('/kiosko/reservaciones/{id}/edicion', [ReservacionController::class, 'edit'])
->name('kiosko_res.edit')->where('id','[0-9]+');

Route::put('/kiosko/reservaciones/{id}/edicion', [ReservacionController::class, 'update'])
->name('kiosko_res.update')->where('id','[0-9]+');

Route::delete('/kiosko/reservaciones/{id}/borrar', [ReservacionController::class, 'destroy'])
->name('kiosko_res.destroy')->where('id','[0-9]+');

Route::get('/kiosko/reservaciones/buscar', [ReservacionController::class, 'search2'])
->name('kiosko_res.search');

Route::get('/kiosko/reservaciones/{id}/detail', [ReservacionController::class, 'detail'])->
name('kiosko.detail');

/* Rutas para reservar local*/
Route::get('Reser/Local', [ReservacionTotalController::class, 'reservaLocal'])
  ->name('cliente.reservaLocal');
      
 Route::get('Evento/Realizado', [ReservacionTotalController::class, 'reali'])
  ->name('evento.realizado');      

Route::get('/Local/create', [ReservacionTotalController::class, 'create'])
   -> name('ReserLocal.create');

Route::post('/Reservacion/Local', [ReservacionTotalController::class, 'store'])
->name('ReserLocal.store');

Route::get('/cliente/reservacion/{id}/detalles', [ReservacionTotalController::class, 'detalle_reservacion'])
  ->name('detalle.reservacion');
 
Route::get('Cliente/{id}/Editando', [ReservacionTotalController::class, 'edit'])
  ->name('ResCliente.editar');

Route::put('Cliente/{id}/edicion', [ReservacionTotalController::class, 'update'])
  ->name('resCliente.update');

Route::delete('cliente/{id}/borrar', [ReservacionTotalController::class, 'destroy'])
  ->name('cliente.destroy');

Route::put('/cliente/{id}/reservacionRealizada', [ReservacionTotalController::class,'reservacionesRealizadas'])
  ->name('reservacionRealizada')->where('id','[0-9]+');

Route::get('/Reservaciones/Realizadas', [ReservacionTotalController::class, 'Realizadas'])
  ->name('realizadas.realizadas'); /*lista de reservaciones realizadas */
  
Route::get('/Reservacion/{id}/Realizada/Detalles', [ReservacionTotalController::class, 'detalleRealizadas'])
  ->name('detalle.realizadas');