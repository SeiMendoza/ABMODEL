<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\DetallesPedido; 
use App\Models\Producto;
use App\Models\User;

class PedidoTest extends TestCase
{
     use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_1_updatedetalle()
    {
        $response = $this->put('/pedidos/{pedido_id}/detalles/{detalle_id}/editar');
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function test_2_editardetalle()
    {
        $response = $this->put('/pedidos/{pedido_id}/detalles/{detalle_id}/editar', ['id'=>1]);

        $response->assertRedirect('/login');
    }
    

    public function test_3_pedidococina()
    {
        $response = $this->get('/pedidos/cocina/detalle/{id}');
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function test_4_pedidoterminado()
    {
        $response = $this->get('/pedidos/terminados/detalle/{id}');
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function test_5_obtenerprecio_productos()
    {
        $response = $this->post('precio-acompl');
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }
    
    public function test_acceso_a_pedido()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/pedidos/cocina/detalle/1');
        $response->assertStatus(200);
        $response->assertSee('Detalles del Pedido'); 
    }

    public function test_7_pedido_usuariologueado()
    {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->get('/pedidos/cocina/detalle/{id}');
        
        $response->assertStatus(200);
    }

    public function test_8_ingresoplantilla_pedido()
    {

        $response = $this->actingAs(User::find(1))->get('/pedidos/cocina/detalle/{id}');
        $response->assertViewIs('pedidost.detalle');
    }

    public function test_9_nuevapedidologueado()
    {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->get('Agregar');
        
        $response->assertStatus(200);
    }
    public function test_10_nuevopedido()
    {
        $response = $this->actingAs(User::find(1))->get('/pedidos/cocina/detalle/{id}');
        $response->assertSee('producto_id');
    }
    public function test_11_nuevapedido()
    {
        $response = $this->actingAs(User::find(1))->get('/pedidos/cocina/detalle/{id}');
        $response->assertSee('cantidad');
    }
    

    public function test_12_editar_pedido_sin_usuario_logueado_1()
    {
        $response = $this->get('/pedidos/cocina/detalle/{id}');
        $response->assertStatus(302);
    }

    public function test_13_editar_pedido_sin_usuario_logueado_2()
    {
        $response = $this->get('/pedidos/cocina/detalle/{id}');
        $response->assertRedirect('/login');
    }
    public function test_14_Actualizacion_Exitosa()
    {
        // Crear un detalle de pedido de ejemplo en la base de datos
        $detalle = DetallesPedido::factory()->create([
            'cantidad' => 5,

        ]);
        $this->actingAs(User::factory()->create());

        // Realizar una solicitud de actualización con datos válidos
        $response = $this->put(route('detallep.update', [
            'pedido_id' => $detalle->pedido_id,
            'detalle_id' => $detalle->id,
        ]), [
            'cantidad' => 20, // Nueva cantidad válida
            'precio' => $detalle->precio,
        ]);

        
        $response->assertRedirect(route('pedidost.detalle', ['id' => $detalle->pedido_id]));

        $detalle->refresh();
        $this->assertEquals(8, $detalle->cantidad); 
    }

    public function test_15_ValidacionCantidades()
    {
        
        $detalle = DetallesPedido::factory()->create();([
        ]);

       
        $response = $this->put(route('detallep.update', [
            'pedido_id' => $detalle->pedido_id,
            'detalle_id' => $detalle->id,
        ]), [
            'cantidad' => $detalle->cantidad - 1, // Intentar una cantidad menor
           
        ]);

        
        $response->assertRedirect(route('detallep.update', [
            'pedido_id' => $detalle->pedido_id,
            'detalle_id' => $detalle->id,
        ]));
        $response->assertSessionHasErrors(['cantidad' => 'La cantidad minima es 1']);
    }

    public function test_16_Validacion_CantidadesTotales()
{
   
    $detalle = DetallesPedido::factory()->create();

    $producto = Producto::factory()->create();

    // Actualizar el detalle con una cantidad mayor y un precio válido
    $response = $this->put(route('detallep.update', [
        'pedido_id' => $detalle->pedido_id,
        'detalle_id' => $detalle->id,
    ]), [
        'cantidad' => $detalle->cantidad + 1, // Intentar una cantidad mayor
        'precio' => $producto->precio, // Precio válido
        'producto_id' => $producto->id,
    ]);


    $response->assertRedirect(route('pedidost.detalle', ['id' => $detalle->pedido_id]));

    // Recargar el detalle desde la bd
    $detalle->refresh();
    $this->assertEquals($detalle->cantidad, $detalle->cantidad + 1);
    $this->assertEquals($detalle->precio, $producto->precio);


}

    public function test_17_Validacion_ProductoExistente()
    {
        // Crear un detalle de pedido de ejemplo en la base de datos
        $detalle = DetallesPedido::factory()->create();

        // Intentar actualizar el detalle con un producto_id que no existe
        $response = $this->put(route('detallep.update', [
            'pedido_id' => $detalle->pedido_id,
            'detalle_id' => $detalle->id,
        ]), [
            'cantidad' => $detalle->cantidad,
            'precio' => $detalle->precio,
            'producto_id' => 999, // Suponiendo que 999 no es un producto existente
        ]);

        $response->assertRedirect(route('detallep.update', [
            'pedido_id' => $detalle->pedido_id,
            'detalle_id' => $detalle->id,
        ]));

        // Verificar que el mensaje de error
        $response->assertSessionHasErrors(['producto_id' => 'El nombre del producto no existe']);
    }

    public function test_18_Redireccion_Inicio_SesionSiNoAutenticado()
    {
        // Crear un detalle de pedido de ejemplo en la base de datos
        $detalle = DetallesPedido::factory()->create();

        // Acceder a la ruta sin estar autenticado
        $response = $this->put(route('detallep.update', [
            'pedido_id' => $detalle->pedido_id,
            'detalle_id' => $detalle->id,
        ]));
        $response->assertRedirect(route('login'));
    }

    public function test_19_RestriccionId()
    {
        $detalle = DetallesPedido::factory()->create();

        // Acceder a la ruta con un pedido_id que no es un número
        $response = $this->put(route('detallep.update', [
            'pedido_id' => 'abc', // Un valor no numérico
            'detalle_id' => $detalle->id,
        ]));
        $response->assertStatus(404);
    }
    public function test_20_RestriccionId_negativo()
    {
        $detalle = DetallesPedido::factory()->create();

        // Acceder a la ruta con un pedido_id que no es un número positivo
        $response = $this->put(route('detallep.update', [
            'pedido_id' => '-1', // Un valor numérico negativo
            'detalle_id' => $detalle->id,
        ]));

    
        $response->assertStatus(404);
    }

    public function testRestriccionDetalleId()
    {
    
        $detalle = DetallesPedido::factory()->create();

        // Acceder a la ruta con un detalle_id que no es un número
        $response = $this->put(route('detallep.update', [
            'pedido_id' => $detalle->pedido_id,
            'detalle_id' => 'abc', // Un valor no numérico
        ]));
        $response->assertStatus(404);
    }

    public function test_RestriccionDetalleId_negativo()
    {
        $detalle = DetallesPedido::factory()->create();

        // Acceder a la ruta con un detalle_id que no es un número positivo
        $response = $this->put(route('detallep.update', [
            'pedido_id' => $detalle->pedido_id,
            'detalle_id' => '-1', // Un valor negativo
        ]));

        $response->assertStatus(404);
    }

    public function test_Excepcion_RecuperacionDetalle()
    {
        
        $detalle = DetallesPedido::factory()->create();

        // con un detalle_id que no existe
        $response = $this->put(route('detallep.update', [
            'pedido_id' => $detalle->pedido_id,
            'detalle_id' => 999, // Un valor que no existe
        ]));

        
        $response->assertStatus(404);
        $response->assertSee('Detalle no encontrado');
    }

    public function testCalculosImpuestosTotales()
    {
        // Crear un detalle de pedido de ejemplo en la base de datos
        $detalle = DetallesPedido::factory()->create([
            'cantidad' => 5,
            'precio' => 20,
        ]);

        $pedido = DetallesPedido::find($detalle->pedido_id);

        // Acceder a la ruta de actualización del detalle
        $response = $this->put(route('detallep.update', [
            'pedido_id' => $detalle->pedido_id,
            'detalle_id' => $detalle->id,
        ]), [
            'cantidad' => 3, 
            'precio' => $detalle->precio,
        ]);

       
        $response->assertRedirect(route('pedidost.detalle', ['id' => $detalle->pedido_id]));

        // Recargar el pedido y el detalle desde la base de datos
        $pedido->refresh();
        $detalle->refresh();

        $this->assertEquals($pedido->imp, ($detalle->precio * 3) * 0.15); // 15% de impuestos
        $this->assertEquals($pedido->total, ($detalle->precio * 3) + $pedido->imp);
    }

public function test_no_a_pedido()
    {
        
        $response = $this->get('/pedidos/cocina/detalle/1'); 

        $response->assertRedirect('/login'); 
        
         $response->assertStatus(403);
    }

    public function test_perdido_ValidacionErrors()
    {
        // Realizamos una solicitud POST a la ruta con datos incorrectos
        $response = $this->post('/pedidos/cocina/detalle/1', [
            'estado' => '', // Dejamos el campo 'estado' vacío para provocar un error de validación
            'estado_cocina' => '2',
            'estC' => '1',
        ]);
        $response->assertStatus(302); 
        $response->assertSessionHasErrors(['estado']); // Verificamos que hay un error en el campo 'estado'
    }

    public function test__act_estado()
    {
        
            $pedido = \App\Models\Pedido::factory()->create();
            $detalle = $pedido->detalles()->save(\App\Models\DetallesPedido::factory()->make());

        $response = $this->post("/pedidos/cocina/detalle/{$pedido->id}", [
            'estado' => '2', // Estado válido
            'estado_cocina' => '2', // Estado de cocina válido
            'estC' => '1', // estC válido
        ]);

        // Verificamos que la respuesta sea una redirección exitosa
        $response->assertRedirect("/pedidos/pedido"); 

        $pedido->refresh();
        $detalle->refresh();

        $this->assertEquals('2', $pedido->estado);
        $this->assertEquals('2', $pedido->estado_cocina);
        $this->assertEquals('1', $detalle->estC);
    }

    


   
    





    



}
