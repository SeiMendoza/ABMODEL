<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Piscina;
use App\Models\PiscinaTipo;
use App\Models\PiscinaUso;
use App\Models\User;

class PiscinaProductoTest extends TestCase
{
    public function test_ingresarsinusuariologueado()
    {
        $response = $this->get('/productos');
        $response->assertStatus(302);
    }

    public function test_ingresaralusuarioallogin()
    {
        $response = $this->get('/productos');
        $response->assertRedirect('/login');
    }
    public function test_ingresar_usuariologueado()
    {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->get('/productos');
        
        $response->assertStatus(200);
    }

    public function test_ingresoplantilla_piscina()
    {

        $response = $this->actingAs(User::find(1))->get('/productos');
        $response->assertViewIs('Piscina.inventario.listaproductos');
    }
    
    public function test_ingresoLabel1()
    {
        $response = $this->actingAs(User::find(1))->get('/productos');
        $response->assertSee('Productos de piscina');
    }

    public function test_ingresoLabel2()
    {
        $response = $this->actingAs(User::find(1))->get('/productos');
        $response->assertSee('Tipo de producto');
    }

    public function test_ingresolabel3()
    {
        $response = $this->actingAs(User::find(1))->get('/productos');
        $response->assertSee('Cantidad');
    }

    public function test_ingresolabel4()
    {
        $response = $this->actingAs(User::find(1))->get('/productos');
        $response->assertSee('Producto');
    }

    public function test_nuevapiscinasinloguearse()
    {
        $response = $this->get('/piscina/create');
        $response->assertStatus(302);
    }

    public function test_nuevapiscinasinloguearseLogin()
    {
        $response = $this->get('/piscina/create');
        $response->assertRedirect('/login');
    }

    public function test_nuevapiscinalabel1()
    {
        $response = $this->actingAs(User::find(1))->get('/piscina/create');
        $response->assertSee('Datos del producto:');
    }

    public function test_nuevapiscinalogueado()
    {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->get('/piscina/create');
        
        $response->assertStatus(200);
    }

    public function test_nuevapiscinalabel2()
    {
        $response = $this->actingAs(User::find(1))->get('/piscina/create');
        $response->assertSee('Tipo de producto:');
    }

    public function test_nuevapiscinalabel3()
    {
        $response = $this->actingAs(User::find(1))->get('/piscina/create');
        $response->assertSee('Tipo de uso:');
    }

    public function test_nuevapiscinavista()
    {

        $response = $this->actingAs(User::find(1))->get('/piscina/create');
        $response->assertViewIs('Piscina.registrarPiscina');
    }
//debe de autenticarse
    public function test_create_exitosamente()
    {
      
        $tipoExistente = PiscinaTipo::first();
        $usoExistente = PiscinaUso::first();

     
        $piscina = Piscina::create([
            'nombre' => 'Piscina de Prueba',
            'peso'=>'100.00',
            'tipo' => $tipoExistente->id,
            'uso' => $usoExistente->id,
        ]);

       
        $this->assertDatabaseHas('piscinas', [
            'nombre' => 'Piscina de Prueba',
            'peso'=>'100.00',
            'tipo' => $tipoExistente->id,
            'uso' => $usoExistente->id,
        ]);
    }
// debe de autenticarse
    public function test_create_con_nombre_invalido()
{
    $tipoExistente = PiscinaTipo::first();
    $usoExistente = PiscinaUso::first();

    
    $response = $this->post('/piscina/create', [
        'nombre' => '',
        'peso' => '100.00',
        'tipo' => $tipoExistente->id,
        'uso' => $usoExistente->id,
    ]);

    $response->assertSessionHasErrors(['nombre']);
}
// debe de autenticarse
public function test_create_con_peso_invalido()
{
    $tipoExistente = PiscinaTipo::first();
    $usoExistente = PiscinaUso::first();

    
    $response = $this->post('/piscina/create', [
        'nombre' => 'Piscina de Prueba',
        'peso' => '',
        'tipo' => $tipoExistente->id,
        'uso' => $usoExistente->id,
    ]);

    $response->assertSessionHasErrors(['peso']);
}
// debe de autenticarse
public function test_create_con_tipo_invalido()
{
    $tipoExistente = PiscinaTipo::first();
    $usoExistente = PiscinaUso::first();

    
    $response = $this->post('/piscina/create', [
        'nombre' => 'Piscina de Prueba',
        'peso' => '100.00',
        'tipo' => '',
        'uso' => $usoExistente->id,
    ]);

    $response->assertSessionHasErrors(['tipo']);
}
// debe de autenticarse
public function test_create_con_uso_invalido()
{
    $tipoExistente = PiscinaTipo::first();
    $usoExistente = PiscinaUso::first();

    
    $response = $this->post('/piscina/create', [
        'nombre' => '',
        'peso' => '100.00',
        'tipo' => $tipoExistente->id,
        'uso' => $usoExistente->id,
    ]);

    $response->assertSessionHasErrors(['uso']);
}

//editar

public function test_editar_piscina_in_sin_usuario_logueado_1()
    {
        $response = $this->get('/piscina/1/editar');
        $response->assertStatus(302);
    }

    public function test_editar_piscina_in_sin_usuario_logueado_2()
    {
        $response = $this->get('/piscina/1/editar');
        $response->assertRedirect('/login');
    }

    public function test_editar_piscina_status_200_usuario_logueado_3()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->actingAs(User::find(1))->get('/piscina/1/editar');
        $response->assertStatus(200);
    }

    public function test_editar_piscina_ingresar_vista_4()
    {

        $response = $this->actingAs(User::find(1))->get('/piscina/1/editar');
        $response->assertViewIs('Piscina.inventario.editarproductop');
    }

    public function test_editar_piscina__label_1()
    {
        $response = $this->actingAs(User::find(1))->get('/piscina/1/editar');
        $response->assertSee('Nombre del productos:');// es producto comprobar en vista
    }

    public function test_editar_piscina__label_2()
    {
        $response = $this->actingAs(User::find(1))->get('/piscina/1/editar');
        $response->assertSee('Tipo de productos:');// es producto comprobar en vista
    }

    public function test_editar_piscina__label_3()
    {
        $response = $this->actingAs(User::find(1))->get('/piscina/1/editar');
        $response->assertSee('Tipo de uso:');
    }

    public function test_editar_piscina__label_4()
    {
        $response = $this->actingAs(User::find(1))->get('/piscina/1/editar');
        $response->assertSee('ingrese el peso:');// es Ingrese comprobar en vista
    }
//debe de autenticarse para actualizar
    public function test_editar_exitosamente()
{
    
    $piscinaExistente = Piscina::first();

    
    $response = $this->put("/piscina/{$piscinaExistente->id}/editar", [
        'nombre' => 'Nuevo Nombre',
        'peso' => '200.00',  
        'tipo' => $piscinaExistente->tipo,
        'uso' => $piscinaExistente->uso,
    ]);

    
    $response->assertSessionDoesntHaveErrors();

    
    $this->assertDatabaseHas('piscinas', [
        'id' => $piscinaExistente->id,
        'nombre' => 'Nuevo Nombre',
        'peso' => '200.00',
        'tipo' => $piscinaExistente->tipo,
        'uso' => $piscinaExistente->uso,
    ]);
}
// el usuario no esta autenticado por que no puede realizar la actualización
public function test_editar_invalido_nombre()
{
    // Autenticar un usuario
    $user = User::factory()->create();
    $this->actingAs($user);
    $piscinaExistente = Piscina::first();

    
    $response = $this->put("/piscina/{$piscinaExistente->id}/editar", [
        'nombre' => '',
        'peso' => '200.00',  
        'tipo' => $piscinaExistente->tipo,
        'uso' => $piscinaExistente->uso,
    ]);

    $response->assertSessionHasErrors(['nombre']);
    
}
// el usuario no esta autenticado por que no puede realizar la actualización
public function test_editar_invalido_Peso()
{
    
    $piscinaExistente = Piscina::first();

    
    $response = $this->put("/piscina/{$piscinaExistente->id}/editar", [
        'nombre' => 'Nuevo nombre',
        'peso' => '',  
        'tipo' => $piscinaExistente->tipo,
        'uso' => $piscinaExistente->uso,
    ]);

    $response->assertSessionHasErrors(['Peso']); // input es kilos
    
}
// el usuario no esta autenticado por que no puede realizar la actualización
public function test_editar_invalido_Tipo()
{
    
    $piscinaExistente = Piscina::first();

    
    $response = $this->put("/piscina/{$piscinaExistente->id}/editar", [
        'nombre' => 'Nuevo nombre',
        'peso' => '200.00',  
        'tipo' => '',
        'uso' => $piscinaExistente->uso,
    ]);

    $response->assertSessionHasErrors(['Tipo']); // en minuscula 
    
}
// el usuario no esta autenticado por que no puede realizar la actualización
public function test_editar_invalido_uso()
{  
    $piscinaExistente = Piscina::first();

    
    $response = $this->put("/piscina/{$piscinaExistente->id}/editar", [
        'nombre' => 'Nuevo nombre',
        'peso' => '200.00',  
        'tipo' => $piscinaExistente->tipo,
        'uso' => '',
    ]);

    $response->assertSessionHasErrors(['uso']);
    
}

//eliminar
// el usuario no esta autenticado y no puede eliminar
public function test_eliminar_exitosamente()
{
     $piscinaExistente = Piscina::first();

   
    $response = $this->delete("/piscina/{$piscinaExistente->id}/borrar");

    
    $response->assertSessionDoesntHaveErrors();

    
    $this->assertDatabaseMissing('piscinas', ['id' => $piscinaExistente->id]);
}

//Ver








}
