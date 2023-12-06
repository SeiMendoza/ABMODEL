<?php

namespace Tests\Feature;

use App\Models\DetallesPedido;
use App\Models\Mesa;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MenuUsuarioTest extends TestCase
{
    use WithFaker;

    public function cargar_datos(){
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

        return [
            'id_pedido' => $pedido->id,
            'id_mesa' => $mesa->id,
            'id_producto' => $producto->id,
        ];
    }

    public function eliminar_datos($var){
        DetallesPedido::where('pedido_id','=',$var['id_pedido'])->delete();
        Pedido::find($var['id_pedido'])->delete();
        Mesa::find($var['id_mesa'])->delete();
        Producto::find($var['id_producto'])->delete();
    }

    public function test_menu_clientes_details_registro_producto_correctamente_1()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/menu/pedido/detalles', [
            'pedido' => $var['id_pedido'],
            'producto' => $var['id_producto'],
            'cantidad' => $this->faker->numberBetween(1, 10),
            'precio' => $this->faker->randomFloat(2, 0.01, 100),
        ]);

        $this->eliminar_datos($var);

        $response->assertSessionHas(['mensaje']);
    }


    public function test_menu_clientes_details_registro_producto_validacion_id_pedido_requerido_2()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/menu/pedido/detalles', [
            'pedido' => null,
            'producto' => $var['id_producto'],
            'cantidad' => $this->faker->numberBetween(1, 10),
            'precio' => $this->faker->randomFloat(2, 0.01, 100),
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'pedido' => 'El campo pedido es obligatorio.',
        ]);
    }

    public function test_menu_clientes_details_registro_producto_validacion_id_pedido_solo_numeros_3()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/menu/pedido/detalles', [
            'pedido' => 'null',
            'producto' => $var['id_producto'],
            'cantidad' => $this->faker->numberBetween(1, 10),
            'precio' => $this->faker->randomFloat(2, 0.01, 100),
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'pedido' => 'El id de pedido debe ser un número.',
        ]);
    }

    public function test_menu_clientes_details_registro_producto_validacion_id_producto_requerido_4()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/menu/pedido/detalles', [
            'pedido' => $var['id_pedido'],
            'producto' => null,
            'cantidad' => $this->faker->numberBetween(1, 10),
            'precio' => $this->faker->randomFloat(2, 0.01, 100),
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'producto' => 'El campo producto es obligatorio.',
        ]);
    }

    public function test_menu_clientes_details_registro_producto_validacion_cantidad_requerido_5()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/menu/pedido/detalles', [
            'pedido' => $var['id_pedido'],
            'producto' => $var['id_producto'],
            'cantidad' => null,
            'precio' => $this->faker->randomFloat(2, 0.01, 100),
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'cantidad' => 'El campo cantidad es obligatorio.',
        ]);
    }

    public function test_menu_clientes_details_registro_producto_validacion_cantidad_solo_numeros_6()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/menu/pedido/detalles', [
            'pedido' => $var['id_pedido'],
            'producto' => $var['id_producto'],
            'cantidad' => 'NULL',
            'precio' => $this->faker->randomFloat(2, 0.01, 100),
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'cantidad' => 'La cantidad debe ser un número.',
        ]);
    }

    public function test_menu_clientes_details_registro_producto_validacion_cantidad_solo_positivos_7()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/menu/pedido/detalles', [
            'pedido' => $var['id_pedido'],
            'producto' => $var['id_producto'],
            'cantidad' => -2,
            'precio' => $this->faker->randomFloat(2, 0.01, 100),
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'cantidad' => 'La cantidad debe ser al menos 1',
        ]);
    }


    public function test_menu_clientes_details_registro_producto_validacion_precio_requerido_8()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/menu/pedido/detalles', [
            'pedido' => $var['id_pedido'],
            'producto' => $var['id_producto'],
            'cantidad' => $this->faker->numberBetween(1, 10),
            'precio' => '',
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'precio' => 'El campo precio es obligatorio.',
        ]);
    }

    public function test_menu_clientes_details_registro_producto_validacion_precio_solo_numeros_9()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/menu/pedido/detalles', [
            'pedido' => $var['id_pedido'],
            'producto' => $var['id_producto'],
            'cantidad' => $this->faker->numberBetween(1, 10),
            'precio' => 'null',
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'precio' => 'El precio debe ser un número.',
        ]);
    }

    public function test_menu_clientes_details_registro_producto_validacion_precio_solo_positivos_10()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/menu/pedido/detalles', [
            'pedido' => $var['id_pedido'],
            'producto' => $var['id_producto'],
            'cantidad' => $this->faker->numberBetween(1, 10),
            'precio' => -1,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'precio' => 'El precio debe ser al menos 0.01',
        ]);
    }

    //qr

    public function test_qr_ingresar_status_302_sin_usuario_logueado_11()
    {
        $response = $this->get('/menu/qr');
        $response->assertStatus(302);
    }

    public function test_qr_ingresar_retorno_login_sin_usuario_logueado_12()
    {
        $response = $this->get('/menu/qr');
        $response->assertRedirect('/login');
    }

    public function test_qr_ingresar_status_200_usuario_logueado_13()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->actingAs(User::find(1))->get('/menu/qr');
        $response->assertStatus(200);
    }

    public function test_qr_ingresar_vista_14()
    {

        $response = $this->actingAs(User::find(1))->get('/menu/qr');
        $response->assertViewIs('Menu.Admon.QR_Menu');
    }

    public function test_menu_prueba_ingresar_status_302_sin_usuario_logueado_15()
    {
        $response = $this->get('/menu/prueba/c');
        $response->assertStatus(302);
    }

    public function test_menu_prueba_ingresar_retorno_login_sin_usuario_logueado_16()
    {
        $response = $this->get('/menu/prueba/c');
        $response->assertRedirect('/login');
    }

    public function test_menu_prueba_ingresar_status_200_usuario_logueado_17()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->actingAs(User::find(1))->get('/menu/prueba/c');
        $response->assertStatus(200);
    }

    public function test_menu_prueba_ingresar_vista_18()
    {

        $response = $this->actingAs(User::find(1))->get('/menu/prueba/c');
        $response->assertViewIs('Menu.Admon.QR_Menu');
    }


    public function test_menu_prueba_ingresar_status_302_sin_usuario_logueado_19()
    {
        $response = $this->get('/menu/usuario/pedido');
        $response->assertStatus(302);
    }

    public function test_menu_prueba_ingresar_retorno_login_sin_usuario_logueado_20()
    {
        $response = $this->get('/menu/usuario/pedido');
        $response->assertRedirect('/login');
    }

    public function test_menu_prueba_ingresar_status_200_usuario_logueado_21()
    {
        $response = $this->actingAs(User::find(1))->get('/menu/usuario/pedido');
        $response->assertStatus(200);
    }

    public function test_menu_prueba_ingresar_vista_22()
    {
        $response = $this->actingAs(User::find(1))->get('/menu/usuario/pedido');
        $response->assertViewIs('Menu.Admon.QR_Menu');
    }


    public function test_pedido_clientes_stores_registro_correctamente_23()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/menu/usuario/pedido', [
            'pedido' => $var['id_pedido'],
            'nombre' => 'Manuel Alvareza',
            'mesa' => $var['id_mesa'],
            't' => 600,
            'isv' => 45,
        ]);

        $this->eliminar_datos($var);

        $response->assertSessionHas(['mensaje']);
    }


    public function test_pedido_clientes_stores_registro_validacion_id_pedido_requerido_24()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/menu/usuario/pedido', [
            'pedido' => null,
            'nombre' => 'Manuel Alvareza',
            'mesa' => $var['id_mesa'],
            't' => 600,
            'isv' => 45,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'pedido' => 'Seleccione un pedido.',
        ]);
    }

    public function test_pedido_clientes_stores_registro_validacion_id_pedido_solo_numero_25()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/menu/usuario/pedido', [
            'pedido' => 'null',
            'nombre' => 'Manuel Alvareza',
            'mesa' => $var['id_mesa'],
            't' => 600,
            'isv' => 45,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'pedido' => 'El pedido debe ser un número entero.',
        ]);
    }

    public function test_pedido_clientes_stores_registro_validacion_id_pedido_no_existente_26()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/menu/usuario/pedido', [
            'pedido' => 9090909090,
            'nombre' => 'Manuel Alvareza',
            'mesa' => $var['id_mesa'],
            't' => 600,
            'isv' => 45,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'pedido' => 'El pedido seleccionado no existe.',
        ]);
    }


    public function test_pedido_clientes_stores_registro_validacion_nombre_requerido_27()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/menu/usuario/pedido', [
            'pedido' => $var['id_pedido'],
            'nombre' => null,
            'mesa' => $var['id_mesa'],
            't' => 600,
            'isv' => 45,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'nombre' => 'No tiene un nombre ingresado.',
        ]);
    }

    public function test_pedido_clientes_stores_registro_validacion_nombre_solo_texto_28()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/menu/usuario/pedido', [
            'pedido' => $var['id_pedido'],
            'nombre' => 9090909,
            'mesa' => $var['id_mesa'],
            't' => 600,
            'isv' => 45,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'nombre' => 'El nombre debe ser texto.',
        ]);
    }

    public function test_pedido_clientes_stores_registro_validacion_mesa_requerido_29()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/menu/usuario/pedido', [
            'pedido' => $var['id_pedido'],
            'nombre' => 'Manuel Alvareza',
            'mesa' => null,
            't' => 600,
            'isv' => 45,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'mesa' => 'Seleccione una mesa.',
        ]);
    }

    public function test_pedido_clientes_stores_registro_validacion_mesa_solo_numeros_30()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/menu/usuario/pedido', [
            'pedido' => $var['id_pedido'],
            'nombre' => 'Manuel Alvareza',
            'mesa' => 'sdsd',
            't' => 600,
            'isv' => 45,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'mesa' => 'La mesa debe ser un número entero.',
        ]);
    }

    public function test_pedido_clientes_stores_registro_validacion_mesa_no_existente_31()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/menu/usuario/pedido', [
            'pedido' => $var['id_pedido'],
            'nombre' => 'Manuel Alvareza',
            'mesa' => 89898989,
            't' => 600,
            'isv' => 45,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'mesa' => 'La mesa seleccionada no existe.',
        ]);
    }

    public function test_pedido_clientes_stores_registro_validacion_total_requerido_32()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/menu/usuario/pedido', [
            'pedido' => $var['id_pedido'],
            'nombre' => 'Manuel Alvareza',
            'mesa' => $var['id_mesa'],
            't' => null,
            'isv' => 45,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            't' => 'El campo total es obligatorio.',
        ]);
    }

    public function test_pedido_clientes_stores_registro_validacion_total_solo_numeros_33()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/menu/usuario/pedido', [
            'pedido' => $var['id_pedido'],
            'nombre' => 'Manuel Alvareza',
            'mesa' => $var['id_mesa'],
            't' => 'hhh',
            'isv' => 45,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            't' => 'El campo total debe ser un número.',
        ]);
    }

    public function test_pedido_clientes_stores_registro_validacion_total_solo_positivos_34()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/menu/usuario/pedido', [
            'pedido' => $var['id_pedido'],
            'nombre' => 'Manuel Alvareza',
            'mesa' => $var['id_mesa'],
            't' => '-1',
            'isv' => 45,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            't' => 'El pedido está vacío.',
        ]);
    }

    public function test_pedido_clientes_stores_registro_validacion_isv_requerido_35()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/menu/usuario/pedido', [
            'pedido' => $var['id_pedido'],
            'nombre' => 'Manuel Alvareza',
            'mesa' => $var['id_mesa'],
            't' => 600,
            'isv' => null,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'isv' => 'El campo ISV es obligatorio.',
        ]);
    }

    public function test_pedido_clientes_stores_registro_validacion_isv_solo_numeros_36()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/menu/usuario/pedido', [
            'pedido' => $var['id_pedido'],
            'nombre' => 'Manuel Alvareza',
            'mesa' => $var['id_mesa'],
            't' => 600,
            'isv' => 'null',
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'isv' => 'El campo ISV debe ser un número.',
        ]);
    }

    public function test_pedido_clientes_stores_registro_validacion_isv_solo_positivos_37()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/menu/usuario/pedido', [
            'pedido' => $var['id_pedido'],
            'nombre' => 'Manuel Alvareza',
            'mesa' => $var['id_mesa'],
            't' => 600,
            'isv' => -2,
        ]);


        $response->assertInvalid([
            'isv' => 'El campo ISV debe ser mayor o igual a cero.',
        ]);
    }

    public function test_pedido_clientes_update_registro_correctamente_38()
    {
        $var = $this->cargar_datos();

        $detallePedido = new DetallesPedido();
        $detallePedido->pedido_id = $var['id_pedido'];
        $detallePedido->producto_id = $var['id_producto'];
        $detallePedido->cantidad = 1;
        $detallePedido->precio = 10;
        $detallePedido->estado = 1;
        $detallePedido->estC = 0;
        $detallePedido->save();

        $response = $this->actingAs(User::find(1))->put('/menu/detalles/'.$detallePedido->id.'/editar', [
            'numb' => 30,
        ]);

        $detallePedido->delete();

        $this->eliminar_datos($var);

        $response->assertSessionHas(['mensaje']);
    }



    public function test_pedido_clientes_update_registro_validacion_numb_requerido_39()
    {
        $var = $this->cargar_datos();

        $detallePedido = new DetallesPedido();
        $detallePedido->pedido_id = $var['id_pedido'];
        $detallePedido->producto_id = $var['id_producto'];
        $detallePedido->cantidad = 1;
        $detallePedido->precio = 10;
        $detallePedido->estado = 1;
        $detallePedido->estC = 0;
        $detallePedido->save();

        $response = $this->actingAs(User::find(1))->put('/menu/detalles/'.$detallePedido->id.'/editar', [
            'numb' => null,
        ]);

        $detallePedido->delete();

        $this->eliminar_datos($var);


        $response->assertInvalid([
            'numb' => 'La cantidad no puede estar vacia',
        ]);
    }



    public function test_pedido_clientes_update_registro_validacion_numb_solo_numeros_40()
    {
        $var = $this->cargar_datos();

        $detallePedido = new DetallesPedido();
        $detallePedido->pedido_id = $var['id_pedido'];
        $detallePedido->producto_id = $var['id_producto'];
        $detallePedido->cantidad = 1;
        $detallePedido->precio = 10;
        $detallePedido->estado = 1;
        $detallePedido->estC = 0;
        $detallePedido->save();

        $response = $this->actingAs(User::find(1))->put('/menu/detalles/'.$detallePedido->id.'/editar', [
            'numb' => 'hiloa',
        ]);

        $detallePedido->delete();

        $this->eliminar_datos($var);


        $response->assertInvalid([
            'numb' => 'La cantidad debe ser numérica',
        ]);
    }

    public function test_pedido_clientes_update_registro_validacion_numb_solo_positivos_41()
    {
        $var = $this->cargar_datos();

        $detallePedido = new DetallesPedido();
        $detallePedido->pedido_id = $var['id_pedido'];
        $detallePedido->producto_id = $var['id_producto'];
        $detallePedido->cantidad = 1;
        $detallePedido->precio = 10;
        $detallePedido->estado = 1;
        $detallePedido->estC = 0;
        $detallePedido->save();

        $response = $this->actingAs(User::find(1))->put('/menu/detalles/'.$detallePedido->id.'/editar', [
            'numb' => -22,
        ]);

        $detallePedido->delete();

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'numb' => 'La cantidad no puede ser menor a 1',
        ]);
    }


    public function test_pedido_clientes_destroy_eliminado_correctamente_42()
    {
        $var = $this->cargar_datos();

        $detallePedido = new DetallesPedido();
        $detallePedido->pedido_id = $var['id_pedido'];
        $detallePedido->producto_id = $var['id_producto'];
        $detallePedido->cantidad = 1;
        $detallePedido->precio = 10;
        $detallePedido->estado = 1;
        $detallePedido->estC = 0;
        $detallePedido->save();

        $response = $this->actingAs(User::find(1))->delete('/menu/detalles/'.$detallePedido->id.'/borrar');

        $this->eliminar_datos($var);

        $response->assertSessionHas(['mensaje']);
    }
}
