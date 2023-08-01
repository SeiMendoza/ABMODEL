<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;

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
            'name' => 'required|min:3|max:40|regex:/^[a-zA-ZáÁéÉíÍóÓúÚñÑ]+\s[a-zA-ZáÁéÉíÍóÓúÚñÑ]+(\s[a-zA-ZáÁéÉíÍóÓúÚñÑ]+)?(\s[a-zA-ZáÁéÉíÍóÓúÚñÑ]+)?$/',
            'email' => 'required|string|email|max:50|unique:users',
            'is_default' => ['required', Rule::in(['Administrador', 'Usuario'])],
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|string|min:3|max:250',
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

            'is_default.required' => '¡Este campo es obligatorio!',

            'password.required' => '¡Debes ingresar una contraseña!',
            'password.confirmed' => '¡Debes confirmar tu contraseña!',
            'password.min' => '¡Debes ingresar una contraseña segura, minimo 8 caracteres!',

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

        $isDefaultOptions = [
            true => 'Administrador',
            false => 'Usuario',
        ];

        $input = $request->all();
        $password = $request->input('password');
        $input['password'] = bcrypt($password);

        $nuevoUser = new User();

        $nuevoUser->name=$request->input('name');
        $nuevoUser->email=$request->input('email');
        $nuevoUser['is_default'] = $isDefaultOptions[$request->input('is_default') === 'Administrador'];
        $nuevoUser->password= bcrypt($request->input('password'));
        $nuevoUser->address=$request->input('address');
        $nuevoUser->telephone=$request->input('telephone');

        $file = $request->file('imagen');
        $destinationPath = 'images/';
        $filename = time().'.'.$file->getClientOriginalName();
        $uploadSuccess = $request->file('imagen')->move($destinationPath,$filename);
        $nuevoUser->imagen = 'images/'.$filename; 

        /*Variable para guardar los nuevos registros*/
        $creado = $nuevoUser->save();

        if($creado){
           return redirect()->route('usuarios.users')
           ->with('mensaje', 'Usuario creado exitosamente');
        }
    }

    /**Editar Usuario */
    public function edit($id, User $user)
    {
        //Mensaje para cuando un usuario quiera editar otro
        try {
            $this->authorize('update', $user);
        } catch (AuthorizationException $e) {
            return view('auth/PermisoDenegado'); 
        }

        $user = User::findOrFail($id);

        return view('auth/EditarUser')->with('user', $user);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:40|regex:/^[a-zA-ZáÁéÉíÍóÓúÚñÑ]+\s[a-zA-ZáÁéÉíÍóÓúÚñÑ]+(\s[a-zA-ZáÁéÉíÍóÓúÚñÑ]+)?(\s[a-zA-ZáÁéÉíÍóÓúÚñÑ]+)?$/',
            'email' => 'required|string|email|max:50', Rule::unique('users')->ignore($id),
            'is_default' => ['', Rule::in(['Administrador', 'Usuario'])],
            'address' => 'required|string|min:3|max:250',
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

            'is_default.required' => '¡Este campo es obligatorio!',

            'address.required' => '¡Debes ingresar tu dirección!',
            'address.string' => '¡Debes ingresar tu dirección, verifica la información!',
            'address.min' => '¡Ingresa tu dirección completa, sin abreviaturas!',
            'address.max' => '¡Has excedido el limite máximo de 250 letras!',

            'telephone.required' => '¡Debes ingresar tu número de teléfono!',
            'telephone.min'=>'¡El número telefónico debe tener minimo: 8 dígitos!',
            'telephone.max'=>'¡El número telefónico debe tener maximo: 8 dígitos!',
            'telephone.regex'=>'¡El número telefónico debe iniciar con (2),(3),(8) ó (9)!',

        ]);

        $isDefaultOptions = [
            true => 'Administrador',
            false => 'Usuario',
        ];

        try{
            $actualizarUser = User::findOrFail($id);

            $actualizarUser->name=$request->input('name');
            $actualizarUser->email=$request->input('email');
            // $actualizarUser['is_default'] = $isDefaultOptions[$request->input('is_default') === 'Administrador'];    
            $actualizarUser->address=$request->input('address');
            $actualizarUser->telephone=$request->input('telephone');

            // Actualizar el campo 'is_default' solo si es realizado por otro administrador BD.
            if (Auth::user()->isAdmin() && $actualizarUser->id !== Auth::user()->id) {
               $actualizarUser['is_default'] = $isDefaultOptions[$request->input('is_default') === 'Administrador'];
            }

            // Actualizar los otros campos
            $actualizarUser->update($request->except('is_default'));


            if ($request->filled('new_password')) {
                $this->validate($request, [
                   'new_password' => 'confirmed|min:8',
                ], $this->customMessages);
    
                // Actualizar la contraseña con la nueva contraseña ingresada
                $actualizarUser->password = bcrypt($request->input('new_password'));
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

            /*Variable para guardar los nuevos cambios*/
            $creado = $actualizarUser->save();

            if($creado){
                return redirect()->route('usuarios.users')
                ->with('mensaje', "Usuario actualizado exitosamente: ".$actualizarUser->name." ");
            }
        }

        catch (QueryException $exception) {
            $errorCode = $exception->errorInfo[1];
            if ($errorCode == 1062) {
               // Código de error 1062: Entrada duplicada
               return redirect()->back()->withErrors(['email' => 'El correo electrónico ya está en uso.'])->withInput();
            }
            throw $exception;
        }
    }

    private $customMessages = [
        'new_password.confirmed' => '¡Debes confirmar tu contraseña!',
        'new_password.min' => '¡Debes ingresar una contraseña segura, minimo 8 caracteres!',
    ];

    
    /*Borrar usuario con permisos*/ 
    public function destroy($id)
    {
        // Verifica si el usuario a eliminar existe
        $userToDelete = User::find($id);

        // Verificar si el usuario logueado es un administrador
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('usuarios.users')->with('error', 'No tienes permiso para eliminar este usuario.');
        }

        // Verificar si el usuario a eliminar es el mismo usuario autenticado
        if (auth()->user()->id === $userToDelete->id) {
            return redirect()->route('usuarios.users')->with('error', 'No puedes eliminarte a ti mismo.');
        }

        $userToDelete->delete();

        return redirect()->route('usuarios.users')->with('success', 'Usuario eliminado correctamente.');
    }
    

    /**Vista de usuarios */
    public function users(Request $request)
    {
        $listaUs = User::all();
        return view('auth/Usuarios', compact('listaUs'));
    }
}
