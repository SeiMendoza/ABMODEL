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

class PedidoUsuarioTest extends TestCase
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

        $mesa2 = new Mesa();
        $mesa2->codigo = 'K71-M01';
        $mesa2->nombre = '01';
        $mesa2->cantidad = 8;
        $mesa2->kiosko_id = 4;
        $mesa2->estadoM = 1;
        $mesa2->mesa_qr = 'imagenes/Qr_01.svg';

        $mesa2->save();

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
        $detallePedido->estado = 0;
        $detallePedido->estC = 0;
        $detallePedido->save();


        return [
            'id_pedido' => $pedido->id,
            'id_mesa' => $mesa->id,
            'id_mesa2' => $mesa2->id,
            'id_producto' => $producto->id,
            'id_detallePedido' => $detallePedido->id,
        ];
    }


    public function eliminar_datos($var)
    {
        DetallesPedido::where('pedido_id', '=', $var['id_pedido'])->delete();
        Pedido::find($var['id_pedido'])->delete();
        Mesa::find($var['id_mesa'])->delete();
        Producto::find($var['id_producto'])->delete();
    }

    public function test_pedido_caja_guardar_detalle_pedido_sin_logue_1()
    {
        $var = $this->cargar_datos();

        $response = $this->post('/pedido/caja/' . $var['id_pedido'] . '/guardar', [
            'nombreC' => 'Manuel Alvarez',
            'mesa' => $var['id_mesa'],
        ]);

        $this->eliminar_datos($var);

        $response->assertRedirect("/login");
    }

    public function test_pedido_caja_guardar_detalle_pedido_correctamente_con_logue_2()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/pedido/caja/' . $var['id_pedido'] . '/guardar', [
            'nombreC' => 'Manuel Alvarez',
            'mesa' => $var['id_mesa'],
        ]);

        $this->eliminar_datos($var);

        $response->assertSessionHas(['mensaje']);
    }

    public function test_pedido_caja_guardar_detalle_pedido_validacion_nombre_c_requerido()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/pedido/caja/' . $var['id_pedido'] . '/guardar', [
            'nombreC' => null,
            'mesa' => $var['id_mesa'],
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'nombreC' => 'El nombre no puede estar vacío'
        ]);
    }

    public function test_pedido_caja_guardar_detalle_pedido_validacion_nombre_c_solo_text()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/pedido/caja/' . $var['id_pedido'] . '/guardar', [
            'nombreC' => '!@#$%^&*()',
            'mesa' => $var['id_mesa'],
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'nombreC' => 'Solo se aceptan letras'
        ]);
    }


    public function test_pedido_caja_guardar_detalle_pedido_validacion_mesa_requerido()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/pedido/caja/' . $var['id_pedido'] . '/guardar', [
            'nombreC' => 'Josue',
            'mesa' => null,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'mesa' => 'Debe seleccionar una mesa'
        ]);
    }

    public function test_pedido_caja_guardar_detalle_pedido_validacion_mesa_existente()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/pedido/caja/' . $var['id_pedido'] . '/guardar', [
            'nombreC' => 'Josue',
            'mesa' => 909090909,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'mesa' => 'La mesa seleccionada no existe'
        ]);
    }

    public function test_cancelar_pedido_detalle_pedido_sin_logue_1()
    {
        $var = $this->cargar_datos();

        $response = $this->post('/cancelar-pedido/'.$var['id_pedido']);

        $this->eliminar_datos($var);

        $response->assertRedirect("/login");
    }

    public function test_cancelar_pedido_detalle_pedido_correctamente_2()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/cancelar-pedido/'.$var['id_pedido']);

        $validar = DetallesPedido::where('pedido_id','=',$var['id_pedido'])->get();

        $this->eliminar_datos($var);

        $this->assertTrue(count( $validar) == 0);
    }


    public function test_cancelar_pedido_detalle_pedido_id_desconocido_3()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/cancelar-pedido/786678');

        $validar = DetallesPedido::where('pedido_id','=',$var['id_pedido'])->get();

        $this->eliminar_datos($var);

        $response->assertRedirect(404);
    }

    public function test_cancelar_pedido_detalle_pedido_id_solo_numero_4()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/cancelar-pedido/sdfsdfsdf');

        $validar = DetallesPedido::where('pedido_id','=',$var['id_pedido'])->get();

        $this->eliminar_datos($var);

        $response->assertRedirect(404);
    }


    public function test_pedidos_cambiarmesa_pedido_sin_logue_5()
    {
        $var = $this->cargar_datos();

        $response = $this->post('/pedidos/'.$var['id_pedido'].'/cambiarmesa');

        $this->eliminar_datos($var);

        $response->assertRedirect("/login");
    }

    public function test_pedidos_cambiarmesa_pedido_correctamente_6()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/pedidos/'.$var['id_pedido'].'/cambiarmesa', [
            'nueva_mesa' => $var['id_mesa2'],
        ]);

        $validar = DetallesPedido::find($var['id_detallePedido'])->get();

        $this->eliminar_datos($var);

        $this->assertTrue(count($validar) > 0);
    }


    public function test_pedidos_cambiarmesa_pedido_validacion_mesa_inexistente_7()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/pedidos/'.$var['id_pedido'].'/cambiarmesa', [
            'nueva_mesa' => 76767676767676,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'nueva_mesa' => 'El nombre no existe',
        ]);
    }

    public function test_pedidos_cambiarmesa_pedido_validacion_mesa_requerido_8()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->post('/pedidos/'.$var['id_pedido'].'/cambiarmesa', [
            'nueva_mesa' => null,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'nueva_mesa' => 'Seleccione una mesa',
        ]);
    }
}
