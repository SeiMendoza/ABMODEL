<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BusquedaAdmonTest extends TestCase
{



    public function test_busqueda_ingresar_status_302_sin_usuario_logueado_1()
    {

        $response = $this->get('/busqueda');
        $response->assertStatus(302);
    }

    public function test_busqueda_ingresar_retorno_login_sin_usuario_logueado_2()
    {
        $response = $this->get('/busqueda');
        $response->assertRedirect('/login');
    }

    // public function test_busqueda_ingresar_status_200_usuario_logueado_3()
    // {
    //     $response = $this->actingAs(User::find(1))->get('/busqueda');
    //     $response->assertStatus(200);
    // }

    // public function test_busqueda_ingresar_vista_4()
    // {
    //     $response = $this->actingAs(User::find(1))->get('/busqueda');
    //     $response->assertViewIs('Menu.Admon.QR_Menu');
    // }
}
