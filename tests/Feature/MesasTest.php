<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Mesa;
use App\Models\KioskoReservacion;

class MesasTest extends TestCase
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

    public function test_1_mesas_reser()
    {
        $response = $this->get('/mesas/reservaciones');
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }
    
    public function test_2_mesas_registro()
    {
        $response = $this->get('/mesas/lista');
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function Test_3_mesas_registro()
    {
        $response = $this->get('/mesas/lista');
        $response->assertRedirect('/login');
        $response->assertStatus(200);
    }
    public function Test_4_mesas_reser()
    {
        $response = $this->get('/mesas/lista');
        $response->assertStatus(200);
    }

    public function test_5_mesa_usuariologueado()
    {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->get('/mesas/lista');
        
        $response->assertStatus(200);
    }

    public function test_6_ingresoplantilla_mesas()
    {

        $response = $this->actingAs(User::find(1))->get('/mesas/lista');
        $response->assertViewIs('Reservaciones.ReserAdmon.Mesas.mesasRegistro');
    }

    public function test_7_ingresoLabel1_mesas()
    {
        $response = $this->actingAs(User::find(1))->get('/mesas/lista');
        $response->assertSee('Mesa');
    }

    public function test_8_ingresoLabel2_mesas()
    {
        $response = $this->actingAs(User::find(1))->get('/mesas/lista');
        $response->assertSee('Cantidad de personas');
    }
    public function test_9_ingresoLabel3_mesas()
    {
        $response = $this->actingAs(User::find(1))->get('/mesas/lista');
        $response->assertSee('Kiosko');
    }
    public function test_10_ingresoLabel4_mesas()
    {
        $response = $this->actingAs(User::find(1))->get('/mesas/lista');
        $response->assertSee('Estado');
    }
    public function test_11_ingresoLabel5_mesas()
    {
        $response = $this->actingAs(User::find(1))->get('/mesas/lista');
        $response->assertSee('QR');
    }
    public function test_12_ingresoLabel6_mesas()
    {
        $response = $this->actingAs(User::find(1))->get('/mesas/lista');
        $response->assertSee('Editar');
    }
    public function test_13_ingresoLabel7_mesas()
    {
        $response = $this->actingAs(User::find(1))->get('/mesas/lista');
        $response->assertSee('Eliminar');
    }
    public function test__14_nuevamesainloguearse()
    {
        $response = $this->get('/mesas/registro/nuevo');
        $response->assertStatus(302);
    }

    public function test_15_nuevamesainloguearseLogin()
    {
        $response = $this->get('/mesas/registro/nuevo');
        $response->assertRedirect('/login');
    }

    public function test_16_nuevamesalabel1()
    {
        $response = $this->actingAs(User::find(1))->get('/mesas/registro/nuevo');
        $response->assertSee('Datos de la mesa:');
    }
    public function test_17_nuevamesalogueado()
    {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->get('/mesas/registro/nuevo');
        
        $response->assertStatus(200);
    }

    public function test_18_nuevamesalabel2()
    {
        $response = $this->actingAs(User::find(1))->get('/mesas/registro/nuevo');
        $response->assertSee('kiosko');
    }
    public function test_19_nuevamesabel3()
    {
        $response = $this->actingAs(User::find(1))->get('/mesas/registro/nuevo');
        $response->assertSee('name');
    }
    public function test_20_nuevamesalabel3()
    {
        $response = $this->actingAs(User::find(1))->get('/mesas/registro/nuevo');
        $response->assertSee('codigo');
    }

    public function test_21_nuevamesavista()
    {

        $response = $this->actingAs(User::find(1))->get('/mesas/registro/nuevo');
        $response->assertViewIs('Reservaciones.ReserAdmon.Mesas.formularioRegistro');
    }

    public function test_22_editar_mesa_in_sin_usuario_logueado()
    {
        $response = $this->get('/mesas/registro/1/edicion');
        $response->assertStatus(302);
    }

    public function test_23_editar_mesa_in_sin_usuario_logueado()
    {
        $response = $this->get('/mesas/registro/1/edicion');
        $response->assertRedirect('/login');
    }

    public function test_24_editar_mesa_status_usuario_logueado()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->actingAs(User::find(1))->get('/mesas/registro/1/edicion');
        $response->assertStatus(404);
    }

    public function test_25_editar_mesa_ingresar_vista()
    {

        $response = $this->actingAs(User::find(1))->get('/mesas/registro/1/edicion');
        $response->assertViewIs('Reservaciones.ReserAdmon.Mesas.editarRegistro');
    }

    public function test_26_eliminar_exitosamente()
{
   
    $mesaExistente = Mesa::first();

    $response = $this->delete("/mesas/registro/{$mesaExistente->id}/borrar");
    
    $response->assertSessionDoesntHaveErrors();

    
    $this->assertDatabaseMissing('mesas', ['id' => $mesaExistente->id]);
}

public function Test_27_mesas_codigo()
    {
        $response = $this->get('/mesas/1/qr');
        $response->assertRedirect('/login');
        $response->assertStatus(302);
    }


    public function Test_28_mesas_codigo()
    {
        $response = $this->get('/mesas/1/qr');
        $response->assertStatus(200);
    }

    public function Test_29_mesas_pdf()
    {
        $response = $this->get('/qr-pdf/1');
        $response->assertRedirect('/login');
        $response->assertStatus(200);
    }
    public function Test_30_mesas_pdf()
    {
        $response = $this->get('/qr-pdf/1');
        $response->assertStatus(200);
    }
    public function test_31_mesas_buscar()
    {
        $response = $this->get('/mesas/registro/buscar');
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function test_32_create_mesa_exitosa()
    {
        // Datos de ejemplo
        $nuevo = [
            'codigo' => 'codigo123',
            'name' => 'numero',
            'cantidad' => 5,
            'kiosko' => 'kiosko',
        ];
        $respuesta = $this->post('mesas_reg.create', $nuevo);

        $respuesta->assertStatus(201);    
        $this->assertDatabaseHas('mesas', [
            'codigo' => 'codigo123',
            'name' => 'numero',
            'cantidad' => 5,
            'kiosko' => 'kiosko'
        ]);
      
    }

    public function test_33_el_campo_codigo_debe_seguir_el_patron_especifico()
    {
     
        $respuesta = $this->post('/mesas/registro/nuevo', ['codigo' => 'K46-M12']);
        $respuesta->assertSessionHasErrors('codigo');
    }

    public function test_34_el_campo_es_obligatorio()
    {
        $respuesta = $this->post('/mesas/registro/nuevo', ['codigo' => '']);
        $respuesta->assertSessionHasErrors('codigo');
    }

    public function test_35_el_campo_es_obligatorio()
    {
        $respuesta = $this->post('/mesas/registro/nuevo', ['name' => '']);
        $respuesta->assertSessionHasErrors('mesa');
    }

    public function test_36_editar_mesa_in_sin_usuario_logueado_1()
    {
        $response = $this->get('/mesas/registro/1/edicion');
        $response->assertStatus(302);
    }
    public function test_37_editar_mesa_in_sin_usuario_logueado_2()
    {
        $response = $this->get('/mesas/registro/1/edicion');
        $response->assertRedirect('/login');
    }

    public function test_38_editar_mesa_status_200_usuario_logueado_3()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->actingAs(User::find(1))->get('/mesas/registro/1/edicion');
        $response->assertStatus(200);
    }

    public function test_39_editar_mesa_ingresar_vista_4()
    {

        $response = $this->actingAs(User::find(1))->get('/mesas/registro/1/edicion');
        $response->assertViewIs('Reservaciones.ReserAdmon.Mesas.editarRegistro');
    }

    public function test_40_editar_mesa_kiosko()
    {
        $response = $this->actingAs(User::find(1))->get('/piscina/1/editar');
        $response->assertSee('kiosko');
    }
    public function test_41_editar_mesa_nombre()
    {
        $response = $this->actingAs(User::find(1))->get('/piscina/1/editar');
        $response->assertSee('name');
    }

    public function test_42_eliminar_exitosamente()
{
   
    $mesa = Mesa::first();
   
    $response = $this->delete("/mesas/{$mesa->id}/borrar");

    $response->assertSessionDoesntHaveErrors();
    
    $this->assertDatabaseMissing('mesas', ['id' => $mesa->id]);
}


  
}
