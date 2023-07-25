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
use App\Http\Controllers\CartController;
use App\Http\Controllers\DetallesPedidoController;
use App\Http\Controllers\EditarPlatilloController;
use App\Http\Controllers\EditarBebidaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PiscinaController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\ReservacionController;
use App\Http\Controllers\ReservacionTotalController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\LoginController;
use App\Http\Livewire\Counter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
/**Home */
Route::get('/', [LoginController::class, 'show'])
->name('login');
Route::get('/ab', [HomeController::class, 'index'])->middleware('auth')
->name('index');

Route::get('/tabla', [HomeController::class, 't'])
->name('t');
Route::get('/billing', [HomeController::class, 'b'])
->name('b');

/** REGISTRO Y LOGIN */ 

Route::get('/listaUsuarios', [RegistroController::class, 'users'])->middleware('auth')
->name('usuarios.users');

Route::get('/usuarios/create', [RegistroController::class, 'create'])->middleware('auth')
->name("usuarios.create"); 

Route::post('/usuarios/create', [RegistroController::class, 'store'])->middleware('auth')
->name("usuarios.store");

Route::get('/usuarios/{id}/edit', [RegistroController::class, 'edit'])->middleware('can:update,user')
->name("usuarios.editar")->where('id', '[0-9]+');

Route::put('/usuarios/{id}/edit', [RegistroController::class, 'update'])->middleware('auth')
->name('usuarios.update')->where('id', '[0-9]+'); 

Route::delete('usuarios/{id}/borrar', [RegistroController::class, 'destroy'])->middleware('auth')
->name('usuarios.destroy');


/**PERFIL USUARIO */
Route::get('/login', [LoginController::class, 'show']);

Route::post('/login', [LoginController::class, 'login']);

Route::get('/CerrarSesión', [LoginController::class, 'cerrar'])->middleware('auth')
->name('cerrarSes.cerrar');

Route::get('/perfil', [LoginController::class, 'perfil'])->middleware('auth')
->name('usuarios.perfil');

Route::get('/usuarios/{id}/editando/perfil', [LoginController::class, 'edit'])->middleware('auth')
->name("usuarios.editarPerfil");

Route::put('/usuarios/{id}/editando/perfil', [LoginController::class, 'update'])->middleware('auth')
->name('usuarios.updatePerfil'); 



/* Rutas Administracion de Restaurante */
Route::controller(HomeController::class)->middleware('auth')->group( function(){
  Route::get('/admonRestauranteP', 'indexPlatillos')->name('menuAdmon.platillos');
  Route::get('/admonRestauranteB', 'indexBebidas')->name('menuAdmon.bebidas');
  Route::get('/admonRestauranteC', 'indexComplementos')->name('menuAdmon.complementos');
  Route::get('/admonRestaurante', 'indexPlatillos')->name('menuAdmon.index');
  Route::get('/pruebaAdmon','pruebaAdmon')->name('menuAdmon.prueba');
}); 

Route::put('producto/{id}/activar', [ProductoController::class, 'activar'])    
->name('producto.activar');





/** Rutas de administración de Productos */


Route::get('/profile', [HomeController::class, 'p'])->middleware('auth')
->name('p');
Route::get('/sing', [HomeController::class, 's'])->middleware('auth')
->name('s');
Route::get('/rtl', [HomeController::class, 'r'])->middleware('auth')
->name('r');
Route::get('dashboard', [HomeController::class, 'd'])->middleware('auth')
->name('d');
Route::get('/sing-up', [HomeController::class, 'u'])->middleware('auth')
->name('u');
Route::get('/registro', [HomeController::class, 'registro'])->middleware('auth')
->name('registro');

/*****************************
  Rutas Para Menú de usuario
******************************/

Route::put('/menu/{id}/terminar', [PedidoUsuarioController::class,'terminarp'])->middleware('auth')
->name('terminar.terminarp')->where('id','[0-9]+');/*terminar pedidos en caja*/
Route::put('/menu/{id}/envcocina', [PedidoUsuarioController::class,'env_a_cocina'])->middleware('auth')
->name('env.env_a_cocina')->where('id','[0-9]+');/*enviar a cocina*/
Route::get('/pedidos/caja', [PedidoUsuarioController::class, 'pedido_terminados'])->middleware('auth')
->name('pedidos.caja');/*lista de pedidos pendientes de terminar en caja*/
Route::get('/pedidos/caja/search', [PedidoUsuarioController::class, 'psearch'])->middleware('auth')
->name('pedidos.psearch');/*buscar pedidos en caja*/
Route::put('/pedidos/{id}/pendiente_cocina', [PedidoUsuarioController::class,'pedidosPendientes_Cocina'])->middleware('auth')
->name('pedidosPendientes_Cocina.pedidosPendientes_Cocina')->where('id','[0-9]+');/*terminar pedido en cocina*/
Route::get('/pedidos/cocina', [PedidoUsuarioController::class, 'pedido_pendientes'])->middleware('auth')
->name('pedidosp.pedido');/*lista de pedidos pendientes en cocina*/
Route::get('/menu/pedidop/cocina', [PedidoUsuarioController::class, 'pcsearch'])->middleware('auth')
->name('pedidosp.pcsearch');/*buscar pedidos en cocina*/
Route::get('/pedidos/terminados', [PedidoUsuarioController::class, 'terminados'])->middleware('auth')
->name('terminados.terminados'); /*lista de pedidos terminados*/
Route::get('/menu/pedidost', [PedidoUsuarioController::class, 'search'])->middleware('auth')
->name('pedidost.search');/*buscar pedidos terminados*/
Route::get('/pedidos/caja/detalle/{id}', [PedidoUsuarioController::class, 'detalle_pedido_terminados'])->middleware('auth')
->name('pedidost.detalle');/*detalle de pedidos pendientes de terminar en caja*/
Route::delete('/pedidos/detalles/{id}/borrar', [PedidoUsuarioController::class, 'destroy'])->middleware('auth')
->name('detallep.destroy')->where('id','[0-9]+');/**borrar detalle de caja */
Route::get('/pedidos/{pedido_id}/detalles/{detalle_id}/editar', [PedidoUsuarioController::class, 'edit'])->middleware('auth')
    ->name('detallep.edit');
Route::put('/pedidos/{pedido_id}/detalles/{detalle_id}/editar', [PedidoUsuarioController::class, 'update'])->middleware('auth')
->name('detallep.update')->where('id','[0-9]+');/**editar detalle de caja */
Route::get('/pedidos/cocina/detalle/{id}', [PedidoUsuarioController::class, 'detalle_pedido_pendientes'])->middleware('auth')
->name('pedidosp.detalle');/*detalle de pedidos pendientes en cocina*/
Route::get('/pedidos/terminados/detalle/{id}', [PedidoUsuarioController::class, 'detalle_terminados'])->middleware('auth')
->name('terminados.detalle'); /*lista de pedidos terminados*/
//obtener el precio de los productos
Route::post('/precio-acompl',[PedidoUsuarioController::class, 'PrecioAcompl'])->middleware('auth')
->name('precio-acompl');
//agrega el complemento al detalle del pedido
Route::get('/pedido/caja/detalle/{id}/agrecompl', [PedidoUsuarioController::class,'ACompl'])->middleware('auth')
->name('ACompl');
Route::post('/pedido/caja/detalle/{id}/agrecompl', [PedidoUsuarioController::class,'Acomple'])->middleware('auth')
->name('Acomple');
// cambiar la mesa del pedido en detalles de caja
Route::post('/pedidos/{id}/cambiarmesa', [PedidoUsuarioController::class,'Cambiar_mesa'])
->name('cambiar_mesa');

 /*****************************
  Rutas Para Menu de cliente
******************************/

Route::post('/menu/pedido/detalles', [MenuUsuarioController::class, 'details'])->middleware('auth')
->name('cliente_menu.details');
Route::get('/menu/qr', [MenuUsuarioController::class, 'qr'])->middleware('auth')
->name('cliente_menu.qr');
Route::get('/menu/prueba', [MenuUsuarioController::class, 'prueba'])->middleware('auth')
->name('cliente_prueba');
Route::get('/menu/usuario/pedido', [MenuUsuarioController::class, 'create'])->middleware('auth')
->name('usuario_pedido.create');
Route::post('/menu/usuario/pedido', [MenuUsuarioController::class, 'store'])->middleware('auth')
->name('cliente_pedido.store');
Route::put('/menu/detalles/{id}/editar', [MenuUsuarioController::class, 'edit'])->middleware('auth')
->name('cliente_detalles.edit')->where('id','[0-9]+');
Route::delete('/menu/detalles/{id}/borrar', [MenuUsuarioController::class, 'destroy'])->middleware('auth')
->name('cliente_detalles.destroy')->where('id','[0-9]+');
 
//Route::get('/menu', [MenuUsuarioController::class,'search'])
//->name('menu.search');

/*****************************
  Rutas Para Platillos y Bebidas
******************************/
Route::get('/menu/cliente', [PlatillosyBebidasController::class, 'index'])->middleware('auth')
->name('cliente_menu.index');

Route::get('/bebidasyplatillos/nuevo/{origen}', [PlatillosyBebidasController::class, 'create'])->middleware('auth')
->name('bebidasyplatillos.create');

Route::post('/bebidasyplatillos/nuevo/',[PlatillosyBebidasController::class, 'store'])->middleware('auth')
    ->name('bebidasyplatillos.store');

/*****************************
  Rutas De estado
******************************/
Route::get('/estado/nuevo', [ComboController::class, 'estado'])->middleware('auth')
->name('estado.create');

Route::post('/estado/nuevo',[ComboController::class, 'estadoactualizar'])->middleware('auth')
    ->name('estado.store');



/*****************************
  Rutas Para Administración
******************************/
Route::get('/busqueda', [BusquedaAdmonController::class, 'index'])->middleware('auth')
    ->name('busqueda.index');

/****************************************
  Rutas Para Editar Productos
*****************************************/
Route::controller(ProductoController::class)->middleware('auth')->group(function(){

  Route::get('producto/{id}/editar', 'edit')->name('producto.editar');

  Route::put('platillo/{id}/edicion', 'updateP')->name('productoP.update');  
  Route::put('bebida/{id}/edicion', 'updateB')->name('productoB.update');
  Route::put('complemento/{id}/edicion', 'updateC')->name('productoC.update');

  Route::get('producto/{id}/borrar', 'destroy')->name('producto.borrar');
  //Route::delete('bebida/{id}/borrar', 'destroy')->name('bebida.borrar');
});



/*lista de pedidos anteriores*/
Route::get('/menu/pedidos/anteriores', [PedidoUsuarioController::class, 'pedidos_anteriores'])->middleware('auth')
    ->name('pedidoant.pedidos_anteriores'); 
/*Borrar pedidos anteriores*/
Route::delete('/EliminarDatos', [PedidoUsuarioController::class, 'borrarDatos'])->middleware('auth')
    ->name('borrar.borrarDatos');
/* Detalles pedidos anteriores */
Route::post('/menu/pedido/anterior/{id}', [PedidoUsuarioController::class, 'detalles_anteriores'])->middleware('auth')
->name('pedidoAnterior.detalle'); 


/****************************************
  Rutas Para Kioskos
*****************************************/
Route::controller(KioskoController::class)->middleware('auth')-> group( function (){
  Route::get('/kioskos', 'index')->name('kiosko.index');
  Route::get('/kioskos/create', 'create')->name('kiosko.create');
  Route::post('/kiosko', 'store')->name('kiosko.store');
  Route::get('/kiosko/{id}/edit', 'edit')->name('kiosko.edit');
  Route::put('/kiosko/{id}/update','update')->name('kiosko.update');
  Route::get('/kiosko/{id}/detalle', 'detalle')->name('kiosko.detalle');
  Route::delete('/kiosko/{id}/destroy', 'destroy')->name('kiosko.destroy');
  Route::get('/kiosko/{id}/reservaciones', 'reservaciones')->name('kiosko.reservaciones');
  Route::get('/kiosko/{id}/historialReservaciones', 'reservacionesHistorial')->name('kiosko.reservacioneshistorial');
});
/*Route::post('/kiosko/{id}/destroy', [KioskoController::class, 'destroy'])->
name('kiosko.destroy');*/

  /****************************************
  Rutas Para Piscina
*****************************************/
//Route::get('/piscina/productos', [PiscinaController::class, 'index'])->
Route::get('/productos', [PiscinaController::class, 'index'])->middleware('auth')
->name('prodpiscina.index');
Route::get('/piscina/producto/buscar', [PiscinaController::class, 'search'])->middleware('auth')
->name('producto.search');
Route::get('/piscina/create', [PiscinaController::class, 'create'])->middleware('auth')
->name('piscina.create');
Route::post('/piscina/create', [PiscinaController::class, 'store'])->middleware('auth')
->name('piscina.store');
Route::get('piscina/{id}/editar', [PiscinaController::class, 'edit'])->middleware('auth')
->name('producto.edit');
Route::delete('/piscina/{id}/borrar', [PiscinaController::class, 'destroy'])->middleware('auth')
->name('prodpiscina.destroy')->where('id','[0-9]+');
Route::put('piscina/{id}/edicion', [PiscinaController::class, 'update'])->middleware('auth')
->name('producto.update');
Route::post('/piscina/agregar/{id}', [PiscinaController::class, 'agregar'])->middleware('auth')
->name('piscina.agregar');
Route::post('/piscina/restar/{id}', [PiscinaController::class, 'restar'])->middleware('auth')
->name('piscina.restar');
/*Route::get('piscina/{id}', [PiscinaController::class, 'show'])->middleware('auth')
->name('piscina.show');*/

/****************************************
  Rutas Para Mesas
*****************************************/

/**
 * Reservaciones de mesas
*/

Route::get('/mesas/reservaciones', [MesaController::class, 'indexR'])->middleware('auth')
->name('mesas_res.index');

Route::get('/mesas/reservaciones/detalles', [MesaController::class, 'show'])->middleware('auth')
->name('mesas_res.show');

/**
 * Registro de mesas
*/

Route::get('/mesas/lista', [MesaController::class, 'index'])->middleware('auth')
->name('mesas_reg.index');
/**ruta para qr por id de mesa */
Route::get('/mesas/{id}/qr', [MesaController::class, 'Codigo_Qr'])->middleware('auth')
->name('mesa.Codigo_Qr')->where('id','[0-9]+');
/**ruta para imprimir el qr de cada mesa */
Route::get('/qr-pdf/{id}',[MesaController::class, 'Qr_pdf'])->middleware('auth')
->name('qr-pdf');

Route::get('/mesas/registro/nuevo',[MesaController::class, 'create'])->middleware('auth')
->name('mesas_reg.create');

Route::post('/mesas/registro/nuevo',[MesaController::class, 'store'])->middleware('auth')
->name('mesas_reg.store');

Route::get('/mesas/registro/{id}/edicion', [MesaController::class, 'edit'])->middleware('auth')
->name('mesas_reg.edit')->where('id','[0-9]+');

Route::put('/mesas/registro/{id}/edicion', [MesaController::class, 'update'])->middleware('auth')
->name('mesas_reg.update')->where('id','[0-9]+');

Route::delete('/mesas/registro/{id}/borrar', [MesaController::class, 'destroy'])->middleware('auth')
->name('mesas_reg.destroy')->where('id','[0-9]+');

Route::get('/mesas/registro/buscar', [MesaController::class, 'search'])->middleware('auth')
->name('mesas_reg.search');

/**
 * Reservaciones de kioskos
*/

Route::get('/kiosko/reservaciones', [ReservacionController::class, 'index2'])->middleware('auth')
->name('kiosko_res.index');

Route::get('/kiosko/reservaciones/nuevo',[ReservacionController::class, 'create'])->middleware('auth')
->name('kiosko_res.create');

Route::post('/kiosko/reservaciones/nuevo',[ReservacionController::class, 'store'])->middleware('auth')
->name('kiosko_res.store');

Route::get('/kiosko/reservaciones/{id}/edicion', [ReservacionController::class, 'edit'])->middleware('auth')
->name('kiosko_res.edit')->where('id','[0-9]+');

Route::put('/kiosko/reservaciones/{id}/edicion', [ReservacionController::class, 'update'])->middleware('auth')
->name('kiosko_res.update')->where('id','[0-9]+');

Route::delete('/kiosko/reservaciones/{id}/borrar', [ReservacionController::class, 'destroy'])->middleware('auth')
->name('kiosko_res.destroy')->where('id','[0-9]+');

Route::get('/kiosko/reservaciones/buscar', [ReservacionController::class, 'search2'])->middleware('auth')
->name('kiosko_res.search');

Route::get('/kiosko/reservaciones/{id}/detail', [ReservacionController::class, 'detail'])->middleware('auth')
->name('kiosko.detail');

/* Rutas para reservar local*/
Route::get('Reser/Local', [ReservacionTotalController::class, 'reservaLocal'])->middleware('auth')
->name('cliente.reservaLocal');
      
 Route::get('Evento/Realizado', [ReservacionTotalController::class, 'reali'])->middleware('auth')
->name('evento.realizado');      

Route::get('/Local/create', [ReservacionTotalController::class, 'create'])->middleware('auth')
   -> name('ReserLocal.create');

Route::post('/Reservacion/Local', [ReservacionTotalController::class, 'store'])->middleware('auth')
->name('ReserLocal.store');

Route::get('/cliente/reservacion/{id}/detalles', [ReservacionTotalController::class, 'detalle_reservacion'])->middleware('auth')
->name('detalle.reservacion');
 
Route::get('Cliente/{id}/Editando', [ReservacionTotalController::class, 'edit'])->middleware('auth')
->name('ResCliente.editar');

Route::put('Cliente/{id}/Editando', [ReservacionTotalController::class, 'update'])->middleware('auth')
->name('resCliente.update');

Route::delete('cliente/{id}/borrar', [ReservacionTotalController::class, 'destroy'])->middleware('auth')
->name('cliente.destroy');

Route::put('/cliente/{id}/reservacionRealizada', [ReservacionTotalController::class,'reservacionesRealizadas'])->middleware('auth')
->name('reservacionRealizada')->where('id','[0-9]+');

Route::get('/Reservaciones/Realizadas', [ReservacionTotalController::class, 'Realizadas'])->middleware('auth')
->name('realizadas.realizadas'); /*lista de reservaciones realizadas */
  
Route::get('/Reservacion/{id}/Realizada/Detalles', [ReservacionTotalController::class, 'detalleRealizadas'])->middleware('auth')
->name('detalle.realizadas');

Route::get('/counter', [Counter::class, 'render'])
->name('counter.index');

Route::resource('/cart', CartController::class)->middleware('auth');
Route::post('/create', [CartController::class, 'create'])->middleware('auth')->name('cart.create');
Route::post('/clear', [CartController::class, 'clear'])->middleware('auth')->name('cart.clear');
Route::get('/bebidas', [CartController::class, 'bebidas'])->middleware('auth')->name('cart.bebidas');
Route::get('/platillos', [CartController::class, 'platillos'])->middleware('auth')->name('cart.platillos');
Route::get('/complementos', [CartController::class, 'complementos'])->middleware('auth')->name('cart.complementos');

Route::resource('/pedido/todo', DetallesPedidoController::class);
