<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use App\Models\User;

class LoginController extends Controller
{
    //
    public function show()
    {
        //acceder solo autenticado
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'El correo es obligatorio.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            return redirect('/ab');
        } else {
            return back()->withErrors(['password' => 'Correo o contraseña no válidos.'])
                ->withInput(['email' => $request->email]);
        }
    }

    public function cerrar()
    {
        Session::flush();

        Auth::logout();

        return redirect()->to('/login');
    }

    public function perfil(Request $request)
    {
        $user = auth()->user();

        $url = $request->header('referer');
        $url = parse_url($url)['path'];

        return view('auth.perfil', compact('user', 'url'));
    }


    /**Editar Usuario - en vista de perfil*/
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('auth.EditarUserPrin')->with('user', $user);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:40|regex:/^[a-zA-ZáÁéÉíÍóÓúÚñÑ]+\s[a-zA-ZáÁéÉíÍóÓúÚñÑ]+(\s[a-zA-ZáÁéÉíÍóÓúÚñÑ]+)?(\s[a-zA-ZáÁéÉíÍóÓúÚñÑ]+)?$/',
            'email' => 'required|string|email|max:50', Rule::unique('users')->ignore($id),
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

            'address.required' => '¡Debes ingresar tu dirección!',
            'address.string' => '¡Debes ingresar tu dirección, verifica la información!',
            'address.min' => '¡Ingresa tu dirección completa, sin abreviaturas!',
            'address.max' => '¡Has excedido el limite máximo de 250 letras!',

            'telephone.required' => '¡Debes ingresar tu número de teléfono!',
            'telephone.min' => '¡El número telefónico debe tener minimo: 8 dígitos!',
            'telephone.max' => '¡El número telefónico debe tener maximo: 8 dígitos!',
            'telephone.regex' => '¡El número telefónico debe iniciar con (2),(3),(8) ó (9)!',
        ]);

        try {

            $actualizarUser = User::findOrFail($id);

            $actualizarUser->name = $request->input('name');
            $actualizarUser->email = $request->input('email');
            $actualizarUser->address = $request->input('address');
            $actualizarUser->telephone = $request->input('telephone');

            if ($request->filled('new_password')) {
                $this->validate($request, [
                    'current_password' => 'required',
                    'new_password' => 'confirmed|min:8',
                ], $this->customMessages);

                // Verificar si la contraseña actual coincide
                if (Hash::check($request->input('current_password'), $actualizarUser->password)) {
                    // La contraseña actual coincide, se puede cambiar la contraseña
                    $actualizarUser->password = bcrypt($request->input('new_password'));
                } else {
                    // La contraseña actual no coincide, se mantiene la contraseña anterior
                    return redirect()->back()->withErrors(['current_password' => 'La contraseña actual no es correcta.']);
                }
            }

            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $destinationPath = 'images/';
                $filename = time() . '.' . $file->getClientOriginalName();
                $uploadSuccess = $request->file('imagen')->move($destinationPath, $filename);
                $actualizarUser->imagen = 'images/' . $filename;
            } else {
                unset($actualizarUser['imagen']);
            }

            /*Variable para guardar los nuevos cambios */
            $creado = $actualizarUser->save();

            if ($creado) {
                return redirect()->route('usuarios.perfil')
                    ->with('mensaje', "Se actualizó exitosamente el perfil: " . $actualizarUser->name . " ");
            }
        } catch (QueryException $exception) {
            $errorCode = $exception->errorInfo[1];
            if ($errorCode == 1062) {
                // Código de error 1062: Entrada duplicada
                return redirect()->back()->withErrors(['email' => 'El correo electrónico ya está en uso.'])->withInput();
            }
            throw $exception;
        }
    }

    private $customMessages = [
        'current_password.required' => '¡Este campo es obligatorio, si deseas cambiar la contraseña!',
        'new_password.confirmed' => '¡Debes confirmar tu contraseña!',
        'new_password.min' => '¡Debes ingresar una contraseña segura, minimo 8 caracteres!',
    ];
}