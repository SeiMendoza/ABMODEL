<?php

namespace Tests\Feature;

use App\Models\DetallesPedido;
use App\Models\Mesa;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\User;
use Tests\TestCase;

class DetallesPedidoTest extends TestCase
{
    public function cargar_datos()
    {
        $producto = new Producto();
        $producto->nombre = 'Encurtido de Zanahoria';
        $producto->descripcion = 'Este encurtido añade un sabor único y sofisticado a tus platos, convirtiéndose en un acompañamiento versátil para carne asada y pescado frito.';
        $producto->precio = 20;
        $producto->tamanio = 'Pequeño';
        $producto->imagen = 'img/ProductosMenú/Encurtido1.jpg';
        $producto->disponible = 1000;
        $producto->estado = 1;
        $producto->tipo = 0;

        $producto->save();

        $mesa = new Mesa();
        $mesa->codigo = 'K71-M01';
        $mesa->nombre = '01';
        $mesa->cantidad = 8;
        $mesa->kiosko_id = 4;
        $mesa->estadoM = 1;
        $mesa->mesa_qr = 'imagenes/Qr_01.svg';

        $mesa->save();

        $pedido = new Pedido();
        $pedido->quiosco = 4;
        $pedido->nombreCliente = 'Luis Alvarez';
        $pedido->imp = 72.75;
        $pedido->total = 485.00;
        $pedido->estado = 1;
        $pedido->estado_cocina = 0;
        $pedido->mesa_id = $mesa->id;

        $pedido->save();


        $detallePedido = new DetallesPedido();
        $detallePedido->pedido_id = $pedido->id;
        $detallePedido->producto_id = $producto->id;
        $detallePedido->cantidad = 1;
        $detallePedido->precio = 10;
        $detallePedido->estado = 1;
        $detallePedido->estC = 0;
        $detallePedido->save();


        return [
            'id_pedido' => $pedido->id,
            'id_mesa' => $mesa->id,
            'id_producto' => $producto->id,
        ];
    }


    public function eliminar_datos($var)
    {
        DetallesPedido::where('pedido_id', '=', $var['id_pedido'])->delete();
        Pedido::find($var['id_pedido'])->delete();
        Mesa::find($var['id_mesa'])->delete();
        Producto::find($var['id_producto'])->delete();
    }

    public function test_pedido_menu_guardar_detalle_pedido_sin_logue_1()
    {

        $response = $this->post('/pedido/menu/guardar', [
            'name' => '',
            'mesa' => '',
            't' => '',
        ]);

        $response->assertRedirect("/login");
    }

    public function test_pedido_menu_guardar_detalle_pedido_correctamente_con_logue_2()
    {
        $var = $this->cargar_datos();


        $response = $this->actingAs(User::find(1))->post('/pedido/menu/guardar', [
            'name' => 'Juena Ramirez',
            'mesa' => $var['id_mesa'],
            't' => 0,
        ]);

        $response->assertSessionHas(['mensaje']);
    }


    public function test_pedido_menu_guardar_detalle_pedido_validaciones_nombre_requerido()
    {
        $var = $this->cargar_datos();


        $response = $this->actingAs(User::find(1))->post('/pedido/menu/guardar', [
            'name' => null,
            'mesa' => $var['id_mesa'],
            't' => 0,
        ]);

        $response->assertInvalid([
            'name' => 'No tiene un nombre ingresado',
        ]);
    }

    public function test_pedido_menu_guardar_detalle_pedido_validaciones_nombre_min_3()
    {
        $var = $this->cargar_datos();


        $response = $this->actingAs(User::find(1))->post('/pedido/menu/guardar', [
            'name' => 'h',
            'mesa' => $var['id_mesa'],
            't' => 0,
        ]);

        $response->assertInvalid([
            'name' => 'El nombre es corto',
        ]);
    }

    public function test_pedido_menu_guardar_detalle_pedido_validaciones_nombre_max_50()
    {
        $var = $this->cargar_datos();


        $response = $this->actingAs(User::find(1))->post('/pedido/menu/guardar', [
            'name' => 'h',
            'mesa' => $var['id_mesa'],
            't' => 0,
        ]);

        $response->assertInvalid([
            'name' => 'El nombre es largo',
        ]);
    }

    public function test_pedido_menu_guardar_detalle_pedido_validaciones_nombre_formato_incorrecto()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/pedido/menu/guardar', [
            'name' => 5,
            'mesa' => $var['id_mesa'],
            't' => 1,
        ]);

        $response->assertInvalid([
            'name' => 'El nombre tiene datos erroneos',
        ]);
    }

    public function test_pedido_menu_guardar_detalle_pedido_validaciones_mesa_requerido()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/pedido/menu/guardar', [
            'name' => 'Juena Ramirez',
            'mesa' => null,
            't' => 1,
        ]);

        $response->assertInvalid([
            'mesa' => 'Seleccione una mesa',
        ]);
    }

    public function test_pedido_menu_guardar_detalle_pedido_validaciones_mesa_solo_numeros()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/pedido/menu/guardar', [
            'name' => 'Juena Ramirez',
            'mesa' => 'id',
            't' => 1,
        ]);

        $response->assertInvalid([
            'mesa' => 'El id de la mesa es entero',
        ]);
    }

    public function test_pedido_menu_guardar_detalle_pedido_validaciones_sin_detalle()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/pedido/menu/guardar', [
            'name' => 'Juena Ramirez',
            'mesa' => $var['id_mesa'],
            't' => -2,
        ]);

        $response->assertInvalid([
            't' => 'No hay detalles',
        ]);
    }


    public function test_pedido_menu_vaciar_detalle_pedido_sin_logueo()
    {
        $response = $this->post('/pedido/menu/vaciar');
        $response->assertRedirect("/login");
    }

    public function test_pedido_menu_vaciar_detalle_pedido_con_logueo()
    {
        $response = $this->actingAs(User::find(1))->post('/pedido/menu/vaciar');

        $response->assertRedirect(['mensaje']);
    }


    //

    public function test_pedidos_menu_ingresar_status_302_sin_usuario_logueado_1()
    {
        $response = $this->get('/pedido/menu');
        $response->assertStatus(302);
    }

    public function test_pedidos_menu_ingresar_retorno_login_sin_usuario_logueado_2()
    {
        $response = $this->get('/pedido/menu');
        $response->assertRedirect('/login');
    }

    public function test_pedidos_menu_ingresar_status_200_usuario_logueado_3()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->actingAs(User::find(1))->get('/pedido/menu');
        $response->assertStatus(200);
    }

    public function test_pedidos_menu_ingresar_vista_4()
    {

        $response = $this->actingAs(User::find(1))->get('/pedido/menu');
        $response->assertViewIs('livewire.pedidos.menu');
    }

    public function test_pedidos_menu_ingresar_vista_componentes_1_label_5()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu');
        $response->assertSee('Menú del Día');
    }

    public function test_pedidos_menu_ingresar_vista_componentes_2_label_6()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu');
        $response->assertSee('Detalles del Pedido');
    }

    public function test_pedidos_menu_ingresar_vista_componentes_3_label_7()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu');
        $response->assertSee('Pedido de la Mesa:');
    }

    public function test_pedidos_menu_ingresar_vista_componentes_4_label_8()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu');
        $response->assertSee('Nombre del cliente:');
    }

    public function test_pedidos_menu_ingresar_vista_componentes_5_label_9()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu');
        $response->assertSee('Sub-Total:');
    }

    public function test_pedidos_menu_ingresar_vista_componentes_6_label_10()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu');
        $response->assertSee('ISV:');
    }

    public function test_pedidos_menu_ingresar_vista_componentes_7_label_11()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu');
        $response->assertSee('Total:');
    }


    public function test_pedidos_menu_ingresar_vista_componentes_1_place_holder_13()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu');
        $response->assertSee('Seleccione una mesa');
    }

    public function test_pedidos_menu_ingresar_vista_componentes_2_place_holder_14()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu');
        $response->assertSee('Ingrese el nombre del cliente');
    }


    public function test_pedidos_menu_ingresar_vista_componentes_4_place_holder_16()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu');
        $response->assertSee('L 0');
    }


    public function test_pedidos_menu_ingresar_vista_componentes_1_columnas_tabla_18()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu');
        $response->assertSee('Nombre');
    }

    public function test_pedidos_menu_ingresar_vista_componentes_2_columnas_tabla_19()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu');
        $response->assertSee('Cantidad');
    }

    public function test_pedidos_menu_ingresar_vista_componentes_3_columnas_tabla_20()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu');
        $response->assertSee('Precio');
    }

    public function test_pedidos_menu_ingresar_vista_componentes_4_columnas_tabla_21()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu');
        $response->assertSee('Sub-Total:');
    }
    public function test_pedidos_menu_ingresar_vista_componentes_5_columnas_tabla_22()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu');
        $response->assertSee('Eliminar');
    }

    public function test_pedidos_menu_ingresar_vista_componentes_boton_cancelar_23()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu');
        $response->assertSee('Cancelar');
    }

    public function test_pedidos_menu_ingresar_vista_componentes_boton_guardar_24()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu');
        $response->assertSee('Guardar');
    }

    public function test_pedido_menu_bebidas_ingresar_status_302_sin_usuario_logueado_1()
    {
        $response = $this->get('/pedido/menu/bebidas');
        $response->assertStatus(302);
    }

    public function test_pedido_menu_bebidas_ingresar_retorno_login_sin_usuario_logueado_2()
    {
        $response = $this->get('/pedido/menu/bebidas');
        $response->assertRedirect('/login');
    }

    public function test_pedido_menu_bebidas_ingresar_status_200_usuario_logueado_3()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->actingAs(User::find(1))->get('/pedido/menu/bebidas');
        $response->assertStatus(200);
    }

    public function test_pedido_menu_bebidas_ingresar_vista_4()
    {

        $response = $this->actingAs(User::find(1))->get('/pedido/menu/bebidas');
        $response->assertViewIs('C:\laragon\www\ABMODEL\vendor\livewire\livewire\src/Macros/livewire-view-extends.blade.php');
    }

    public function test_pedido_menu_bebidas_ingresar_vista_componentes_1_label_5()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/bebidas');
        $response->assertSee('Menú del Día');
    }

    public function test_pedido_menu_bebidas_ingresar_vista_componentes_2_label_6()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/bebidas');
        $response->assertSee('Detalles del Pedido');
    }

    public function test_pedido_menu_bebidas_ingresar_vista_componentes_3_label_7()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/bebidas');
        $response->assertSee('Pedido de la Mesa:');
    }

    public function test_pedido_menu_bebidas_ingresar_vista_componentes_4_label_8()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/bebidas');
        $response->assertSee('Nombre del cliente:');
    }

    public function test_pedido_menu_bebidas_ingresar_vista_componentes_5_label_9()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/bebidas');
        $response->assertSee('Sub-Total:');
    }

    public function test_pedido_menu_bebidas_ingresar_vista_componentes_6_label_10()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/bebidas');
        $response->assertSee('ISV:');
    }

    public function test_pedido_menu_bebidas_ingresar_vista_componentes_7_label_11()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/bebidas');
        $response->assertSee('Total:');
    }


    public function test_pedido_menu_bebidas_ingresar_vista_componentes_1_place_holder_13()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/bebidas');
        $response->assertSee('Seleccione una mesa');
    }

    public function test_pedido_menu_bebidas_ingresar_vista_componentes_2_place_holder_14()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/bebidas');
        $response->assertSee('Ingrese el nombre del cliente');
    }


    public function test_pedido_menu_bebidas_ingresar_vista_componentes_4_place_holder_16()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/bebidas');
        $response->assertSee('L 0');
    }


    public function test_pedido_menu_bebidas_ingresar_vista_componentes_1_columnas_tabla_18()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/bebidas');
        $response->assertSee('Nombre');
    }

    public function test_pedido_menu_bebidas_ingresar_vista_componentes_2_columnas_tabla_19()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/bebidas');
        $response->assertSee('Cantidad');
    }

    public function test_pedido_menu_bebidas_ingresar_vista_componentes_3_columnas_tabla_20()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/bebidas');
        $response->assertSee('Precio');
    }

    public function test_pedido_menu_bebidas_ingresar_vista_componentes_4_columnas_tabla_21()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/bebidas');
        $response->assertSee('Sub-Total:');
    }
    public function test_pedido_menu_bebidas_ingresar_vista_componentes_5_columnas_tabla_22()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/bebidas');
        $response->assertSee('Eliminar');
    }

    public function test_pedido_menu_bebidas_ingresar_vista_componentes_boton_cancelar_23()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/bebidas');
        $response->assertSee('Cancelar');
    }

    public function test_pedido_menu_bebidas_ingresar_vista_componentes_boton_guardar_24()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/bebidas');
        $response->assertSee('Guardar');
    }


    public function test_pedido_menu_platillos_ingresar_status_302_sin_usuario_logueado_1()
    {
        $response = $this->get('pedido/menu/platillos');
        $response->assertStatus(302);
    }

    public function test_pedido_menu_platillos_ingresar_retorno_login_sin_usuario_logueado_2()
    {
        $response = $this->get('pedido/menu/platillos');
        $response->assertRedirect('/login');
    }

    public function test_pedido_menu_platillos_ingresar_status_200_usuario_logueado_3()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->actingAs(User::find(1))->get('pedido/menu/platillos');
        $response->assertStatus(200);
    }

    public function test_pedido_menu_platillos_ingresar_vista_4()
    {

        $response = $this->actingAs(User::find(1))->get('pedido/menu/platillos');
        $response->assertViewIs('C:\laragon\www\ABMODEL\vendor\livewire\livewire\src/Macros/livewire-view-extends.blade.php');
    }

    public function test_pedido_menu_platillos_ingresar_vista_componentes_1_label_5()
    {
        $response = $this->actingAs(User::find(1))->get('pedido/menu/platillos');
        $response->assertSee('Menú del Día');
    }

    public function test_pedido_menu_platillos_ingresar_vista_componentes_2_label_6()
    {
        $response = $this->actingAs(User::find(1))->get('pedido/menu/platillos');
        $response->assertSee('Detalles del Pedido');
    }

    public function test_pedido_menu_platillos_ingresar_vista_componentes_3_label_7()
    {
        $response = $this->actingAs(User::find(1))->get('pedido/menu/platillos');
        $response->assertSee('Pedido de la Mesa:');
    }

    public function test_pedido_menu_platillos_ingresar_vista_componentes_4_label_8()
    {
        $response = $this->actingAs(User::find(1))->get('pedido/menu/platillos');
        $response->assertSee('Nombre del cliente:');
    }

    public function test_pedido_menu_platillos_ingresar_vista_componentes_5_label_9()
    {
        $response = $this->actingAs(User::find(1))->get('pedido/menu/platillos');
        $response->assertSee('Sub-Total:');
    }

    public function test_pedido_menu_platillos_ingresar_vista_componentes_6_label_10()
    {
        $response = $this->actingAs(User::find(1))->get('pedido/menu/platillos');
        $response->assertSee('ISV:');
    }

    public function test_pedido_menu_platillos_ingresar_vista_componentes_7_label_11()
    {
        $response = $this->actingAs(User::find(1))->get('pedido/menu/platillos');
        $response->assertSee('Total:');
    }


    public function test_pedido_menu_platillos_ingresar_vista_componentes_1_place_holder_13()
    {
        $response = $this->actingAs(User::find(1))->get('pedido/menu/platillos');
        $response->assertSee('Seleccione una mesa');
    }

    public function test_pedido_menu_platillos_ingresar_vista_componentes_2_place_holder_14()
    {
        $response = $this->actingAs(User::find(1))->get('pedido/menu/platillos');
        $response->assertSee('Ingrese el nombre del cliente');
    }


    public function test_pedido_menu_platillos_ingresar_vista_componentes_4_place_holder_16()
    {
        $response = $this->actingAs(User::find(1))->get('pedido/menu/platillos');
        $response->assertSee('L 0');
    }


    public function test_pedido_menu_platillos_ingresar_vista_componentes_1_columnas_tabla_18()
    {
        $response = $this->actingAs(User::find(1))->get('pedido/menu/platillos');
        $response->assertSee('Nombre');
    }

    public function test_pedido_menu_platillos_ingresar_vista_componentes_2_columnas_tabla_19()
    {
        $response = $this->actingAs(User::find(1))->get('pedido/menu/platillos');
        $response->assertSee('Cantidad');
    }

    public function test_pedido_menu_platillos_ingresar_vista_componentes_3_columnas_tabla_20()
    {
        $response = $this->actingAs(User::find(1))->get('pedido/menu/platillos');
        $response->assertSee('Precio');
    }

    public function test_pedido_menu_platillos_ingresar_vista_componentes_4_columnas_tabla_21()
    {
        $response = $this->actingAs(User::find(1))->get('pedido/menu/platillos');
        $response->assertSee('Sub-Total:');
    }
    public function test_pedido_menu_platillos_ingresar_vista_componentes_5_columnas_tabla_22()
    {
        $response = $this->actingAs(User::find(1))->get('pedido/menu/platillos');
        $response->assertSee('Eliminar');
    }

    public function test_pedido_menu_platillos_ingresar_vista_componentes_boton_cancelar_23()
    {
        $response = $this->actingAs(User::find(1))->get('pedido/menu/platillos');
        $response->assertSee('Cancelar');
    }

    public function test_pedido_menu_platillos_ingresar_vista_componentes_boton_guardar_24()
    {
        $response = $this->actingAs(User::find(1))->get('pedido/menu/platillos');
        $response->assertSee('Guardar');
    }


    public function test_pedido_menu_complementos_ingresar_status_302_sin_usuario_logueado_1()
    {
        $response = $this->get('/pedido/menu/complementos');
        $response->assertStatus(302);
    }

    public function test_pedido_menu_complementos_ingresar_retorno_login_sin_usuario_logueado_2()
    {
        $response = $this->get('/pedido/menu/complementos');
        $response->assertRedirect('/login');
    }

    public function test_pedido_menu_complementos_ingresar_status_200_usuario_logueado_3()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->actingAs(User::find(1))->get('/pedido/menu/complementos');
        $response->assertStatus(200);
    }

    public function test_pedido_menu_complementos_ingresar_vista_4()
    {

        $response = $this->actingAs(User::find(1))->get('/pedido/menu/complementos');
        $response->assertViewIs('C:\laragon\www\ABMODEL\vendor\livewire\livewire\src/Macros/livewire-view-extends.blade.php');
    }

    public function test_pedido_menu_complementos_ingresar_vista_componentes_1_label_5()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/complementos');
        $response->assertSee('Menú del Día');
    }

    public function test_pedido_menu_complementos_ingresar_vista_componentes_2_label_6()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/complementos');
        $response->assertSee('Detalles del Pedido');
    }

    public function test_pedido_menu_complementos_ingresar_vista_componentes_3_label_7()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/complementos');
        $response->assertSee('Pedido de la Mesa:');
    }

    public function test_pedido_menu_complementos_ingresar_vista_componentes_4_label_8()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/complementos');
        $response->assertSee('Nombre del cliente:');
    }

    public function test_pedido_menu_complementos_ingresar_vista_componentes_5_label_9()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/complementos');
        $response->assertSee('Sub-Total:');
    }

    public function test_pedido_menu_complementos_ingresar_vista_componentes_6_label_10()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/complementos');
        $response->assertSee('ISV:');
    }

    public function test_pedido_menu_complementos_ingresar_vista_componentes_7_label_11()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/complementos');
        $response->assertSee('Total:');
    }


    public function test_pedido_menu_complementos_ingresar_vista_componentes_1_place_holder_13()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/complementos');
        $response->assertSee('Seleccione una mesa');
    }

    public function test_pedido_menu_complementos_ingresar_vista_componentes_2_place_holder_14()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/complementos');
        $response->assertSee('Ingrese el nombre del cliente');
    }


    public function test_pedido_menu_complementos_ingresar_vista_componentes_4_place_holder_16()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/complementos');
        $response->assertSee('L 0');
    }


    public function test_pedido_menu_complementos_ingresar_vista_componentes_1_columnas_tabla_18()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/complementos');
        $response->assertSee('Nombre');
    }

    public function test_pedido_menu_complementos_ingresar_vista_componentes_2_columnas_tabla_19()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/complementos');
        $response->assertSee('Cantidad');
    }

    public function test_pedido_menu_complementos_ingresar_vista_componentes_3_columnas_tabla_20()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/complementos');
        $response->assertSee('Precio');
    }

    public function test_pedido_menu_complementos_ingresar_vista_componentes_4_columnas_tabla_21()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/complementos');
        $response->assertSee('Sub-Total:');
    }
    public function test_pedido_menu_complementos_ingresar_vista_componentes_5_columnas_tabla_22()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/complementos');
        $response->assertSee('Eliminar');
    }

    public function test_pedido_menu_complementos_ingresar_vista_componentes_boton_cancelar_23()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/complementos');
        $response->assertSee('Cancelar');
    }

    public function test_pedido_menu_complementos_ingresar_vista_componentes_boton_guardar_24()
    {
        $response = $this->actingAs(User::find(1))->get('/pedido/menu/complementos');
        $response->assertSee('Guardar');
    }
}
