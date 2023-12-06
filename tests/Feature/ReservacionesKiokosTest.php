<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Kiosko;
use App\Models\KioskoReservacion;
use App\Models\User;
use App\Models\Mesa;
use App\Models\Reservacion;
use Carbon\Carbon;

class ReservacionesKiokosTest extends TestCase
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
    public function test_ingresar_usuario()
    {
        $response = $this->get('/kioskos');
        $response->assertStatus(302);
    }
    //2
    public function test_ingresar_al_usuario_al_login()
    {
        $response = $this->get('/kioskos');
        $response->assertRedirect('/login');
    }
    //3
    public function test_ingresar_usuario_logueado()
    {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->get('/kioskos');
        
        $response->assertStatus(200);
    }
    //4
  
    public function test_R_kiosko_vista1()
    {
        $response = $this->actingAs(User::find(1))->get('/kioskos');
        $response->assertSee('Listado de Kioskos');
    }
    //5
    public function test_R_kiosko_vista2()
    {
        $response = $this->actingAs(User::find(1))->get('/kioskos');
        $response->assertSee('Código');
    }

    //6
    public function test_R_kiosko_vista3()
    {
       $response = $this->actingAs(User::find(1))->get('/kioskos');
       $response->assertSee('Ubicación');
    }
    //7
    public function test_R_kiosko_vista4()
    {
        $response = $this->actingAs(User::find(1))->get('/kioskos');
        $response->assertSee('Reservaciones');
    }
  


    //8
    public function test_R_kiosko_create()
    {
        $response = $this->get('/kioskos/create');
        $response->assertStatus(302);
    }
    //9
    public function test_nuevo_R_kiosko_login()
    {
        $response = $this->get('/s/create');
        $response->assertRedirect('/login');
    }
      //11
      public function test_nuevo_R_kiosko_logueado()
      {
          $user = User::find(1);
      
          $response = $this->actingAs($user)->get('/kioskos/create');
          
          $response->assertStatus(200);
      }
    //10
    public function test_nuevo_R_kiosko_vista1()
    {
        $response = $this->actingAs(User::find(1))->get('/kioskos/create');
        $response->assertSee('Datos del kiosko');
    }
  
    //12
   public function test_nuevo_R_kiosko_vista2()
    {
      $response = $this->actingAs(User::find(1))->get('/kioskos/create');
      $response->assertSee('Seleccionar imagen');
    }
   //13
    public function test_nuevo_R_kiosko_vista3()
    {
        $response = $this->actingAs(User::find(1))->get('/kioskos/create');
        $response->assertSee('Descripcion');
    }

    //14
    public function test_nuevo_R_kiosko_vista4()
    {
        $response = $this->actingAs(User::find(1))->get('/kioskos/create');
        $response->assertSee('Ubicación');
    }
    


    //15
    public function test_nuevo_R_kiosko_vista()
    {

        $response = $this->actingAs(User::find(1))->get('/kioskos/create');
        $response->assertViewIs('.Reservaciones.ReserAdmon.Kioskos.registroKioskos');
    }

    //16
public function test_editar_R_kiosko__sin_usuario1()
{
    $response = $this->get('/kiosko/1/edit');
    $response->assertStatus(302);
}
//17
public function test_editar_R_kiosko_sin_usuario2()
{
    $response = $this->get('/kiosko/1/edit');
    $response->assertRedirect('/login');
}
//18
public function test_editar_R_kiosko_status_200_usuario3()
{
    $user = User::find(1);
    $this->actingAs($user);

    $response = $this->actingAs(User::find(1))->get('/kiosko/1/edit');
    $response->assertStatus(200);
}
//19
public function test_editar_R_kiosko_ingresar_vista_4()
{

    $response = $this->actingAs(User::find(1))->get('/kiosko/1/edit');
    $response->assertViewIs('Reservaciones.ReserAdmon.Kioskos.edicionKioskos');
}
//20
public function test_editar_R_kiosko__vista1()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko/1/edit');
    $response->assertSee('Edición de kiosko');
}
//21
public function test_editar_R_kiosko__vista0()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko/1/edit');
    $response->assertSee('Datos del kiosko');
}
//22

public function test_editar_R_kiosko__vista3()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko/1/edit');
    $response->assertSee('Código');
}
//23
public function test_editar_R_kiosko__vista4()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko/1/edit');
    $response->assertSee('Descripción');
}
//24
public function test_editar_R_kiosko__vista5()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko/1/edit');
    $response->assertSee('Ubicación');
}
//----------------------------------------------------------------------------------------------------

  //1
  public function test_reservacion_index1()
  {
      $response = $this->get('/kiosko_res');
      $response->assertStatus(302);
  }

//2
public function test_reservacion_al_usuario_de_login()
{
    $response = $this->get('/kiosko_res');
    $response->assertRedirect('/login');
}
//3
public function test_reservacion_usuario_logueado()
{
    $user = User::find(1);

    $response = $this->actingAs($user)->get('/kiosko_res');
    
    $response->assertStatus(302);
}
//4

public function test_reservacion_tabla1()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res');
    $response->assertDontSee('Reservaciones de kioskos');
}
//5
public function test_reservacion_tablav1()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res');
    $response->assertDontSeeText('N');
}
//6
public function test_reservacion_tablav2()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res');
    $response->assertDontSeeText('Cliente');
}
//7
public function test_reservacion_tablav3()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res');
    $response->assertDontSeeText('Celular');
}
//8
public function test_reservacion_tablav4()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res');
    $response->assertDontSeeText('Personas');
}
//9
public function test_reservacion_tablav5()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res');
    $response->assertDontSeeText('Fecha');
}
//10
public function test_reservacion_tablav6()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res');
    $response->assertDontSeeText('Kiosko');
}
//11
public function test_reservacion_tablav7()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res');
    $response->assertDontSeeText('Pendiente');
}
//12
public function test_reservacion_tablav8()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res');
    $response->assertDontSeeText('Realizada');
}
//13
public function test_reservacion_tablav9()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res');
    $response->assertDontSeeText('Detalle');
}
//14
public function test_reservacion_tablav10()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res');
    $response->assertDontSeeText('Editar');
}
//15
public function test_reservacion_tablav11()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res');
    $response->assertDontSeeText('Eliminar');
}
//16
public function test_reservacion_v12()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res');
    $response->assertDontSeeText('Terminadas');
}
//17
public function test_reservacion_v13()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res');
    $response->assertDontSeeText('Agregadas');
}
//18
    public function test_reservaciones_create()
    {
        $response = $this->get('/kiosko_res/create');
        $response->assertStatus(302);
    }
//19
    public function test_nueva_reservacion_login()
    {
        $response = $this->get('/kiosko_res/create');
        $response->assertRedirect('/login');
    }
//20
      public function test_nueva_reservacion_logueado()
      {
          $user = User::find(1);
      
          $response = $this->actingAs($user)->get('/kiosko_res/create');
          
          $response->assertStatus(302);
      }
//21
    public function test_nuevo_kiosko_agreagr1()
    {
        $response = $this->actingAs(User::find(1))->get('/kiosko_res/create');
        $response->assertDontSeeText('Datos del cliente:');
    }
  
//22
   public function test_reservacion_kiosko_agregar2()
    {
      $response = $this->actingAs(User::find(1))->get('/kiosko_res/create');
      $response->assertDontSee('Nombre:');
    }
//23
    public function test_reservacion_kiosko_agregar3()
    {
        $response = $this->actingAs(User::find(1))->get('/kiosko_res/create');
        $response->assertDontSee('Celular:');
    }

//24
    public function test_reservacion_kiosko_agregar4()
    {
        $response = $this->actingAs(User::find(1))->get('/kiosko_res/create');
        $response->assertDontSee('Datos de la reservacion:');
    }
    
//25
    public function test_reservacion_kiosko_agregar5()
    {

        $response = $this->actingAs(User::find(1))->get('/kiosko_res/create');
        $response->assertDontSee('Fecha:');
    }
//26
public function test_reservacion_kiosko_agregar6()
{

    $response = $this->actingAs(User::find(1))->get('/kiosko_res/create');
    $response->assertDontSee('Hora de inicio');
}
//25
public function test_reservacion_kiosko_agregar7()
{

    $response = $this->actingAs(User::find(1))->get('/kiosko_res/create');
    $response->assertDontSee('Hora de salida');
}
//27
public function test_reservacion_kiosko_agregar8()
{

    $response = $this->actingAs(User::find(1))->get('/kiosko_res/create');
    $response->assertDontSee('Evento:');
}
//28
public function test_reservacion_kiosko_agregar9()
{

    $response = $this->actingAs(User::find(1))->get('/kiosko_res/create');
    $response->assertDontSee('Kiosko a reservar:');
}
//29
public function test_reservacion_kiosko_agregar10()
{

    $response = $this->actingAs(User::find(1))->get('/kiosko_res/create');
    $response->assertDontSee('Costo de la reservacion:');
}
//30
public function test_reservacion_kiosko_agregar11()
{

    $response = $this->actingAs(User::find(1))->get('/kiosko_res/create');
    $response->assertDontSee('Cantidad de niños:');
}
//31
public function test_reservacion_kiosko_agregar12()
{

    $response = $this->actingAs(User::find(1))->get('/kiosko_res/create');
    $response->assertDontSee('Precio para niños:');
}
//32
public function test_reservacion_kiosko_agregar13()
{

    $response = $this->actingAs(User::find(1))->get('/kiosko_res/create');
    $response->assertDontSee('Cantidad de Adultos:');
}
//33
public function test_reservacion_kiosko_agregar14()
{

    $response = $this->actingAs(User::find(1))->get('/kiosko_res/create');
    $response->assertDontSee('Precio para adultos:');
}
//34
public function test_reservacion_kiosko_agregar15()
{

    $response = $this->actingAs(User::find(1))->get('/kiosko_res/create');
    $response->assertDontSee('Total:');
}
//35
public function test_reservacion_kiosko_agregar16()
{

    $response = $this->actingAs(User::find(1))->get('/kiosko_res/create');
    $response->assertDontSee('Pago anticipado:');
}
//36
public function test_reservacion_kiosko_agregar17()
{

    $response = $this->actingAs(User::find(1))->get('/kiosko_res/create');
    $response->assertDontSee('Pago pendiente:');
}
//37
public function test_reservacion_kiosko_agregar18()
{

    $response = $this->actingAs(User::find(1))->get('/kiosko_res/create');
    $response->assertDontSee('Forma de Pago:');
}
//38
public function test_reservacion_kiosko_agregar19()
{

    $response = $this->actingAs(User::find(1))->get('/kiosko_res/create');
    $response->assertDontSee('Cancelar');
}
//39
public function test_reservacion_kiosko_agregar20()
{

    $response = $this->actingAs(User::find(1))->get('/kiosko_res/create');
    $response->assertDontSee('Guardar');
}
//40
public function test_reservacion_kiosko_agregar21()
{

    $response = $this->actingAs(User::find(1))->get('/kiosko_res/create');
    $response->assertDontSee('Regresar');
}

//------------------------------------------------------------------------------------------------------------------
  //41
  public function test_editar_reservacion_kiosko__sin_usuario1()
  {
      $response = $this->get('/kiosko_res/1/edit');
      $response->assertStatus(302);
  }
  //17
  public function test_editar_reservacion_kiosko_sin_usuario2()
  {
      $response = $this->get('/kiosko_res/1/edit');
      $response->assertRedirect('/login');
  }
  //18
  public function test_editar_kiosko_reservacion_status_200_usuario3()
  {
      $user = User::find(1);
      $this->actingAs($user);
  
      $response = $this->actingAs(User::find(1))->get('/kiosko_res/1/edit');
      $response->assertStatus(302);
  }
  //19
  public function test_editar_reservacion_kiosko_ingresar_vista_4()
  {
  
      $response = $this->actingAs(User::find(1))->get('/kiosko_res/1/edit');
      $response->assertViewIs('Reservaciones.ReserAdmon.Quiosco.editarReservaciones');
  }
  public function test_editar_reservacion_kiosko__vista1()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res/1/edit');
    $response->assertSee('Edición de la reservacion');
}
//21
public function test_editar_reservacion_kiosko__vista2()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res/1/edit');
    $response->assertSee('Datos del cliente');
}
//22

public function test_editar_reservacion_kiosko__3()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res/1/edit');
    $response->assertSee('Nombre:');
}
//23
public function test_editar_reservacion_kiosko__4()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res/1/edit');
    $response->assertSee('Celular:');
}
//24
public function test_editar_reservacion_kiosko__5()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res/1/edit');
    $response->assertSee('Datos de la reservación:');
}
//25
public function test_editar_reservacion_kiosko__6()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res/1/edit');
    $response->assertSee('Fecha:');
}
//26
public function test_editar_reservacion_kiosko__7()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res/1/edit');
    $response->assertSee('Hora de inicio');
}
//27
public function test_editar_reservacion_kiosko__8()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res/1/edit');
    $response->assertSee('Hora de saida');
}
//28
public function test_editar_reservacion_kiosko__9()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res/1/edit');
    $response->assertSee('Evento:');
}
//29
public function test_editar_reservacion_kiosko__10()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res/1/edit');
    $response->assertSee('Kiosko a reservar:');
}
//30
public function test_editar_reservacion_kiosko__11()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res/1/edit');
    $response->assertSee('Costo de la reservacion:');
}
//31
public function test_editar_reservacion_kiosko__12()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res/1/edit');
    $response->assertSee('Cantidad de niños:');
}
//32
public function test_editar_reservacion_kiosko__13()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res/1/edit');
    $response->assertSee('Precio para niños:');
}
//33
public function test_editar_reservacion_kiosko__14()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res/1/edit');
    $response->assertSee('Cantidad de Adultos:');
}
//34
public function test_editar_reservacion_kiosko__15()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res/1/edit');
    $response->assertSee('Precio para adultos:');
}
//35
public function test_editar_reservacion_kiosko__16()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res/1/edit');
    $response->assertSee('Total:');
}
//36
public function test_editar_reservacion_kiosko__17()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res/1/edit');
    $response->assertSee('Pago anticipado:');
}
//37
public function test_editar_reservacion_kiosko__18()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res/1/edit');
    $response->assertSee('Pago pendiente:');
}
//38
public function test_editar_reservacion_kiosko__19()
{
    $response = $this->actingAs(User::find(1))->get('/kiosko_res/1/edit');
    $response->assertSee('Forma de pago:');
}

public function test_buscar_reservacion_kiosko()
{
    $response = $this->actingAs(User::find(1))->get('kiosko_res/search');
    $response->assertViewIs('Buscar:');
}










}
