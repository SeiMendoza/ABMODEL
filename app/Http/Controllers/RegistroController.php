<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegistroRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegistroController extends Controller
{
     
    /**public function show(){
        acceder solo autenticado
        if(Auth::check()){
            return redirect('/');
        }
        return view('auth/registro');
    }*/

    /**validacion del registr
    public function registro(RegistroRequest $request){
        $user = User::create($request->validated());
        redirigir
        return redirect('/login')->with('success', 'Cuenta creada con éxito');
    } */

    public function create()
    {
        return view('auth/registro');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:40|regex:/^[a-zA-Z]+\s[a-zA-Z]+(\s[a-zA-Z]+)?(\s[a-zA-Z]+)?$/',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|string|min:3|max:300',
            'telephone' => 'required|min_digits:8|max_digits:8|regex:/^[2,3,8,9][0-9]{7}+$/',
            'imagen' => 'required|image|mimes:jpg,png,jpeg,gif,svg'
        ], [
            'name.required' => '¡Debes ingresar tu nombre completo!',
            'name.min' => '¡Ingresa tu nombre completo, sin abreviaturas!',
            'name.max' => '¡Has excedido el limite máximo de letras!',
            'name.regex' => '¡Debes ingresar de 2 a 4 nombres, sin incluir símbolos ni números!',

            'email.required' => '¡Debes ingresar tú correo electrónico!',
            'email.string' => '¡Debes ingresar tu correo electrónico, verifica la información!',
            'email.email' => '¡Debes ingresar un correo electrónico válido!',
            'email.max' => '¡Has excedido el limite máximo de letras!',
            'email.unique' => '¡Debes ingresar un correo electrónico diferente!',

            'password.required' => '¡Debes ingresar una contraseña!',
            'password.confirmed' => '¡Debes confirmar tu contraseña!',
            'password.min' => '¡Debes ingresar una contraseña segura!',

            'address.required' => '¡Debes ingresar tu dirección!',
            'address.string' => '¡Debes ingresar tu dirección, verifica la información!',
            'address.min' => '¡Ingresa tu dirección completa, sin abreviaturas!',
            'address.max' => '¡Has excedido el limite máximo de 250 letras!',

            'telephone.required' => '¡Debes ingresar tu número de teléfono!',
            'telephone.min_digits'=>'¡El número telefónico debe tener minimo: 8 dígitos!',
            'telephone.max_digits'=>'¡El número telefónico debe tener maximo: 8 dígitos!',
            'telephone.regex'=>'¡El número telefónico debe iniciar con (2),(3),(8) ó (9)!',

            'image.required' => '¡Debes cargar una imagen!',
            'image.image' => '¡Debes seleccionar una imagen!',
            'image.mimes' => '¡Debes seleccionar una imagen en el formato correcto!'
        ]);

        $input = $request->all();
        $password = $request->input('password');
        $input['password'] = bcrypt($password);

        $nuevoUser = new User();

        $nuevoUser->name=$request->input('name');
        $nuevoUser->email=$request->input('email');
        $nuevoUser->password=$request->input('password');
        $nuevoUser->address=$request->input('address');
        $nuevoUser->telephone=$request->input('telephone');

        $file = $request->file('imagen');
        $destinationPath = 'images/';
        $filename = time().'.'.$file->getClientOriginalName();
        $uploadSuccess = $request->file('imagen')->move($destinationPath,$filename);
        $nuevoUser->imagen = 'images/'.$filename; 

        /*Variable para guardar los nuevos registros */
        $creado = $nuevoUser->save();

        if($creado){
           return redirect()->route('usuarios.users')
           ->with('mensaje', 'Se creó exitosamente el usuario');
        }
    }


    /**Editar Usuario */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('auth/EditarUser')->with('user', $user);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:40|regex:/^[a-zA-Z]+\s[a-zA-Z]+(\s[a-zA-Z]+)?(\s[a-zA-Z]+)?$/',
            'email' => 'required|string|email|max:50',
            'password' => '',
            'address' => 'required|string|min:3|max:300',
            'telephone' => 'required|min:8|max:8|regex:/^[2,3,8,9][0-9]{7}+$/',
            'imagen' => ''
        ], [
            'name.required' => '¡Debes ingresar tu nombre completo!',
            'name.min' => '¡Ingresa tu nombre completo, sin abreviaturas!',
            'name.max' => '¡Has excedido el limite máximo de letras!',
            'name.regex' => '¡Debes ingresar de 2 a 4 nombres, sin incluir símbolos ni números!',

            'email.required' => '¡Debes ingresar tú correo electrónico!',
            'email.string' => '¡Debes ingresar tu correo electrónico, verifica la información!',
            'email.email' => '¡Debes ingresar un correo electrónico válido!',
            'email.max' => '¡Has excedido el limite máximo de letras!',

            'password.required' => '¡Debes ingresar una contraseña!',
            'password.confirmed' => '¡Debes confirmar tu contraseña!',
            'password.min' => '¡Debes ingresar una contraseña segura!',

            'address.required' => '¡Debes ingresar tu dirección!',
            'address.string' => '¡Debes ingresar tu dirección, verifica la información!',
            'address.min' => '¡Ingresa tu dirección completa, sin abreviaturas!',
            'address.max' => '¡Has excedido el limite máximo de 250 letras!',

            'telephone.required' => '¡Debes ingresar tu número de teléfono!',
            'telephone.min'=>'¡El número telefónico debe tener minimo: 8 dígitos!',
            'telephone.max'=>'¡El número telefónico debe tener maximo: 8 dígitos!',
            'telephone.regex'=>'¡El número telefónico debe iniciar con (2),(3),(8) ó (9)!',

        ]);

        $actualizarUser = User::findOrFail($id);

        $actualizarUser->name=$request->input('name');
        $actualizarUser->email=$request->input('email');
        $actualizarUser->address=$request->input('address');
        $actualizarUser->telephone=$request->input('telephone');

        if ($request->has('password')) {
            // Solo se actualiza la contraseña si se proporciona una nueva
            $actualizarUser->password = bcrypt($request->input('password'));
        }

        if($request->hasFile('imagen')){
            $file = $request->file('imagen');
            $destinationPath = 'images/';
            $filename = time().'.'.$file->getClientOriginalName();
            $uploadSuccess = $request->file('imagen')->move($destinationPath,$filename);
            $actualizarUser->imagen = 'images/'.$filename;

            }else{
                unset($actualizarUser['imagen']);
        }

        /*Variable para guardar los nuevos cambios */
        $creado = $actualizarUser->save();

        if($creado){
           return redirect()->route('usuarios.users')
           ->with('mensaje', "Se actualizó exitosamente el usuario: ".$actualizarUser->name." ");
        }
    }

    /*Borrar usuario*/ 
    public function destroy($id){
         User::findOrFail($id)->delete();
         return to_route('usuarios.users')->with('mensaje', 'Usuario eliminado correctamente!');
    }


    /**Vista de usuarios */
    public function users(Request $request)
    {
        $listaUs = User::all();
        return view('auth/Usuarios', compact('listaUs'));
    }
}
