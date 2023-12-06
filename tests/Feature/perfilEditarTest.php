<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class perfilEditarTest extends TestCase
{
    use RefreshDatabase;

    public function test_perfil_ingresarsinloguearse()
    {
        $response = $this->get('/perfil');
        $response->assertStatus(302);
    }

    public function test_perfil_ingresaryredireccionallogin()
    {
        $response = $this->get('/perfil');
        $response->assertRedirect('/login');
    }

    

    public function test_perfil_ingresarlogueado()
    {
        $user = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);
        $this->actingAs($user);

        $response = $this->actingAs(User::find(1))->get('/perfil');
        $response->assertStatus(200);
    }

    public function test_perfilLabel1()
    {
        $user = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);
        $this->actingAs($user);
        $response = $this->actingAs(User::find(1))->get('/perfil');
        $response->assertSee('Nombre Completo:');
    }

    public function test_perfilLabel2()
    {
        $user = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);
        $response = $this->actingAs(User::find(1))->get('/perfil');
        $response->assertSee('Correo:');
    }

    public function test_perfilLabel3()
    {
        $user = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);
        $response = $this->actingAs(User::find(1))->get('/perfil');
        $response->assertSee('Telefono:');    //Telefono esta mal escrito en la vista se muestra como Teléfono
    }

    public function test_perfilLabel4()
    {
        $user = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);
        $response = $this->actingAs(User::find(1))->get('/perfil');
        $response->assertSee('Telefono:');  //Telefono esta mal escrito en la vista se muestra como Teléfono
    }







    public function test_EditarPerfilFormulario_CargaCorrectamente()
    {
        $usuario = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);

        
        $response = $this->actingAs($usuario)->get("/usuarios/{$usuario->id}/editando/perfil");

        
        $response->assertViewIs('auth.EditarUserPrin');



       
    }
    public function testActualizarNombreYDireccion()
    {
        $usuario = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);


        $this->actingAs($usuario)->put("/usuarios/{$usuario->id}/editando/perfil", [
            'name' => 'Nuevo Nombre',
            'email' => 'usuario@example.com',
            'address' => 'NuevaDireccion',
            'telephone' => '33994455',
        ]);


     $usuarioActualizado = \App\Models\User::find($usuario->id);

 
     $this->assertEquals('Nuevo Nombre', $usuarioActualizado->name);
     $this->assertEquals('NuevaDireccion', $usuarioActualizado->address);
       
    }

    public function testActualizarNumeroDeTelefono()
    {
        $usuario = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);

      
        $this->actingAs($usuario)->put("/usuarios/{$usuario->id}/editando/perfil", [
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'address' => 'Dirección de Prueba',
            'telephone' => '87654321', 
        ]);

       
        $usuarioActualizado = \App\Models\User::find($usuario->id);

    
        $this->assertEquals('87654321', $usuarioActualizado->telephone);
    }

    public function testCambiarContrasena()
    {
        $usuario = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);

    
        $this->actingAs($usuario)->put("/usuarios/{$usuario->id}/editando/perfil", [
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'new_password' => 'password', 
            'new_password_confirmation' => 'nuevacontrasena', //para cambiar la contraseña el new_password y new_password_confirmation debe ser la misma
            'address' => 'Dirección de Prueba',
            'telephone' => '32345678',
        ]);

     
        $usuarioActualizado = \App\Models\User::find($usuario->id);

       
        $this->assertTrue(Hash::check('nuevacontrasena', $usuarioActualizado->password));
    }

    public function testActualizarPerfilConNombreInvalidos()
    {
        $usuario = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);

        $response = $this->actingAs($usuario)->put("/usuarios/{$usuario->id}/editando/perfil", [
            'name' => '',
            'email' => 'usuario@example.com',
            'address' => 'Dirección de Prueba',
            'telephone' => '87654321', 
        ]);

        $usuarioActualizado = \App\Models\User::find($usuario->id);

        $response->assertSessionHasErrors(['name']);



        $this->assertNotEquals('', $usuarioActualizado->name);



    }

    public function testActualizarPerfilConEamilInvalidos()
    {
        $usuario = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]); 
        
        $response = $this->actingAs($usuario)->put("/usuarios/{$usuario->id}/editando/perfil", [
            'name' => 'Nombre de Usuario',
            'email' => '',
            'address' => 'Dirección de Prueba',
            'telephone' => '87654321', 
        ]);

        $usuarioActualizado = \App\Models\User::find($usuario->id);

        $response->assertSessionHasErrors(['email']);



        $this->assertNotEquals('', $usuarioActualizado->email);

    }

    public function testActualizarPerfilConAddressInvalidos()
    {
        $usuario = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);   

        $response = $this->actingAs($usuario)->put("/usuarios/{$usuario->id}/editando/perfil", [
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'address' => '',
            'telephone' => '87654321', 
        ]);
        $usuarioActualizado = \App\Models\User::find($usuario->id);

        $response->assertSessionHasErrors(['address']);



        $this->assertNotEquals('', $usuarioActualizado->address);

    }

    public function testActualizarPerfilConTelephoneInvalidos()
    {
        $usuario = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);   

        $response = $this->actingAs($usuario)->put("/usuarios/{$usuario->id}/editando/perfil", [
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'address' => 'Dirección de Prueba',
            'telephone' => '',  
        ]);

        $usuarioActualizado = \App\Models\User::find($usuario->id);

        $response->assertSessionHasErrors(['telephone']);



        $this->assertNotEquals('', $usuarioActualizado->telephone);

    }
    public function testEdicionDePerfilParaOtroUsuario()
    {
       
        $usuario1 = User::create([
            'name' => 'Nombre de Usuario1',
            'email' => 'usuario1@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]); 

        $usuario2 = User::create([
            'name' => 'Nombre de Usuario2',
            'email' => 'usuario2@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);   

     
        $response = $this->actingAs($usuario1)->get("/usuarios/{$usuario2->id}/editando/perfil");

       
        $response->assertStatus(403);

        
        $response->assertRedirect("/perfil");    //resuelta 
    }
    public function testRedireccionDespuesDeActualizacion()
    {
        $usuario = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);  

      
        $response = $this->actingAs($usuario)->put("/usuarios/{$usuario->id}/editando/perfil", [
            'name' => 'Nuevo Nombre',
            'email' => 'nuevo@example.com',
            'address' => 'NuevaDirección',
            'telephone' => '32345678',
        ]);

     
        $response->assertRedirect("/perfil");

        $response->assertSee('Perfil actualizado exitosamente.'); //al usar assertSessionHas si pasa la prueba para verificar mensaje de sesión (controlador: with('mensaje', "Perfil actualizado exitosamente.");)

    }

    public function testCamposPrellenados()
    {
        $usuario = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);  

        
        $response = $this->actingAs($usuario)->get("/usuarios/{$usuario->id}/editando/perfil");

      
        $response->assertSee('value="Nombre de Usuario"');  
    }

    public function testValidacionNombre()
    {
        $usuario = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);  
    

        $response = $this->actingAs($usuario)->put("/usuarios/{$usuario->id}/editando/perfil", [
            'name' => 'NombreInvalido',
            'email' => 'usuario@example.com',
            'address' => 'Dirección de Prueba',
            'telephone' => '87654321',  
           
        ]);

        
     

       
        $response->assertSessionHasErrors(['name']);
    }

    public function testValidacionNombreMinimo()
    {
       
        $usuario = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]); 

        
        $response = $this->actingAs($usuario)->put("/usuarios/{$usuario->id}/editando/perfil", [
            'name' => 'Ab',
             'email' => 'usuario@example.com',
            'address' => 'Dirección de Prueba',
            'telephone' => '87654321', 
            
        ]);

     


       
        $response->assertSessionHasErrors(['name']);
    }

    public function testValidacionNombreMaximo()
    {
        $usuario = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]); 

     
        $response = $this->actingAs($usuario)->put("/usuarios/{$usuario->id}/editando/perfil", [
            'name' => 'Nombre Excediendo ElLimite MaximoDeCaracteresssssssssssssss',
            'email' => 'usuario@example.com',
            'address' => 'Dirección de Prueba',
            'telephone' => '87654321', 
          
        ]);

     
        $response->assertSessionHasErrors(['name']);
    }

    public function testEmailFormatoValido()
    {
        $usuario = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]); 

        
        $response = $this->actingAs($usuario)->put("/usuarios/{$usuario->id}/editando/perfil", [
            'name'=> 'Nombre de Usuario',
            'email' => 'correo_invalido',
            'address' => 'Dirección de Prueba',
            'telephone' => '87654321', 
            
        ]);

        
        $response->assertSessionHasErrors(['email']);
    }

    public function testEmailLongitudMaxima()
    {
        $usuario = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]); 

        
        $response = $this->actingAs($usuario)->put("/usuarios/{$usuario->id}/editando/perfil", [
            'email' => 'correo'.str_repeat('a', 46).'@dominio.com',
            'address' => 'Dirección de Prueba',
            'telephone' => '87654321',
            'name'=> 'Nombre de Usuario',

         
        ]);

        
        $response->assertSessionHasErrors(['email']);
    }

    public function testEmailUnico()
    {
      
        $usuario = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);

        $otrousuario = User::create([
            'name' => 'Nombre de Usuario2',
            'email' => 'usuario2@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]); 

       
        $response = $this->actingAs($usuario)->put("/usuarios/{$usuario->id}/editando/perfil", [
            'email' => $otrousuario->email,
            'address' => 'Dirección de Prueba',
            'telephone' => '87654321',
            'name'=> 'Nombre de Usuario',

            
        ]);


        $response->assertSessionHasErrors(['email']);
    }
    public function testAddressRequerido()
    {
      
        $usuario = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);

        $response = $this->actingAs($usuario)->put("/usuarios/{$usuario->id}/editando/perfil", [
            'name'=> 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'address' => '',
            'telephone' => '87654321',
        ]);

  
        $response->assertSessionHasErrors(['address' => '¡Debes ingresar tu dirección!']);
    }

    public function testAddressLongitudMinima()
    { 
        $usuario = User::create([
        'name' => 'Nombre de Usuario',
        'email' => 'usuario@example.com',
        'password' => bcrypt('password'),
        'address' => 'Dirección de Prueba',
        'telephone' => '12345678',
        'imagen' => 'ruta_de_imagen.jpg',
        'is_default' => 'Usuario', 
    ]);

        
        $response = $this->actingAs($usuario)->put("/usuarios/{$usuario->id}/editando/perfil", [
            'address' => 'Aa',
            'name'=> 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'telephone' => '87654321',
        ]);

     
        $response->assertSessionHasErrors(['address' => '¡Ingresa tu dirección completa, sin abreviaturas!']);
    }
    public function testAddressLongitudMaxima()
    {
        $usuario = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);

       
        $response = $this->actingAs($usuario)->put("/usuarios/{$usuario->id}/editando/perfil", [
            'address' => str_repeat('a', 252), 
            'name'=> 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'telephone' => '87654321',
        ]);

        
        $response->assertSessionHasErrors(['address' => '¡Has excedido el limite máximo de 250 letras!']);
    }

    public function testTelephoneRequerido()
    {
        $usuario = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);

        
        $response = $this->actingAs($usuario)->put("/usuarios/{$usuario->id}/editando/perfil", [
            'address' => 'Direccion de prueba',
            'name'=> 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'telephone' => '',
        ]);

  
        $response->assertSessionHasErrors(['telephone' => '¡Debes ingresar tu número de teléfono!']);
    }

    public function testTelephoneLongitudMinima()
    {
        $usuario = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);

        
        $response = $this->actingAs($usuario)->put("/usuarios/{$usuario->id}/editando/perfil", [
            'telephone' => '1234567',
            'address' => 'Direccion de prueba',
            'name'=> 'Nombre de Usuario',
            'email' => 'usuario@example.com',
        ]);

       
        $response->assertSessionHasErrors(['telephone' => '¡El número telefónico debe tener minimo: 8 dígitos!']);
    }

    public function testTelephoneLongitudMaxima()
    {
        $usuario = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);

       
        $response = $this->actingAs($usuario)->put("/usuarios/{$usuario->id}/editando/perfil", [
            'telephone' => '123456789', 
            'address' => 'Direccion de prueba',
            'name'=> 'Nombre de Usuario',
            'email' => 'usuario@example.com',

        ]);

        
        $response->assertSessionHasErrors(['telephone' => '¡El número telefónico debe tener maximo: 8 dígitos!']);
    }

    public function testTelephoneFormatoValido()
    {
        $usuario = User::create([
            'name' => 'Nombre de Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);

        
        $response = $this->actingAs($usuario)->put("/usuarios/{$usuario->id}/editando/perfil", [
            'telephone' => '123a5678', 
            'address' => 'Direccion de prueba',
            'name'=> 'Nombre de Usuario',
            'email' => 'usuario@example.com',


        ]);

        
        $response->assertSessionHasErrors(['telephone' => '¡El número telefónico debe iniciar con (2),(3),(8) ó (9)!']);
    }


}
