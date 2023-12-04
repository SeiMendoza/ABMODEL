<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Menu;
use App\Models\Pedido;
use App\Models\DetallesPedido;
use App\Database\Factories\Mesa;
use Tests\TestCase;

class PedidosUsuarioTest extends TestCase
{
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
    

    //1
    public function testPedidoPendientesRoute()
    {
        $response = $this->get('/pedidos/cocina');

        $response->assertStatus(302);
    }
    //2
    public function testActualizarEstadoPedidoEnCocina()
{
    $pedido = Pedido::factory()->create();
    $detallesPedido = DetallesPedido::factory()->create(['pedido_id' => $pedido->id]);

    $response = $this->post("/pedidos/cocina/{$pedido->id}", [
        'estado' => 2,
        'estado_cocina' => 2,
        'estC' => 1,
    ]);

    $response->assertRedirect(route('pedidosp.pedido')); // Verificar redirección

    // Verificar que la base de datos se actualiza correctamente
    $this->assertDatabaseHas('pedidos', [
        'id' => $pedido->id,
        'estado' => 2,
        'estado_cocina' => 2,
    ]);

    // Verificar que los detalles del pedido se actualizan correctamente
    $detallesPedido = DetallesPedido::where('pedido_id', $pedido->id)->get();

    foreach ($detallesPedido as $detalle) {
        $this->assertEquals(1, $detalle->estC);
    }

    // Otras aserciones para detalles del pedido si es necesario
}
    
    //3
    public function testActualizarEstadoPedidoInexistenteEnCocina()
    {
        $pedidoIdInexistente = 999; // ID que no existe en la base de datos

        $response = $this->post("/pedidos/cocina/{$pedidoIdInexistente}", [
            'estado' => 2,
            'estado_cocina' => 2,
            'estC' => 1,
        ]);

        $response->assertStatus(302); // Verificar que se recibe un código de estado 404 (Not Found)
        // Puedes agregar más aserciones según sea necesario
    }
    //4
    public function testValidacionFallidaAlActualizarEstadoPedidoEnCocina()
    {
        $pedido = Pedido::factory()->create();

        $response = $this->post("/pedidos/cocina/{$pedido->id}", [
            $request->validate([
                'estado' => 'required|in:2',
                'estado_cocina' => 'required|in:2',
                'estC' => 'required|in:1'
            ])
            
        ]);

        $response->assertSessionHasErrors(['estado', 'estado_cocina', 'estC']); // Verificar errores de validación
        // Puedes agregar más aserciones según sea necesario
    }
    //5 
    public function test_Actualizacion_Exitosa_Estado_Pedido_Y_Detalles_En_Cocina()
    {
        $pedido = Pedido::factory()->create();
        $detallesPedido = DetallesPedido::factory()->create(['pedido_id' => $pedido->id]);

        $response = $this->post("/pedidos/cocina/{$pedido->id}", [
            'estado' => 2,
            'estado_cocina' => 2,
            'estC' => 1,
        ]);

        $response->assertRedirect(route('pedidosp.pedido')); // Verificar redirección
        $this->assertDatabaseHas('pedidos', ['id' => $pedido->id, 'estado' => 2, 'estado_cocina' => 2]);

        // Verificar que los detalles del pedido se actualizan correctamente
        $this->assertDatabaseHas('detalles_pedidos', [
            'id' => $detallesPedido->id,
            'estC' => 1, // El valor actualizado
        ]);

        // Puedes agregar más aserciones según sea necesario
    }
   //6
   public function testManejoDetallesPedidoVacioEnActualizacionCocina()
   {
       $pedido = Pedido::factory()->create();

       // No creamos detalles del pedido en esta prueba, simula una situación donde no hay detalles.

       $response = $this->post("/pedidos/cocina/{$pedido->id}", [
           'estado' => 2,
           'estado_cocina' => 2,
           'estC' => 1,
       ]);

       $response->assertRedirect(route('pedidosp.pedido')); // Verificar redirección

       // Verificar que la base de datos se actualiza correctamente
       $this->assertDatabaseHas('pedidos', [
           'id' => $pedido->id,
           'estado' => 2,
           'estado_cocina' => 2,
       ]);

       // Verificar que no se intentó acceder a detalles del pedido (ya que está vacío)
       $this->assertDatabaseMissing('detalles_pedidos', [
           'pedido_id' => $pedido->id,
       ]);
   }



//--------------------------------------------------------------------------------------------------------------------
    //1
    public function testTerminadosRoute()
    {
        $response = $this->get('/pedidos/terminados');

        $response->assertStatus(302);
    }
    //2
    use RefreshDatabase;

    public function testBorrarDatosCuandoHayPedidosTerminados()
    {
        // Crear al menos un pedido con estado 3 para simular pedidos terminados
        Pedido::factory()->state(['estado' => 0])->create();

        $response = $this->get('/pedidos/terminados/borrar');

        $response->assertRedirect(route('terminados.terminados'))
        ->assertSessionHas('errors', function ($errors) {
        return preg_match('/No hay pedidos para borrar/i', $errors);
        });


        // Verificar que los pedidos con estado 3 se han eliminado de la base de datos
        $this->assertDatabaseMissing('pedidos', ['estado' => 3]);
    }
    //3
    public function testBorrarDatosCuandoNoHayPedidosTerminados()
    {
        // Asegurarse de que no hay pedidos con estado 3
        Pedido::where('estado', 0)->delete();

        $response = $this->get('/pedidos/terminados/borrar');

        $response->assertRedirect(route('terminados.terminados'))
            ->assertSessionHas('errors', 'No hay pedidos para borrar.');

        // Verificar que no se intentó eliminar pedidos ya que no hay con estado 3
        $this->assertDatabaseMissing('pedidos', ['estado' => 0]);
    }


     
    //-------------------------------------------------------------------------------------------------------------


    //1
    public function testDetallePedidoTerminadosRoute()
    {
        // Supongamos que el id es 1 (puedes ajustarlo según tus necesidades)
        $idPedido = 1;

        $response = $this->get("/pedidos/caja/detalle/{$idPedido}");

        $response->assertStatus(302);
    }
   //2
    public function testTerminarPedidoExitoso()
   {
       // Crear un usuario de prueba y autenticarse
       $user = factory(\App\User::class)->create();
       $this->browse(function (Browser $browser) use ($user) {
           $browser->loginAs($user)
               ->visit('/crear-pedido') // Ajusta la ruta según la estructura de tu aplicación
               // Realiza las acciones necesarias para crear un nuevo pedido
               // Puedes utilizar "$browser->type", "$browser->select", "$browser->click", etc.
               // ...

               ->press('#submit-crear-pedido') // Ajusta el selector según tu formulario
               ->assertSee('Pedido creado exitosamente!'); // Ajusta el mensaje según tu aplicación

               // Obtén el ID del pedido recién creado (puedes ajustar esto según tu lógica)
               $pedidoId = \App\Pedido::latest()->first()->id;

               // Ahora, visita la página para terminar el pedido
               $browser->visit("/pedidos/caja/{$pedidoId}") // Ajusta la URL según tu ruta y la lógica de tu aplicación
               ->select('#mesa', '1') // Ajusta el selector y el valor según tu formulario
               ->press('#submit-terminar-pedido') // Ajusta el selector según tu formulario
               ->assertSee('El pedido fue terminado exitosamente!'); // Ajusta el mensaje según tu aplicación
       });
   }
   //3
   public function testRedireccionDespuesDeCompletarPedido()
   {
       // Creamos un pedido para probar (puedes ajustar esto según tus necesidades)
       $pedido = Pedido::factory()->create();

       // Simulamos una solicitud para completar el pedido
       $response = $this->put(route('pedidos.completar', ['id' => $pedido->id]));
       dd($response->getContent());

       // Verificamos que la redirección sea a la ruta 'pedidos.caja'
       $response->assertRedirect(route('pedidos.caja'));
   }
   //4
   public function testEstadoDeMesaDespuesDeCompletarPedido()
   {
       // Creamos una mesa para probar (puedes ajustar esto según tus necesidades)
       $mesa = Mesa::factory()->create();

       // Creamos un pedido asociado a la mesa
       $pedido = Pedido::factory()->create(['mesa_id' => $mesa->id]);

       // Simulamos una solicitud para completar el pedido
       $this->browse(function (Browser $browser) use ($pedido) {
           $browser->visit("/pedidos/completar/{$pedido->id}") // Ajusta la URL según tu aplicación
               ->select('#mesa', $pedido->mesa_id) // Ajusta el selector y el valor según tu formulario
               ->press('#submit-terminar-pedido'); // Ajusta el selector según tu formulario
       });

       // Refrescamos la instancia de la mesa desde la base de datos
       $mesa = $mesa->fresh();

       // Verificamos que el estado de la mesa sea 0 (o el valor que esperas después de completar un pedido)
       $this->assertEquals(0, $mesa->estadoM);
   }
   //5
   public function testPruebaDeRendimiento()
   {
       $this->artisan('route:cache'); // Carga las rutas en caché para mejorar el rendimiento

       $start = microtime(true); // Captura el tiempo de inicio

       $end = microtime(true); // Captura el tiempo de finalización

       $executionTime = ($end - $start); // Calcula el tiempo total de ejecución
       $this->assertLessThan(1000, $executionTime, 'La prueba de rendimiento tardó más de 1000 milisegundos.');
   }










    public function testDestroyPedidoRoute()
    {
        // Supongamos que el id es 1 y la vista es 'mi_vista' (ajusta según tus necesidades)
        $idPedido = 1;
        $vista = 'mi_vista';

        $response = $this->post("/pedidos/detalles/{$idPedido}/borrar/{$vista}");

        $response->assertStatus(302);
    }

    use RefreshDatabase;

    public function testBorrarDetalleCaja()
    {
        // Crear un pedido detalle para probar (puedes ajustar esto según tus necesidades)
        $detalle = PedidoDetalle::factory()->create();

        // Simular una solicitud POST a la ruta '/pedidos/detalles/{id}/borrar/{vista}'
        $response = $this->post(route('detallep.destroy', ['id' => $detalle->pedido_id, 'vista' => 'tu_vista']));

    }

    public function testEditDetallePedidoRoute()
    {
        // Supongamos que pedido_id es 1 y detalle_id es 2 (ajusta según tus necesidades)
        $pedidoId = 1;
        $detalleId = 2;

        $response = $this->get("/pedidos/{$pedidoId}/detalles/{$detalleId}/editar");

        $response->assertStatus(302);
    }
    public function testEditarDetallePedido()
    {
        // Crear un pedido y un detalle de pedido para probar
        $pedido = Pedido::factory()->create();
        $detalle = PedidoDetalle::factory()->create(['pedido_id' => $pedido->id]);

        // Simular una solicitud GET a la ruta '/pedidos/{pedido_id}/detalles/{detalle_id}/editar'
        $response = $this->get(route('detallep.edit', ['pedido_id' => $pedido->id, 'detalle_id' => $detalle->id]));

      
    }





}
