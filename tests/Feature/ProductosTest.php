<?php

namespace Tests\Feature;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductosTest extends TestCase
{
    use WithFaker;

    public function cargar_datos(){
        $producto = new Producto();
        $producto->nombre = 'Limón';
        $producto->descripcion = 'Refresco de Limón';
        $producto->precio = 20;
        $producto->tamanio = 'Grande';
        $producto->imagen = 'img/ProductosMenú/Limón.jpg';
        $producto->disponible = 15;
        $producto->estado = 1;
        $producto->tipo = 0;

        $producto->save();

        return [
            'id_producto' => $producto->id,
            'producto' => $producto,
        ];
    }

    public function eliminar_datos($var){
        Producto::find($var['id_producto'])->delete();
    }


    public function test_editar_producto_tipo_bebidas_ingresar_status_302_sin_usuario_logueado_1()
    {
        $var = $this->cargar_datos();
        $response = $this->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertStatus(302);
    }

    public function test_editar_producto_tipo_bebidas_ingresar_retorno_login_sin_usuario_logueado_2()
    {
        $var = $this->cargar_datos();
        $response = $this->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertRedirect('/login');
    }

    public function test_editar_producto_tipo_bebidas_ingresar_status_200_usuario_logueado_3()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertStatus(200);
    }

    public function test_editar_producto_tipo_bebidas_ingresar_vista_4()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertViewIs('Menu.Admon.edicion.editarComplemento');
    }

    public function test_editar_producto_tipo_bebidas_ingresar_vista_componentes_1_label_5()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertSee('Edición de Producto');
    }

    public function test_editar_producto_tipo_bebidas_ingresar_vista_componentes_2_label_6()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertSee('Tipo de producto:');
    }

    public function test_editar_producto_tipo_bebidas_ingresar_vista_componentes_3_label_7()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertSee('Tamaño:');
    }

    public function test_editar_producto_tipo_bebidas_ingresar_vista_componentes_4_label_8()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertSee('Nombre del producto:');
    }

    public function test_editar_producto_tipo_bebidas_ingresar_vista_componentes_5_label_9()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertSee('Precio:');
    }

    public function test_editar_producto_tipo_bebidas_ingresar_vista_componentes_6_label_10()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertSee('Descripción:');
    }

    public function test_editar_producto_tipo_bebidas_ingresar_vista_componentes_7_label_11()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertSee('Cantidad disponible:');
    }

    public function test_editar_producto_tipo_bebidas_ingresar_vista_componentes_8_label_12()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertSee('Cambiar imagen');
    }


    public function test_editar_producto_tipo_bebidas_ingresar_vista_componentes_1_place_holder_13()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertSee('Seleccione el tamaño');
    }

    public function test_editar_producto_tipo_bebidas_ingresar_vista_componentes_3_place_holder_14()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertSee('Ingrese el nombre del producto');
    }

    public function test_editar_producto_tipo_bebidas_ingresar_vista_componentes_4_place_holder_15()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertSee('Ingrese el precio');
    }

    public function test_editar_producto_tipo_bebidas_ingresar_vista_componentes_5_place_holder_16()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertSee('Ingrese la descripción');
    }

    public function test_editar_producto_tipo_bebidas_ingresar_vista_componentes_6_place_holder_17()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertSee('Ingrese la cantidad disponible');
    }

    public function test_editar_producto_tipo_bebidas_ingresar_vista_componentes_6_place_holder_18()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertSee('Ingrese la cantidad disponible');
    }

    public function test_editar_producto_tipo_bebidas_ingresar_vista_componentes_boton_regresar_19()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertSee('Regresar');
    }

    public function test_editar_producto_tipo_bebidas_ingresar_vista_componentes_boton_cancelar_20()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertSee('Cancelar');
    }

    public function test_editar_producto_tipo_bebidas_ingresar_vista_componentes_boton_guardar_21()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertSee('Actualizar');
    }


    public function test_editar_producto_tipo_bebidas_ingresar_vista_cargados_datos_correctos_tipo_producto_22()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertSee($var['producto']->tipo);
    }

    public function test_editar_producto_tipo_bebidas_ingresar_vista_cargados_datos_correctos_descripcion_23()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertSee($var['producto']->descripcion);
    }

    public function test_editar_producto_tipo_bebidas_ingresar_vista_cargados_datos_correctos_precio_24()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertSee($var['producto']->precio);
    }

    public function test_editar_producto_tipo_bebidas_ingresar_vista_cargados_datos_correctos_tamanio_25()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertSee($var['producto']->tamanio);
    }

    public function test_editar_producto_tipo_bebidas_ingresar_vista_cargados_datos_correctos_imagen_26()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertSee($var['producto']->imagen);
    }

    public function test_editar_producto_tipo_bebidas_ingresar_vista_cargados_datos_correctos_disponible_27()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertSee($var['producto']->disponible);
    }

    public function test_editar_producto_tipo_bebidas_ingresar_vista_cargados_datos_correctos_nombre_28()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/editar');
        $this->eliminar_datos($var);
        $response->assertSee($var['producto']->nombre);
    }

    public function test_activar_producto_correctamente_metodo_put_29()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->put('producto/'.$var['id_producto'].'/activar');
        $this->eliminar_datos($var);
        $response->assertSessionHas(['mensaje']);
    }

    public function test_activar_producto_con_id_desconocido_metodo_put_30()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->put('producto/'.$var['id_producto'].'/activar');
        $this->eliminar_datos($var);
        $response->assertStatus(302);
    }

    public function test_activar_producto_correctamente_metodo_get_31()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/activar');
        $this->eliminar_datos($var);
        $response->assertSessionHas(['mensaje']);
    }

    public function test_activar_producto_con_id_desconocido_metodo_get_32()
    {
        $var = $this->cargar_datos();
        $response = $this->actingAs(User::find(1))->get('producto/'.$var['id_producto'].'/activar');
        $this->eliminar_datos($var);
        $response->assertStatus(302);
    }


    public function test_update_producto_tipo_bebidas_con_datos_correctos_33()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('bebida/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Limón de Pasas',
            'descripcion' => 'Refresco de Limón',
            'precio' => 20,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 0,
        ]);

        $produc = Producto::find($var['id_producto']);

        $this->eliminar_datos($var);

        $response->assertSessionHas(['mensaje']);
        $this->assertTrue($produc->nombre == 'Limón de Pasas');
    }

    public function test_update_producto_tipo_bebidas_validacion_nombre_requerido_34()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('bebida/'.$var['id_producto'].'/edicion', [
            'nombre' => null,
            'descripcion' => 'Refresco de Limón',
            'precio' => 20,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 0,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'nombre' => 'El nombre no puede estar vacío',
        ]);
    }

    public function test_update_producto_tipo_bebidas_validacion_nombre_max_100_35()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('bebida/'.$var['id_producto'].'/edicion', [
            'nombre' => 'dasdasddddddddddddddddfsdfsdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffsdfsdfasdfffffffffffffffffffffffffffffffffffffffffffffffffffff',
            'descripcion' => 'Refresco de Limón',
            'precio' => 20,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 0,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'nombre' => 'El nombre es muy extenso',
        ]);
    }

    public function test_update_producto_tipo_bebidas_validacion_nombre_min_3_36()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('bebida/'.$var['id_producto'].'/edicion', [
            'nombre' => 'an',
            'descripcion' => 'Refresco de Limón',
            'precio' => 20,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 0,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'nombre' => 'El nombre es muy corto',
        ]);
    }

    public function test_update_producto_tipo_bebidas_validacion_nombre_solo_letras_37()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('bebida/'.$var['id_producto'].'/edicion', [
            'nombre' => 6435,
            'descripcion' => 'Refresco de Limón',
            'precio' => 20,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 0,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'nombre' => 'El nombre debe tener solo letras',
        ]);
    }

    public function test_update_producto_tipo_bebidas_validacion_tipo_requerido_38()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('bebida/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Limón de Pasas',
            'descripcion' => 'Refresco de Limón',
            'precio' => 20,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => null,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'tipo' => 'El tipo no puede estar vacío',
        ]);
    }

    public function test_update_producto_tipo_bebidas_validacion_descripcion_requerido_39()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('bebida/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Limón de Pasas',
            'descripcion' => null,
            'precio' => 20,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 0,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'descripcion' => 'La descripcion no puede estar vacío',
        ]);
    }

    public function test_update_producto_tipo_bebidas_validacion_descripcion_max_1000_40()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('bebida/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Limón de Pasas',
            'descripcion' => 'kajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldk',
            'precio' => 20,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 0,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'descripcion' => 'La descripcion es muy extenso',
        ]);
    }

    public function test_update_producto_tipo_bebidas_validacion_descripcion_min_3_41()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('bebida/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Limón de Pasas',
            'descripcion' => 'an',
            'precio' => 20,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 0,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'descripcion' => 'La descripcion es muy corto',
        ]);
    }


    public function test_update_producto_tipo_bebidas_validacion_precio_requerido_42()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('bebida/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Limón de Pasas',
            'descripcion' => 'Refresco de Limón',
            'precio' => null,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 0,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'precio' => 'El precio no puede estar vacío',
        ]);
    }

    public function test_update_producto_tipo_bebidas_validacion_precio_max_1000_43()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('bebida/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Limón de Pasas',
            'descripcion' => 'Refresco de Limón',
            'precio' => 8989898989898989,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 0,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'precio' => 'El precio es muy grande',
        ]);
    }

    public function test_update_producto_tipo_bebidas_validacion_precio_min_3_44()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('bebida/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Limón de Pasas',
            'descripcion' => 'Refresco de Limón',
            'precio' => 0,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 0,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'precio' => 'El precio es muy pequeño',
        ]);
    }


    public function test_update_producto_tipo_bebidas_validacion_precio_numeric_45()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('bebida/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Limón de Pasas',
            'descripcion' => 'Refresco de Limón',
            'precio' => 'dinero',
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 0,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'precio' => 'El precio debe de ser numerico',
        ]);
    }

    public function test_update_producto_tipo_bebidas_validacion_tamanio_required_46()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('bebida/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Limón de Pasas',
            'descripcion' => 'Refresco de Limón',
            'precio' => 20,
            'tamanio' => null,
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 0,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'tamanio' => 'El tamanio no puede estar vacío',
        ]);
    }

    public function test_update_producto_tipo_bebidas_validacion_tamanio_max_100_47()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('bebida/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Limón de Pasas',
            'descripcion' => 'Refresco de Limón',
            'precio' => 20,
            'tamanio' => 'utyufughhhdsgddffdsajhkahdsfkjhslkdjfhlkjadshfkjlhasdfkljhakljsdfhkljahdsflkjhafdskjlhfdsalkjhfdsalkjhafdlskhafslkjhafsjklhafkjafhjf',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 0,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'tamanio' => 'El tamanio es muy extenso',
        ]);
    }

    public function test_update_producto_tipo_bebidas_validacion_tamanio_min_3_48()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('bebida/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Limón de Pasas',
            'descripcion' => 'Refresco de Limón',
            'precio' => 20,
            'tamanio' => 'u',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 0,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'tamanio' => 'El tamanio es muy corto',
        ]);
    }

    public function test_update_producto_tipo_bebidas_validacion_cantidad_max_1000_49()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('bebida/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Limón de Pasas',
            'descripcion' => 'Refresco de Limón',
            'precio' => 20,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 157878787878,
            'estado' => 1,
            'tipo' => 0,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'cantidad' => 'El numero de bebidas disponibles es muy grande',
        ]);
    }

    public function test_update_producto_tipo_bebidas_validacion_cantidad_min_1_50()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('bebida/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Limón de Pasas',
            'descripcion' => 'Refresco de Limón',
            'precio' => 20,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 0,
            'estado' => 1,
            'tipo' => 0,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'cantidad' => 'El numero de bebidas disponibles es muy pequeño',
        ]);
    }

    public function test_update_producto_tipo_bebidas_validacion_cantidad_numeric_51()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('bebida/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Limón de Pasas',
            'descripcion' => 'Refresco de Limón',
            'precio' => 20,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 'can',
            'estado' => 1,
            'tipo' => 0,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'cantidad' => 'El numero de bebidas disponibles debe de ser numerico',
        ]);
    }


    public function test_update_producto_tipo_platillo_con_datos_correctos_52()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('platillo/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Arroz con Frijoles',
            'descripcion' => 'Casamiento con mantequilla incluida',
            'precio' => 20,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 1,
        ]);

        $produc = Producto::find($var['id_producto']);

        $this->eliminar_datos($var);

        $response->assertSessionHas(['mensaje']);
        $this->assertTrue($produc->nombre == 'Arroz con Frijoles');
    }

    public function test_update_producto_tipo_platillo_validacion_nombre_requerido_53()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('platillo/'.$var['id_producto'].'/edicion', [
            'nombre' => null,
            'descripcion' => 'Casamiento con mantequilla incluida',
            'precio' => 20,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 1,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'nombre' => 'El nombre no puede estar vacío',
        ]);
    }

    public function test_update_producto_tipo_platillo_validacion_nombre_max_100_54()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('platillo/'.$var['id_producto'].'/edicion', [
            'nombre' => 'dasdasddddddddddddddddfsdfsdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffsdfsdfasdfffffffffffffffffffffffffffffffffffffffffffffffffffff',
            'descripcion' => 'Casamiento con mantequilla incluida',
            'precio' => 20,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 1,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'nombre' => 'El nombre es muy extenso',
        ]);
    }

    public function test_update_producto_tipo_platillo_validacion_nombre_min_3_55()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('platillo/'.$var['id_producto'].'/edicion', [
            'nombre' => 'an',
            'descripcion' => 'Casamiento con mantequilla incluida',
            'precio' => 20,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 1,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'nombre' => 'El nombre es muy corto',
        ]);
    }

    public function test_update_producto_tipo_platillo_validacion_nombre_solo_letras_56()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('platillo/'.$var['id_producto'].'/edicion', [
            'nombre' => 6435,
            'descripcion' => 'Casamiento con mantequilla incluida',
            'precio' => 20,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 1,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'nombre' => 'El nombre debe tener solo letras',
        ]);
    }

    public function test_update_producto_tipo_platillo_validacion_tipo_requerido_57()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('platillo/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Arroz con Frijoles',
            'descripcion' => 'Casamiento con mantequilla incluida',
            'precio' => 20,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => null,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'tipo' => 'El tipo no puede estar vacío',
        ]);
    }

    public function test_update_producto_tipo_platillo_validacion_descripcion_requerido_58()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('platillo/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Arroz con Frijoles',
            'descripcion' => null,
            'precio' => 20,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 1,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'descripcion' => 'La descripcion no puede estar vacío',
        ]);
    }

    public function test_update_producto_tipo_platillo_validacion_descripcion_max_1000_59()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('platillo/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Arroz con Frijoles',
            'descripcion' => 'kajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldk',
            'precio' => 20,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 1,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'descripcion' => 'La descripcion es muy extenso',
        ]);
    }

    public function test_update_producto_tipo_platillo_validacion_descripcion_min_3_60()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('platillo/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Arroz con Frijoles',
            'descripcion' => 'an',
            'precio' => 20,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 1,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'descripcion' => 'La descripcion es muy corto',
        ]);
    }


    public function test_update_producto_tipo_platillo_validacion_precio_requerido_61()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('platillo/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Arroz con Frijoles',
            'descripcion' => 'Casamiento con mantequilla incluida',
            'precio' => null,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 1,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'precio' => 'El precio no puede estar vacío',
        ]);
    }

    public function test_update_producto_tipo_platillo_validacion_precio_max_1000_62()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('platillo/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Arroz con Frijoles',
            'descripcion' => 'Casamiento con mantequilla incluida',
            'precio' => 8989898989898989,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 1,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'precio' => 'El precio es muy grande',
        ]);
    }

    public function test_update_producto_tipo_platillo_validacion_precio_min_3_63()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('platillo/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Arroz con Frijoles',
            'descripcion' => 'Casamiento con mantequilla incluida',
            'precio' => 0,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 1,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'precio' => 'El precio es muy pequeño',
        ]);
    }


    public function test_update_producto_tipo_platillo_validacion_precio_numeric_64()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('platillo/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Arroz con Frijoles',
            'descripcion' => 'Casamiento con mantequilla incluida',
            'precio' => 'dinero',
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 1,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'precio' => 'El precio debe de ser numerico',
        ]);
    }

    public function test_update_producto_tipo_platillo_validacion_tamanio_required_65()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('platillo/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Arroz con Frijoles',
            'descripcion' => 'Casamiento con mantequilla incluida',
            'precio' => 20,
            'tamanio' => null,
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 1,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'tamanio' => 'El tamanio no puede estar vacío',
        ]);
    }

    public function test_update_producto_tipo_platillo_validacion_tamanio_max_100_66()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('platillo/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Arroz con Frijoles',
            'descripcion' => 'Casamiento con mantequilla incluida',
            'precio' => 20,
            'tamanio' => 'utyufughhhdsgddffdsajhkahdsfkjhslkdjfhlkjadshfkjlhasdfkljhakljsdfhkljahdsflkjhafdskjlhfdsalkjhfdsalkjhafdlskhafslkjhafsjklhafkjafhjf',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 1,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'tamanio' => 'El tamanio es muy extenso',
        ]);
    }

    public function test_update_producto_tipo_platillo_validacion_tamanio_min_3_67()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('platillo/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Arroz con Frijoles',
            'descripcion' => 'Casamiento con mantequilla incluida',
            'precio' => 20,
            'tamanio' => 'u',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 1,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'tamanio' => 'El tamanio es muy corto',
        ]);
    }

    public function test_update_producto_tipo_platillo_validacion_cantidad_max_1000_68()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('platillo/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Arroz con Frijoles',
            'descripcion' => 'Casamiento con mantequilla incluida',
            'precio' => 20,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 157878787878,
            'estado' => 1,
            'tipo' => 1,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'cantidad' => 'El numero de platillos disponibles es muy grande',
        ]);
    }

    public function test_update_producto_tipo_platillo_validacion_cantidad_min_1_69()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('platillo/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Arroz con Frijoles',
            'descripcion' => 'Casamiento con mantequilla incluida',
            'precio' => 20,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 0,
            'estado' => 1,
            'tipo' => 1,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'cantidad' => 'El numero de platillos disponibles es muy pequeño',
        ]);
    }

    public function test_update_producto_tipo_platillo_validacion_cantidad_numeric_70()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('platillo/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Arroz con Frijoles',
            'descripcion' => 'Casamiento con mantequilla incluida',
            'precio' => 20,
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 'can',
            'estado' => 1,
            'tipo' => 1,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'cantidad' => 'El numero de platillos disponibles debe de ser numerico',
        ]);
    }

    public function test_update_producto_tipo_complemento_con_datos_correctos_71()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('complemento/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Salsa Roja',
            'descripcion' => 'da un sabor mas agradable',
            'precio' => 20,
            'tamanio' => 'pequenio',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 2,
        ]);

        $produc = Producto::find($var['id_producto']);

        $this->eliminar_datos($var);

        $response->assertSessionHas(['mensaje']);
        $this->assertTrue($produc->nombre == 'Salsa Roja');
    }

    public function test_update_producto_tipo_complemento_validacion_nombre_requerido_72()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('complemento/'.$var['id_producto'].'/edicion', [
            'nombre' => null,
            'descripcion' => 'da un sabor mas agradable',
            'precio' => 20,
            'tamanio' => 'pequenio',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 2,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'nombre' => 'El nombre no puede estar vacío',
        ]);
    }

    public function test_update_producto_tipo_complemento_validacion_nombre_max_100_73()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('complemento/'.$var['id_producto'].'/edicion', [
            'nombre' => 'dasdasddddddddddddddddfsdfsdffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffsdfsdfasdfffffffffffffffffffffffffffffffffffffffffffffffffffff',
            'descripcion' => 'da un sabor mas agradable',
            'precio' => 20,
            'tamanio' => 'pequenio',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 2,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'nombre' => 'El nombre es muy extenso',
        ]);
    }

    public function test_update_producto_tipo_complemento_validacion_nombre_min_3_74()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('complemento/'.$var['id_producto'].'/edicion', [
            'nombre' => 'an',
            'descripcion' => 'da un sabor mas agradable',
            'precio' => 20,
            'tamanio' => 'pequenio',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 2,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'nombre' => 'El nombre es muy corto',
        ]);
    }

    public function test_update_producto_tipo_complemento_validacion_nombre_solo_letras_75()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('complemento/'.$var['id_producto'].'/edicion', [
            'nombre' => 6435,
            'descripcion' => 'da un sabor mas agradable',
            'precio' => 20,
            'tamanio' => 'pequenio',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 2,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'nombre' => 'El nombre debe tener solo letras',
        ]);
    }

    public function test_update_producto_tipo_complemento_validacion_tipo_requerido_76()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('complemento/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Salsa Roja',
            'descripcion' => 'da un sabor mas agradable',
            'precio' => 20,
            'tamanio' => 'pequenio',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => null,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'tipo' => 'El tipo no puede estar vacío',
        ]);
    }

    public function test_update_producto_tipo_complemento_validacion_descripcion_requerido_77()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('complemento/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Salsa Roja',
            'descripcion' => null,
            'precio' => 20,
            'tamanio' => 'pequenio',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 2,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'descripcion' => 'La descripcion no puede estar vacío',
        ]);
    }

    public function test_update_producto_tipo_complemento_validacion_descripcion_max_1000_78()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('complemento/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Salsa Roja',
            'descripcion' => 'kajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldkkajshdkjahskdjahskjdhakjshdkjashdkjhaskjdhakjshdkjashdkjhaskjdhaskjhdkjashdkjahskjdh
            askdhkjashdkjahskjdhaskjhdkjahsdkjhaskjdhkajshdkjahsdkjjasl;dka;lskd;laksd;lkas;ldkas;lkd;alskd;lask;ldk',
            'precio' => 20,
            'tamanio' => 'pequenio',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 2,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'descripcion' => 'La descripcion es muy extenso',
        ]);
    }

    public function test_update_producto_tipo_complemento_validacion_descripcion_min_3_79()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('complemento/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Salsa Roja',
            'descripcion' => 'an',
            'precio' => 20,
            'tamanio' => 'pequenio',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 2,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'descripcion' => 'La descripcion es muy corto',
        ]);
    }


    public function test_update_producto_tipo_complemento_validacion_precio_requerido_80()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('complemento/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Salsa Roja',
            'descripcion' => 'da un sabor mas agradable',
            'precio' => null,
            'tamanio' => 'pequenio',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 2,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'precio' => 'El precio no puede estar vacío',
        ]);
    }

    public function test_update_producto_tipo_complemento_validacion_precio_max_1000_81()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('complemento/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Salsa Roja',
            'descripcion' => 'da un sabor mas agradable',
            'precio' => 8989898989898989,
            'tamanio' => 'pequenio',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 2,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'precio' => 'El precio es muy grande',
        ]);
    }

    public function test_update_producto_tipo_complemento_validacion_precio_min_3_82()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('complemento/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Salsa Roja',
            'descripcion' => 'da un sabor mas agradable',
            'precio' => 0,
            'tamanio' => 'pequenio',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 2,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'precio' => 'El precio es muy pequeño',
        ]);
    }


    public function test_update_producto_tipo_complemento_validacion_precio_numeric_83()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('complemento/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Salsa Roja',
            'descripcion' => 'da un sabor mas agradable',
            'precio' => 'dinero',
            'tamanio' => 'pequenio',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 2,
        ]);


        $this->eliminar_datos($var);

        $response->assertInvalid([
            'precio' => 'El precio debe de ser numerico',
        ]);
    }

    public function test_update_producto_tipo_complemento_validacion_tamanio_required_84()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('complemento/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Salsa Roja',
            'descripcion' => 'da un sabor mas agradable',
            'precio' => 20,
            'tamanio' => null,
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 2,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'tamanio' => 'El tamanio no puede estar vacío',
        ]);
    }

    public function test_update_producto_tipo_complemento_validacion_tamanio_max_100_85()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('complemento/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Salsa Roja',
            'descripcion' => 'da un sabor mas agradable',
            'precio' => 20,
            'tamanio' => 'utyufughhhdsgddffdsajhkahdsfkjhslkdjfhlkjadshfkjlhasdfkljhakljsdfhkljahdsflkjhafdskjlhfdsalkjhfdsalkjhafdlskhafslkjhafsjklhafkjafhjf',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 2,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'tamanio' => 'El tamanio es muy extenso',
        ]);
    }

    public function test_update_producto_tipo_complemento_validacion_tamanio_min_3_86()
    {
        $var = $this->cargar_datos();

        $response = $this->actingAs(User::find(1))->put('complemento/'.$var['id_producto'].'/edicion', [
            'nombre' => 'Salsa Roja',
            'descripcion' => 'da un sabor mas agradable',
            'precio' => 20,
            'tamanio' => 'u',
            'imagen' => 'img/ProductosMenú/Limón.jpg',
            'cantidad' => 15,
            'estado' => 1,
            'tipo' => 2,
        ]);

        $this->eliminar_datos($var);

        $response->assertInvalid([
            'tamanio' => 'El tamanio es muy corto',
        ]);
    }

