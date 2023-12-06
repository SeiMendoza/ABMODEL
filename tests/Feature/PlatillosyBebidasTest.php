<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlatillosyBebidasTest extends TestCase
{
    public function test_registro_platillos_ingresar_status_302_sin_usuario_logueado_1()
    {
        $response = $this->get('/bebidasyplatillos/nuevo/0');
        $response->assertStatus(302);
    }

    public function test_registro_platillos_ingresar_retorno_login_sin_usuario_logueado_2()
    {
        $response = $this->get('/bebidasyplatillos/nuevo/0');
        $response->assertRedirect('/login');
    }

    public function test_registro_platillos_ingresar_status_200_usuario_logueado_3()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->actingAs(User::find(1))->get('/bebidasyplatillos/nuevo/0');
        $response->assertStatus(200);
    }

    public function test_registro_platillos_ingresar_vista_4()
    {

        $response = $this->actingAs(User::find(1))->get('/bebidasyplatillos/nuevo/0');
        $response->assertViewIs('.Menu.Admon.Registro.registroPlatillosYBebidas');
    }

    public function test_registro_platillos_ingresar_vista_componentes_1_label_5()
    {
        $response = $this->actingAs(User::find(1))->get('/bebidasyplatillos/nuevo/0');
        $response->assertSee('Registro de productos');
    }

    public function test_registro_platillos_ingresar_vista_componentes_2_label_6()
    {
        $response = $this->actingAs(User::find(1))->get('/bebidasyplatillos/nuevo/0');
        $response->assertSee('Tipo de producto:');
    }

    public function test_registro_platillos_ingresar_vista_componentes_3_label_7()
    {
        $response = $this->actingAs(User::find(1))->get('/bebidasyplatillos/nuevo/0');
        $response->assertSee('Tamaño:');
    }

    public function test_registro_platillos_ingresar_vista_componentes_4_label_8()
    {
        $response = $this->actingAs(User::find(1))->get('/bebidasyplatillos/nuevo/0');
        $response->assertSee('Nombre del producto:');
    }

    public function test_registro_platillos_ingresar_vista_componentes_5_label_9()
    {
        $response = $this->actingAs(User::find(1))->get('/bebidasyplatillos/nuevo/0');
        $response->assertSee('Precio:');
    }

    public function test_registro_platillos_ingresar_vista_componentes_6_label_10()
    {
        $response = $this->actingAs(User::find(1))->get('/bebidasyplatillos/nuevo/0');
        $response->assertSee('Descripción:');
    }

    public function test_registro_platillos_ingresar_vista_componentes_7_label_11()
    {
        $response = $this->actingAs(User::find(1))->get('/bebidasyplatillos/nuevo/0');
        $response->assertSee('Cantidad disponible:');
    }

    public function test_registro_platillos_ingresar_vista_componentes_8_label_12()
    {
        $response = $this->actingAs(User::find(1))->get('/bebidasyplatillos/nuevo/0');
        $response->assertSee('Seleccionar imagen');
    }

    public function test_registro_platillos_ingresar_vista_componentes_1_place_holder_13()
    {
        $response = $this->actingAs(User::find(1))->get('/bebidasyplatillos/nuevo/0');
        $response->assertSee('Seleccione el tipo de producto');
    }

    public function test_registro_platillos_ingresar_vista_componentes_2_place_holder_14()
    {
        $response = $this->actingAs(User::find(1))->get('/bebidasyplatillos/nuevo/0');
        $response->assertSee('Seleccione el tamaño');
    }

    public function test_registro_platillos_ingresar_vista_componentes_3_place_holder_15()
    {
        $response = $this->actingAs(User::find(1))->get('/bebidasyplatillos/nuevo/0');
        $response->assertSee('Ingrese el nombre del producto');
    }

    public function test_registro_platillos_ingresar_vista_componentes_4_place_holder_16()
    {
        $response = $this->actingAs(User::find(1))->get('/bebidasyplatillos/nuevo/0');
        $response->assertSee('Ingrese el precio');
    }

    public function test_registro_platillos_ingresar_vista_componentes_5_place_holder_17()
    {
        $response = $this->actingAs(User::find(1))->get('/bebidasyplatillos/nuevo/0');
        $response->assertSee('Ingrese la descripción');
    }

    public function test_registro_platillos_ingresar_vista_componentes_6_place_holder_18()
    {
        $response = $this->actingAs(User::find(1))->get('/bebidasyplatillos/nuevo/0');
        $response->assertSee('Ingrese la cantidad disponible');
    }

    public function test_registro_platillos_ingresar_vista_componentes_6_place_holder_19()
    {
        $response = $this->actingAs(User::find(1))->get('/bebidasyplatillos/nuevo/0');
        $response->assertSee('Ingrese la cantidad disponible');
    }

    public function test_registro_platillos_ingresar_vista_componentes_boton_regresar_20()
    {
        $response = $this->actingAs(User::find(1))->get('/bebidasyplatillos/nuevo/0');
        $response->assertSee('Regresar');
    }

    public function test_registro_platillos_ingresar_vista_componentes_boton_cancelar_21()
    {
        $response = $this->actingAs(User::find(1))->get('/bebidasyplatillos/nuevo/0');
        $response->assertSee('Cancelar');
    }

    public function test_registro_platillos_ingresar_vista_componentes_boton_guardar_22()
    {
        $response = $this->actingAs(User::find(1))->get('/bebidasyplatillos/nuevo/0');
        $response->assertSee('Guardar');
    }


    public function test_menu_cliente_ingresar_status_302_sin_usuario_logueado_23()
    {
        $response = $this->get('/menu/cliente');
        $response->assertStatus(302);
    }

    public function test_menu_cliente_ingresar_retorno_login_sin_usuario_logueado_24()
    {
        $response = $this->get('/menu/cliente');
        $response->assertRedirect('/login');
    }

    public function test_menu_cliente_ingresar_status_200_usuario_logueado_25()
    {
        $response = $this->actingAs(User::find(1))->get('/menu/cliente');
        $response->assertStatus(200);
    }

    public function test_menu_cliente_ingresar_vista_26()
    {
        $response = $this->actingAs(User::find(1))->get('/menu/cliente');
        $response->assertViewIs('Menu.Cliente');
    }

}
