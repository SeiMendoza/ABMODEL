<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Kiosko;
use App\Models\User;

class KioskoTest extends TestCase
{
    public function test_kioskos_ingresar_sin_usuariolog()
    {
        $response = $this->get('/kioskos');
        $response->assertStatus(302);
    }

    public function test_kioskos_redireccional_log()
    {
        $response = $this->get('/kioskos');
        $response->assertRedirect('/login');
    }

    public function test_kioskos_usuariologueado()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->actingAs(User::find(1))->get('/kioskos');
        $response->assertStatus(200);
    }

    public function test_kiosko_ingresar_vista()
    {

        $response = $this->actingAs(User::find(1))->get('/kioskos');
        $response->assertViewIs('.Reservaciones.ReserAdmon.Kioskos.indexKioskos');
    }


    public function test_kioskos_comprobar_label1()
    {
        $response = $this->actingAs(User::find(1))->get('/kioskos');
        $response->assertSee('Código');
    }

    public function test_kioskos_comprobar_label2()
    {
        $response = $this->actingAs(User::find(1))->get('/kioskos');
        $response->assertSee('Ubicación');
    }

    public function test_kioskos_comprobar_label3()
    {
        $response = $this->actingAs(User::find(1))->get('/kioskos');
        $response->assertSee('Reservaciones');
    }

    public function test_kioskos_comprobar_label4()
    {
        $response = $this->actingAs(User::find(1))->get('/kioskos');
        $response->assertSee('Detalle');
    }

    //create

    public function test_kioskos_create_ingresar_sin_usuariolog()
    {
        $response = $this->get('/kioskos/create');
        $response->assertStatus(302);
    }

    public function test_kioskos_Create_redireccional_log()
    {
        $response = $this->get('/kioskos/create');
        $response->assertRedirect('/login');
    }

    public function test_kioskos_create_usuariologueado()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->actingAs(User::find(1))->get('/kioskos/create');
        $response->assertStatus(200);
    }

    public function test_kiosko_create_ingresar_vista()
    {

        $response = $this->actingAs(User::find(1))->get('/kioskos/create');
        $response->assertViewIs('.Reservaciones.ReserAdmon.Kioskos.registroKioskos');
    }

    public function test_kioskos_create_comprobar_label1()
    {
        $response = $this->actingAs(User::find(1))->get('/kioskos/create');
        $response->assertSee('Código');
    }

    public function test_kioskos_create_comprobar_label2()
    {
        $response = $this->actingAs(User::find(1))->get('/kioskos/create');
        $response->assertSee('Descripcion');
    }

    public function test_kioskos_create_comprobar_label3()
    {
        $response = $this->actingAs(User::find(1))->get('/kioskos/create');
        $response->assertSee('Ubicacion');
    }

    public function test_create_kiosko_exitosa()
    {
        
        $archivoImagen = UploadedFile::fake()->image('imagen.jpg');

        // Datos de ejemplo
        $datosKiosko = [
            'codigo' => 'codigo123',
            'descripcion' => 'Descripción del kiosko',
            'cantidad_de_Mesas' => 5,
            'ubicacion' => 'Ubicación del kiosko',
            'imagen' => $archivoImagen,
        ];

      
        $respuesta = $this->post('/kioskos/create', $datosKiosko);

       
        $respuesta->assertStatus(201);

    
        $this->assertDatabaseHas('kioskos', [
            'codigo' => 'codigo123',
            'descripcion' => 'Descripción del kiosko',
            'cantidad_de_Mesas' => 5,
            'ubicacion' => 'Ubicación del kiosko',
            'imagen' => $archivoImagen->hashName(),
        ]);


        Storage::disk('public')->assertExists('kiosko-imagenes/' . $archivoImagen->hashName());

      
    }

    public function test_el_campo_codigo_es_obligatorio()
    {
        $respuesta = $this->post('/kioskos/create', ['codigo' => '']);
        $respuesta->assertSessionHasErrors('codigo');
    }

    public function test_el_campo_codigo_debe_ser_unico_en_la_tabla_kioskos()
    {
      
        Kiosko::create([
            'codigo' => 'K01',
            'descripcion' => 'Descripción del kiosko',
            'cantidad_de_Mesas' => 5,
            'ubicacion' => 'Ubicación del kiosko',
            'imagen' => UploadedFile::fake()->image('imagen.jpg'),
        ]);

       
        $respuesta = $this->post('/kioskos/create', ['codigo' => 'K01']);
        $respuesta->assertSessionHasErrors('codigo');
    }

    public function test_el_campo_codigo_debe_seguir_el_patron_especifico()
    {
     
        $respuesta = $this->post('/kioskos/create', ['codigo' => 'C123']);
        $respuesta->assertSessionHasErrors('codigo');
    }

    public function test_el_campo_codigo_debe_tener_longitud_entre_minimo_y_maximo()
    {
        
        $respuesta = $this->post('/kioskos/create', ['codigo' => 'K1']);
        $respuesta->assertSessionHasErrors('codigo');

      
        $respuesta = $this->post('/kioskos/create', ['codigo' => 'K1234']);
        $respuesta->assertSessionHasErrors('codigo');
    }

    public function test_el_campo_descripcion_es_obligatorio()
    {
        $respuesta = $this->post('/kioskos/create', ['descripcion' => '']);
        $respuesta->assertSessionHasErrors('descripcion');
    }

    public function test_el_campo_descripcion_debe_tener_una_longitud_minima()
    {
        $respuesta = $this->post('/kioskos/create', ['descripcion' => 'Desc']);
        $respuesta->assertSessionHasErrors('descripcion');
    }

    public function test_el_campo_descripcion_debe_tener_una_longitud_maxima()
    {
        $respuesta = $this->post('/kioskos/create', ['descripcion' => str_repeat('A', 101)]);
        $respuesta->assertSessionHasErrors('descripcion');
    }

    public function test_la_descripcion_puede_tener_longitud_entre_minimo_y_maximo()
    {
        $respuesta = $this->post('/kioskos/create', ['descripcion' => str_repeat('A', 50)]);
        $respuesta->assertSessionDoesntHaveErrors('descripcion');
    }

    public function test_el_campo_ubicacion_es_obligatorio()
    {
        $respuesta = $this->post('/kioskos/create', ['ubicacion' => '']);
        $respuesta->assertSessionHasErrors('ubicacion');
    }

    public function testel_campo_ubicacion_debe_tener_una_longitud_minima()
    {
        $respuesta = $this->post('/kioskos/create', ['ubicacion' => 'Ub']);
        $respuesta->assertSessionHasErrors('ubicacion');
    }

    public function test_el_campo_ubicacion_debe_tener_una_longitud_maxima()
    {
        $respuesta = $this->post('/kioskos/create', ['ubicacion' => str_repeat('A', 101)]);
        $respuesta->assertSessionHasErrors('ubicacion');
    }

    public function la_ubicacion_puede_tener_longitud_entre_minimo_y_maximo()
    {
        $respuesta = $this->post('/kioskos/create', ['ubicacion' => str_repeat('A', 50)]);
        $respuesta->assertSessionDoesntHaveErrors('ubicacion');
    }








    


}
