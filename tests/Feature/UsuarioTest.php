<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UsuarioTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
  
    
     public function test_1_listaUsuarioAntesIngresarConUsuario()
    {
        $response = $this->get('/listaUsuarios');
        $response->assertRedirect('/login');
    }

    public function test_2_crearUsuarioAntesIngresarConUsuario()
    {
        $response = $this->get('/usuarios/create');

        $response->assertRedirect('/login');
    }

    public function test_3_editarUsuarioAntesIngresarConUsuario()
    {
        $response = $this->get('/usuarios/{id}/edit', ['id'=>2]);

        $response->assertRedirect('/login');
    }

    public function test_4_listaUsuarioDespuesDeIngresarConUsuario()
    {
        $user = User::find(1);
        //Auth::login($user); una forma de logiarse en prueba facil
        $response = $this->actingAs($user)->get('/listaUsuarios');

        $response->assertSuccessful();
    }

    public function test_5_crearUsuarioAntesIngresarConUsuario()
    {
        $response = $this->post('/usuarios/create',[
            'name' => 'Evelyn',
            'email' => 'evyrodriguez03@gmail.com',
            'is_default' => 'Administrador',
            'password' => '03roxana.',
            'address' => 'Las Flores',
            'telephone' => '94567892',
            'imagen' => 'img/imagen.png'
        ]);

        $response->assertRedirect('/login');
    }

    public function test_6_crearUsuarioDespuesIngresarConUsuario()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->post('/usuarios/create',[
            'name' => 'Evelyn Roxana Rodriguez Maradiaga',
            'email' => 'evyrodriguez03@gmail.com',
            'is_default' => 'Administrador',
            'password' => '03roxana.',
            'password_confirmation' => '03roxana.',
            'address' => 'Las Flores',
            'telephone' => '94567892',
            'imagen' => 'img/imagen.png'
        ]);


        $usernew = User::where('name', '=', 'Evelyn Roxana Rodriguez Maradiaga')->first();
        $this->assertTrue($usernew->count()>0);
    }

    public function test_7_crearUsuarioValidacionNameRequerido()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->post('/usuarios/create',[
            'name' => '',
            'email' => 'evyrodriguez03@gmail.com',
            'is_default' => 'Administrador',
            'password' => '03roxana.',
            'password_confirmation' => '03roxana.',
            'address' => 'Las Flores',
            'telephone' => '94567892',
            'imagen' => 'img/imagen.png'
        ]);

        $response->assertInvalid([
            'name' => '¡Debes ingresar tu nombre completo!'
        ]);
    }

    public function test_8_crearUsuarioValidacionEmailRequerido()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->post('/usuarios/create',[
            'name' => 'Evelyn Roxana Rodriguez Maradiaga',
            'email' => '',
            'is_default' => 'Administrador',
            'password' => '03roxana.',
            'password_confirmation' => '03roxana.',
            'address' => 'Las Flores',
            'telephone' => '94567892',
            'imagen' => 'img/imagen.png'
        ]);

        $response->assertInvalid([
            'email' => '¡Debes ingresar tú correo electrónico!'
        ]);
    }

    public function test_9_crearUsuarioValidacionIsDefaultRequerido()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->post('/usuarios/create',[
            'name' => 'Evelyn Roxana Rodriguez Maradiaga',
            'email' => 'evyrodriguez03@gmail.com',
            'is_default' => '',
            'password' => '03roxana.',
            'password_confirmation' => '03roxana.',
            'address' => 'Las Flores',
            'telephone' => '94567892',
            'imagen' => 'img/imagen.png'
        ]);

        $response->assertInvalid([
            'is_default' => '¡Este campo es obligatorio!'
        ]);
    }


    public function test_10_crearUsuarioValidacionAddressRequerido()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->post('/usuarios/create',[
            'name' => 'Evelyn Roxana Rodriguez Maradiaga',
            'email' => 'evyrodriguez03@gmail.com',
            'is_default' => 'Administrador',
            'password' => '03roxana.',
            'password_confirmation' => '03roxana.',
            'address' => '',
            'telephone' => '94567892',
            'imagen' => 'img/imagen.png'
        ]);

        $response->assertInvalid([
            'address' => '¡Debes ingresar tu dirección!'
        ]);
    }

    public function test_11_crearUsuarioValidacionTelephoneRequerido()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->post('/usuarios/create',[
            'name' => 'Evelyn Roxana Rodriguez Maradiaga',
            'email' => 'evyrodriguez03@gmail.com',
            'is_default' => 'Administrador',
            'password' => '03roxana.',
            'password_confirmation' => '03roxana.',
            'address' => 'Las Flores',
            'telephone' => '',
            'imagen' => 'img/imagen.png'
        ]);

        $response->assertInvalid([
            'telephone' => '¡Debes ingresar tu número de teléfono!'
        ]);
    }

    public function test_12_RequiereMinimoTresCaracteres()
    {
    $user = User::find(1);

    $response = $this->actingAs($user)->post('/usuarios/create', [
        'name' => 'A', 
        'email' => 'evyrodriguez03@gmail.com',
        'is_default' => 'Usuario',
        'password' => '03roxana.',
        'password_confirmation' => '03roxana.',
        'address' => 'Las Flores',
        'telephone' => '94567892',
        'imagen' => 'img/imagen.png'
    ]);

    $response->assertInvalid([
        'name' => '¡Ingresa tu nombre completo, sin abreviaturas!'
    ]);
    }


}
