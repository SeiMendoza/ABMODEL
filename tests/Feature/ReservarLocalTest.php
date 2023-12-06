<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\reservacion_total;
use App\Models\User;

class ReservarLocalTest extends TestCase
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

    public function test_ingresar_cliente()
    {
        $response = $this->get('/cliente/reservaLocal');
        $response->assertStatus(302);
    }
    //2
    public function test_ingresar_cliente_para_reservar()
    {
        $response = $this->get('/cliente/reservaLocal');
        $response->assertRedirect('/login');
    }
    //3
    public function test_ingresar_cliente_logueado()
    {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->get('/cliente/reservaLocal');
        
        $response->assertStatus(302);
    }
    //4
  
    public function test_Reservacion_local_1()
    {
        $response = $this->actingAs(User::find(1))->get('/cliente/reservaLocal');
        $response->assertSee('Resrvaccion del Local');
    }
    //5
    public function test_Reservacion_local_2()
    {
        $response = $this->actingAs(User::find(1))->get('/cliente/reservaLocal');
        $response->assertSee('N');
    }

    //6
    public function test_Reservacion_local_vista3()
    {
       $response = $this->actingAs(User::find(1))->get('/cliente/reservaLocal');
       $response->assertSee('Cliente');
    }
    //7
    public function test_Reservacion_local_4()
    {
        $response = $this->actingAs(User::find(1))->get('/cliente/reservaLocal');
        $response->assertSee('Celular');
    }
    //8
    public function test_Reservacion_local_5()
    {
        $response = $this->actingAs(User::find(1))->get('/cliente/reservaLocal');
        $response->assertSee('Fecha');
    }
      //9
      public function test_Reservacion_local_6()
      {
          $response = $this->actingAs(User::find(1))->get('/cliente/reservaLocal');
          $response->assertSee('Total');
      }
    //10
    public function test_Reservacion_local_7()
    {
        $response = $this->actingAs(User::find(1))->get('/cliente/reservaLocal');
        $response->assertSee('Pendiente');
    }
      //11
      public function test_Reservacion_local_8()
      {
          $response = $this->actingAs(User::find(1))->get('/cliente/reservaLocal');
          $response->assertSee('Realizada');
      }
        //12
    public function test_Reservacion_local_9()
    {
        $response = $this->actingAs(User::find(1))->get('/cliente/reservaLocal');
        $response->assertSee('Detalles');
    }
      //13
      public function test_Reservacion_local_10()
      {
          $response = $this->actingAs(User::find(1))->get('/cliente/reservaLocal');
          $response->assertSee('Editar');
      }
        //14
    public function test_Reservacion_local_11()
    {
        $response = $this->actingAs(User::find(1))->get('/cliente/reservaLocal');
        $response->assertSee('Buscar:');
    }
   //-----------------------------------------------------------------------------------------------------------------
   
    //15
    public function test_Reservacion_local_create1()
    {
        $response = $this->get('ReserLocal.create');
        $response->assertStatus(302);
    }
    //16
    public function test_nueva_Reservacion_local_login()
    {
        $response = $this->get('ReserLocal.create');
        $response->assertRedirect('/login');
    }
      //17
      public function test_nueva_Reservacion_local_logueado()
      {
          $user = User::find(1);
      
          $response = $this->actingAs($user)->get('ReserLocal.create');
          
          $response->assertStatus(200);
      }
    //18
    public function test_nueva_Reservacion_local_create1()
    {
        $response = $this->actingAs(User::find(1))->get('ReserLocal.create');
        $response->assertSee('Nueva Reservacion del Local');
    }
  
    //12
   public function test_nueva_Reservacion_local_create2()
    {
      $response = $this->actingAs(User::find(1))->get('ReserLocal.create');
      $response->assertSee('Datos del cliente:');
    }
   //13
    public function test_nueva_Reservacion_local_create3()
    {
        $response = $this->actingAs(User::find(1))->get('ReserLocal.create');
        $response->assertSee('Nombre:');
    }
     //14
     public function test_nueva_Reservacion_local_create4()
     {
         $response = $this->actingAs(User::find(1))->get('ReserLocal.create');
         $response->assertSee('Apellido:');
     }
      //13
    public function test_nueva_Reservacion_local_create5()
    {
        $response = $this->actingAs(User::find(1))->get('ReserLocal.create');
        $response->assertSee('Celular:');
    }
     //14
     public function test_nueva_Reservacion_local_create6()
     {
         $response = $this->actingAs(User::find(1))->get('ReserLocal.create');
         $response->assertSee('Datos de la reservacion:');
     }
      //15
    public function test_nueva_Reservacion_local_create7()
    {
        $response = $this->actingAs(User::find(1))->get('ReserLocal.create');
        $response->assertSee('Tipo de Reservación:');
    }
    //16
    public function test_nueva_Reservacion_local_create8()
    {
        $response = $this->actingAs(User::find(1))->get('ReserLocal.create');
        $response->assertSee('Evento:');
    }
    //17
    public function test_nueva_Reservacion_local_create9()
    {
        $response = $this->actingAs(User::find(1))->get('ReserLocal.create');
        $response->assertSee('Cantidad de Personas:');
    }
    //18
    public function test_nueva_Reservacion_local_create10()
    {
        $response = $this->actingAs(User::find(1))->get('ReserLocal.create');
        $response->assertSee('Fecha del Evento:');
    }
       //19
       public function test_nueva_Reservacion_local_create11()
       {
           $response = $this->actingAs(User::find(1))->get('ReserLocal.create');
           $response->assertSee('Hora de llegada:');
       }
          //20
    public function test_nueva_Reservacion_local_create00()
    {
        $response = $this->actingAs(User::find(1))->get('ReserLocal.create');
        $response->assertSee('Hora de Salida:');
    }
       //21
       public function test_nueva_Reservacion_local_create12()
       {
           $response = $this->actingAs(User::find(1))->get('ReserLocal.create');
           $response->assertSee('Costo de la Reservacion:');
       }
          //22
    public function test_nueva_Reservacion_local_create13()
    {
        $response = $this->actingAs(User::find(1))->get('ReserLocal.create');
        $response->assertSee('Costo de la reservacion:');
    }
       //23
       public function test_nueva_Reservacion_local_create14()
       {
           $response = $this->actingAs(User::find(1))->get('ReserLocal.create');
           $response->assertSee('Forma de Pago:');
       }
          //24
    public function test_nueva_Reservacion_local_create15()
    {
        $response = $this->actingAs(User::find(1))->get('ReserLocal.create');
        $response->assertSee('Pago anticipado:');
    }
       //25
       public function test_nueva_Reservacion_local_create16()
       {
           $response = $this->actingAs(User::find(1))->get('ReserLocal.create');
           $response->assertSee('Saldo Pendiente:');
       }
          //26
    public function test_nueva_Reservacion_local_create17()
    {
        $response = $this->actingAs(User::find(1))->get('ReserLocal.create');
        $response->assertSee('Guardar');
    }
    //------------------------------------------------------------------------------------------------------------------------

    //16
public function test_editar_Reservacion_local__sin_usuario1()
{
    $response = $this->get('/ResCliente/1/editar');
    $response->assertStatus(302);
}
//17
public function test_editar_Reservacion_local_sin_usuario2()
{
    $response = $this->get('/ResCliente/1/editar');
    $response->assertRedirect('/login');
}
//18
public function test_editar_Reservacion_local_status_200_usuario3()
{
    $user = User::find(1);
    $this->actingAs($user);

    $response = $this->actingAs(User::find(1))->get('/ResCliente/1/editar');
    $response->assertStatus(200);
}
//19
public function test_editar_R_kiosko_ingresar_vista_4()
{

    $response = $this->actingAs(User::find(1))->get('/ResCliente/1/editar');
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






}
