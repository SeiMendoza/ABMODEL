<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserTest extends TestCase
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
    
        public function test_13_RequiereMaxCuarentaCaracteres()
        {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->post('/usuarios/create', [
            'name' => 'Evelyn swdknIUAFHASDFJHSDUFIHSDNFJSHDFIUHDISJDFHYUSDFGBHSDGCYSDFHGBSYDFGBSYDCBSDYCVGSBDVFHEFGBYDFGBYSCHNAISCKNSICHFNUWBFYDGVCBSYDHN', 
            'email' => 'evyrodriguez03@gmail.com',
            'is_default' => 'Usuario',
            'password' => '03roxana.',
            'password_confirmation' => '03roxana.',
            'address' => 'Las Flores',
            'telephone' => '94567892',
            'imagen' => 'img/imagen.png'
        ]);
    
        $response->assertInvalid([
            'name' => '¡Has excedido el limite máximo de letras!'
        ]);
        }
    
        public function test_14_RequiereregexCaracteres()
        {
        $user = User::find(1);
     
        $response = $this->actingAs($user)->post('/usuarios/create', [
            'name' => 'EVELYM', 
            'email' => 'evyrodriguez03@gmail.com',
            'is_default' => 'Usuario',
            'password' => '03roxana.',
            'password_confirmation' => '03roxana.',
            'address' => 'Las Flores',
            'telephone' => '94567892',
            'imagen' => 'img/imagen.png'
        ]);
    
        $response->assertInvalid([
            'name' => '¡Debes ingresar de 2 a 4 nombres, sin incluir símbolos ni números!'
        ]);
        }
    
            public function test_15_RequiereRegexConNumero()
        {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->post('/usuarios/create', [
            'name' => 'EVELYM 202932833', 
            'email' => 'evyrodriguez03@gmail.com',
            'is_default' => 'Usuario',
            'password' => '03roxana.',
            'password_confirmation' => '03roxana.',
            'address' => 'Las Flores',
            'telephone' => '94567892',
            'imagen' => 'img/imagen.png'
        ]);
    
        $response->assertInvalid([
            'name' => '¡Debes ingresar de 2 a 4 nombres, sin incluir símbolos ni números!'
        ]);
        }
    
        public function test_16_RequiereEmailSinIngresarCorreo()
        {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->post('/usuarios/create', [
            'name' => 'Evelyn Roxana Rodriguez Maradiaga', 
            'email' => '',
            'is_default' => 'Usuario', 
            'password' => '03roxana.',
            'password_confirmation' => '03roxana.',
            'address' => 'Las Flores',
            'telephone' => '94567892',
            'imagen' => 'img/imagen.png'
        ]);
    
        $response->assertInvalid([
            'email' => '¡Debes ingresar tu correo electrónico, verifica la información!'   //mensaje de error no es el esperado para required "ver controlador"
        ]);
        }
    
        public function test_17_RequiereEmailIngresandoCorreoInvalido()
        {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->post('/usuarios/create', [
            'name' => 'Evelyn Roxana Rodriguez Maradiaga', 
            'email' => 'evyrodriguez09@gmail.com',   //este es un correo valido y para que el mensaje se muestre debe ser algo como este evyrodriguez09@
            'is_default' => 'Usuario',
            'password' => '03roxana.',
            'password_confirmation' => '03roxana.',
            'address' => 'Las Flores',
            'telephone' => '94567892',
            'imagen' => 'img/imagen.png'
        ]);
    
        $response->assertInvalid([
            'email' => '¡Debes ingresar un correo electrónico válido!'
        ]);
        }
    
        public function test_18_RequiereEmailIngresandoMaxCaracter()
        {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->post('/usuarios/create', [
            'name' => 'Evelyn Roxana Rodriguez Maradiaga', 
            'email' => 'evyroxanarodriguezmaradiagaehdfgsydfhbsjdnasdjhasdbsacbjxcbhxcnjcdskjfhdfbdncmaradiagahgahsgvayhsdb099283748@gmail.com',
            'is_default' => 'Usuario',
            'password' => '03roxana.',
            'password_confirmation' => '03roxana.',
            'address' => 'Las Flores',
            'telephone' => '94567892',
            'imagen' => 'img/imagen.png'
        ]);
    
        $response->assertInvalid([
            'email' => '¡Has excedido el limite máximo de letras!'
        ]);
        }
    
        public function test_19_RequiereEmailUnico()
        {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->post('/usuarios/create', [
            'name' => 'Evelyn Roxana Rodriguez Maradiaga', 
            'email' => 'evyrodriguez03@gmail.com',
            'is_default' => 'Usuario',
            'password' => '03roxana.',
            'password_confirmation' => '03roxana.',
            'address' => 'Las Flores',
            'telephone' => '94567892',
            'imagen' => 'img/imagen.png'
        ]);
    
        $response->assertInvalid([
            'email' => '¡Debes ingresar un correo electrónico diferente!'
        ]);
        }
    
        public function test_20_RequiereTipoDeusuarioObligatorio()
        {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->post('/usuarios/create', [
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
    
        public function test_21_RequiereContraseñaObligatorio()
        {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->post('/usuarios/create', [
            'name' => 'Evelyn Roxana Rodriguez Maradiaga', 
            'email' => 'evyrodriguez03@gmail.com',
            'is_default' => 'Usuario',
            'password' => '',
            'password_confirmation' => '03roxana.',
            'address' => 'Las Flores',
            'telephone' => '94567892',
            'imagen' => 'img/imagen.png'
        ]);
    
        $response->assertInvalid([
            'password' => '¡Debes ingresar una contraseña!'
        ]);
        }
    
        public function test_22_ConfirmarContraseñaObligatorio()
        {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->post('/usuarios/create', [
            'name' => 'Evelyn Roxana Rodriguez Maradiaga', 
            'email' => 'evyrodriguez03@gmail.com',
            'is_default' => 'Usuario',
            'password' => '03roxana.',
            'password_confirmation' => '',
            'address' => 'Las Flores',
            'telephone' => '94567892',
            'imagen' => 'img/imagen.png'
        ]);
    
        $response->assertInvalid([
            'password' => '¡Debes confirmar tu contraseña!'
        ]);
        }
    
        public function test_23_ContraseñaMinContraseñaSegura()
        {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->post('/usuarios/create', [
            'name' => 'Evelyn Roxana Rodriguez Maradiaga', 
            'email' => 'evyrodriguez03@gmail.com',
            'is_default' => 'Usuario',
            'password' => '03ro',
            'password_confirmation' => '03ro',
            'address' => 'Las Flores',
            'telephone' => '94567892',
            'imagen' => 'img/imagen.png'
        ]);
    
        $response->assertInvalid([
            'password' => '¡Debes ingresar una contraseña segura, minimo 8 caracteres!'
        ]);
        }
    
        public function test_24_LlenarCamposDireccionObligatoria()
        {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->post('/usuarios/create', [
            'name' => 'Evelyn Roxana Rodriguez Maradiaga', 
            'email' => 'evyrodriguez03@gmail.com',
            'is_default' => 'Usuario',
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
    
        public function test_25_VerificarDireccionConValoresString()
        {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->post('/usuarios/create', [
            'name' => 'Evelyn Roxana Rodriguez Maradiaga', 
            'email' => 'evyrodriguez03@gmail.com',
            'is_default' => 'Usuario',
            'password' => '03roxana.',
            'password_confirmation' => '03roxana.',
            'address' => 'calle12',
            'telephone' => '94567892',
            'imagen' => 'img/imagen.png'
        ]);
    
        $response->assertInvalid([
            'address' => '¡Debes ingresar tu dirección, verifica la información!'
        ]);
        }
    
        public function test_26_VerificarDireccionConMinDeValores()
        {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->post('/usuarios/create', [
            'name' => 'Evelyn Roxana Rodriguez Maradiaga', 
            'email' => 'evyrodriguez03@gmail.com',
            'is_default' => 'Usuario',
            'password' => '03roxana.',
            'password_confirmation' => '03roxana.',
            'address' => 'Col.',
            'telephone' => '94567892',
            'imagen' => 'img/imagen.png'
        ]);
    
        $response->assertInvalid([
            'address' => '¡Ingresa tu dirección completa, sin abreviaturas!'        //verificar en el controlador address min:3 para que sea mostrado este mensaje
        ]);
        }
    
        public function test_27_VerificarDireccionConMaxDeValores()
        {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->post('/usuarios/create', [
            'name' => 'Evelyn Roxana Rodriguez Maradiaga', 
            'email' => 'evyrodriguez03@gmail.com',
            'is_default' => 'Usuario',
            'password' => '03roxana.',
            'password_confirmation' => '03roxana.',
            'address' => 'Col.LasFlorsshdbashdsjdfsbdhfsbdvshvbhjxcnxcvbshdbsbdbh
            dcbsdhbsndvbhvbsjvngnsjdbhhsdvbdhvbshsdvbsdhvbsdnbchsdnsdhghsbfdfjshd
            sdvcgsdvshdvbhvxhvbhvbhvbhvbashdgsdyfsdhsdsnfjbsdhfsbsfhsbsskakdsndsdb
            dfjnsfbsdhfbshdfbsdhfgsfnsjfhsudfsdjsihfebndfgdsfbfbskhfhhfbbbggshjsjg
            dbchsdbvhsdvsyvhdhvbdvhbdvshsdncnshbsdhbsdcjbsdvCol.LasFlorsshdbashdsjdfsbdhfsbdvshvbhjxcnxcvbshdbsbdbh
            dcbsdhbsndvbhvbsjvngnsjdbhhsdvbdhvbshsdvbsdhvbsdnbchsdnsdhghsbfdfjshd
            sdvcgsdvshdvbhvxhvbhvbhvbhvbashdgsdyfsdhsdsnfjbsdhfsbsfhsbsskakdsndsdb
            dfjnsfbsdhfbshdfbsdhfgsfnsjfhsudfsdjsihfebndfgdsfbfbskhfhhfbbbggshjsjg
            dbchsdbvhsdvsyvhdhvbdvhbdvshsdncnshbsdhbsdcjbsdvCol.LasFlorsshdbashdsjdfsbdhfsbdvshvbhjxcnxcvbshdbsbdbh
            dcbsdhbsndvbhvbsjvngnsjdbhhsdvbdhvbshsdvbsdhvbsdnbchsdnsdhghsbfdfjshd
            sdvcgsdvshdvbhvxhvbhvbhvbhvbashdgsdyfsdhsdsnfjbsdhfsbsfhsbsskakdsndsdb
            dfjnsfbsdhfbshdfbsdhfgsfnsjfhsudfsdjsihfebndfgdsfbfbskhfhhfbbbggshjsjg
            dbchsdbvhsdvsyvhdhvbdvhbdvshsdncnshbsdhbsdcjbsdv',
            'telephone' => '94567892',
            'imagen' => 'img/imagen.png'
        ]);
    
        $response->assertInvalid([
            'address' => '¡Has excedido el limite máximo de 250 letras!'
        ]);
        }
    
        public function test_28_RequeridoTelefonoObligatorio()
        {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->post('/usuarios/create', [
            'name' => 'Evelyn Roxana Rodriguez Maradiaga', 
            'email' => 'evyrodriguez03@gmail.com',
            'is_default' => 'Usuario',
            'password' => '03roxana.',
            'password_confirmation' => '03roxana.',
            'address' => 'Barrio Las Flores',
            'telephone' => '',
            'imagen' => 'img/imagen.png'
        ]);
    
        $response->assertInvalid([
            'telephone' => '¡Debes ingresar tu número de teléfono!'
        ]);
        }
    
        public function test_29_RequeridoTelefonoObligatorioConMinNumeros()
        {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->post('/usuarios/create', [
            'name' => 'Evelyn Roxana Rodriguez Maradiaga', 
            'email' => 'evyrodriguez03@gmail.com',
            'is_default' => 'Usuario',
            'password' => '03roxana.',
            'password_confirmation' => '03roxana.',
            'address' => 'Barrio Las Flores',
            'telephone' => '9786',
            'imagen' => 'img/imagen.png'
        ]);
    
        $response->assertInvalid([
            'telephone' => '¡El número telefónico debe tener minimo: 8 dígitos!'
        ]);
        }
    
        public function test_30_RequeridoTelefonoObligatorioConMaxNumeros()
        {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->post('/usuarios/create', [
            'name' => 'Evelyn Roxana Rodriguez Maradiaga', 
            'email' => 'evyrodriguez03@gmail.com',
            'is_default' => 'Usuario',
            'password' => '03roxana.',
            'password_confirmation' => '03roxana.',
            'address' => 'Barrio Las Flores',
            'telephone' => '978665789388383847999899899099899898994887',
            'imagen' => 'img/imagen.png'
        ]);
    
        $response->assertInvalid([
            'telephone' => '¡El número telefónico debe tener maximo: 8 dígitos!'
        ]);
        }
    
        public function test_31_RequeridoTelefonoObligatorioConRegex()
        {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->post('/usuarios/create', [
            'name' => 'Evelyn Roxana Rodriguez Maradiaga', 
            'email' => 'evyrodriguez03@gmail.com',
            'is_default' => 'Usuario',
            'password' => '03roxana.',
            'password_confirmation' => '03roxana.',
            'address' => 'Barrio Las Flores',
            'telephone' => '00002938',
            'imagen' => 'img/imagen.png'
        ]);
    
        $response->assertInvalid([
            'telephone' => '¡El número telefónico debe iniciar con (2),(3),(8) ó (9)!'
        ]);
        }
    
        public function test_32_RequeridoTelefonoObligatorioConRegexvaloresInvalidos()
        {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->post('/usuarios/create', [
            'name' => 'Evelyn Roxana Rodriguez Maradiaga', 
            'email' => 'evyrodriguez03@gmail.com',
            'is_default' => 'Usuario',
            'password' => '03roxana.',
            'password_confirmation' => '03roxana.',
            'address' => 'Barrio Las Flores',
            'telephone' => '29876860',
            'imagen' => 'img/imagen.png'
        ]);
    
        $response->assertInvalid([
            'telephone' => '¡El número telefónico debe iniciar con (2),(3),(8) ó (9)!'   //Para que este mensaje sea mostrado, en  'telephone' debe iniciar con cualquier numero menos con (2),(3),(8) ó (9)
        ]);
        }
    
        
    }    
    

