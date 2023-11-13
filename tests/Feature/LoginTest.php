<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User; 

class LoginTest extends TestCase
{


    public function test_prueba_de_autenticidad_con_usuario_valido()
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

      
        $response = $this->post('/login', [
            'email' => 'usuario@example.com',
            'password' => 'password', 
        ]);

       
        $response->assertRedirect('/home'); 

        $this->assertAuthenticatedAs($user);
    }
    
    public function test__inicio_de_sesion_fallido_con_credenciales_incorrectas()
    {
        $user = User::create([
            'name' => 'Nombre de Usuario2',
            'email' => 'usuario@example2.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);

        $response = $this->post('/login', [
            'email' => 'usuario@example2.com',
            'password' => 'contrasenaincorrecta', 
        ]);


      


        $response->assertSessionHasErrors('email');


        $response->assertRedirect('/');

 
        $this->assertGuest();
    }

    public function test_ingresar_sin_email()
    {
        $response = $this->post('/login', [
            'email' => '',
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors('email');
        $response->assertRedirect('/');
        $this->assertGuest();
    }

    public function test_ingresar_sin_contrasena()
    {
        $response = $this->post('/login', [
            'email' => 'usuario@example.com',
            'password' => '', 
        ]);

        
        $response->assertSessionHasErrors('password');
        $response->assertRedirect('/');
        $this->assertGuest();
    }

    public function test_verificar_la_redirección_correcta()
    {
      
        $user = User::create([
            'name' => 'Nombre de Usuario3',
            'email' => 'usuario@example3.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password', 
        ]);

 
        $response->assertRedirect('/home'); 

  
        $this->assertAuthenticatedAs($user);
    }

    public function test_verificar_que_un_usuario_no_pueda_acceder_a_una_página_protegida()
    {
        $response = $this->get('/home'); 
  
        $response->assertRedirect('/login'); 

        $this->assertGuest();
    }

    public function test_verificar_que_un_usuario_autenticado_pueda_acceder_a_una_página_protegida()
    {
        $user = User::create([
            'name' => 'Nombre de Usuario3',
            'email' => 'usuario@example3.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);

    
        $this->actingAs($user);

        $response = $this->get('/home'); 
    
        $response->assertViewIs('index'); // Ajusta el nombre de la vista según tu aplicación
    }

    public function test_verificar_que_un_usuario_pueda_cerrar_sesión()
    {
        $user = User::create([
            'name' => 'Nombre de Usuario3',
            'email' => 'usuario@example3.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);

    
        $this->actingAs($user);

        $response = $this->get('/CerrarSesión'); 

  
        $response->assertRedirect('/login'); 


        $this->assertGuest();
    }

    public function test_unauthenticated_user_cannot_access_protected_page()
    {
        $response = $this->get('/home'); 

        $response->assertRedirect('/login'); 

     
        $this->assertGuest();
    }

    //segunda entrega de testing

    public function test_administrador_puede_entrar_a_lista_de_usuarios()
    {
       
        $adminUser = User::create([
            'name' => 'Nombre de Usuario3',
            'email' => 'usuario@example3.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Administrador', 
        ]);

    
        $this->actingAs($adminUser);

        $response = $this->get('/listaUsuarios'); 

       
        $response->assertViewIs('auth.Usuarios');
    }

    public function test_usuarionormal_puede_entrar_a_listadeUsuarios()
    {
   
        $regularUser = User::create([
            'name' => 'Nombre de Usuario3',
            'email' => 'usuario@example3.com',
            'password' => bcrypt('password'),
            'address' => 'Dirección de Prueba',
            'telephone' => '12345678',
            'imagen' => 'ruta_de_imagen.jpg',
            'is_default' => 'Usuario', 
        ]);

      
        $this->actingAs($regularUser);

        $response = $this->get('/listaUsuarios'); 

       
        $response->assertStatus(403); 
    }

    public function test_inyeccion_sql()
    {
        $response = $this->get('/some-route?id=1 OR 1=1'); 

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_ataque_xss()
    {
        $response = $this->get('/some-route?input=<script>alert("XSS")</script>'); // Intenta un ataque XSS

        // Verifica que el script malicioso no se ejecute y la seguridad no se comprometa
        $response->assertDontSee('<script>alert("XSS")</script>');
    }

    




}

