<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\reservacion_total;

class ReservacionesTest extends TestCase
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

    public function test_1__reservacion()
    {
        
        $response = $this->delete('cliente/1/borrar');
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }
    
    public function test_2_reservacion()
    {
        $response = $this->delete('cliente/{id}/borrar');
        $response->assertStatus(302);
        $response->assertRedirect(route('cliente.destroy'));
    }

    public function test_3_reservacion_usuariologueado()
    {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->get('/Reservaciones/Realizadas');
        
        $response->assertStatus(200);
    }

    public function test_4_plantilla_reservas_realizada()
    {

        $response = $this->actingAs(User::find(1))->get('/Reservaciones/Realizadas');
        $response->assertViewIs('Reservaciones/ReserLocal/ReservRealizadas');
    }
    public function test_5_campo__reservaciont()
    {
        
        $response = $this->actingAs(User::find(1))->get('/Reservaciones/Realizadas');
        $response->assertSee('Nombre_Cliente');
    }
    public function test_6_campo_reservaciont()
    {
        $response = $this->actingAs(User::find(1))->get('/Reservaciones/Realizadas');
        $response->assertSee('Contacto');
    }
    public function test_7_campo_reservaciont()
    {
        $response = $this->actingAs(User::find(1))->get('/Reservaciones/Realizadas');
        $response->assertSee('Fecha');
    }
    public function test_8_campo__reservaciont()
    {
        $response = $this->actingAs(User::find(1))->get('/Reservaciones/Realizadas');
        $response->assertSee('Total');
    }
    public function test_9_campo_reservaciont()
    {
        $response = $this->actingAs(User::find(1))->get('/Reservaciones/Realizadas');
        $response->assertSee('Pendiente');
    }
    public function test_10_campo_reservaciont()
    {
        $response = $this->actingAs(User::find(1))->get('/Reservaciones/Realizadas');
        $response->assertSee('list');
    }
    public function test_11_campo_reservaciont()
    {
        $response = $this->actingAs(User::find(1))->get('/Reservaciones/Realizadas');
        $response->assertSee('detalles');
    }
    public function test_12_campo_reservaciont()
    {
        $response = $this->actingAs(User::find(1))->get('/Reservaciones/Realizadas');
        $response->assertSee('eliminar');
    }
    public function test_13_detalles_reservas_realizadas()
    {
        $response = $this->get('/Reservacion/{id}/Realizada/Detalles');
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }
 
    public function test_15_detalle_usuariologueado()
    {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->get('/Reservacion/1/Realizada/Detalles');
        
        $response->assertStatus(200);
    }
    
    public function test_16_mostrar()
    {
        $response = $this->get('pedido/menu/mostrar');
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

}
