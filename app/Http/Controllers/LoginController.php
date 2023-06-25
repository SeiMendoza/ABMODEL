<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class LoginController extends Controller
{
    //
    public function show(){
        //acceder solo autenticado
        if(Auth::check()){
            return redirect('/');
        }
        return view('auth.login');
    }

    public function login(Request $request){
       /**$credentials = $request->getCredentials();

       if(!Auth::validate($credentials)){
        return redirect()->to('/login')->withErrors('Usuario o contraseña son incorrectos');
       }
       //validacion de las credenciales
       $user = Auth::getProvider()->retrieveByCredentials($credentials);

       Auth::login($user);

       return $this->authenticated($request, $user);
    }

    public function authenticated(Request $request, $user){
        return redirect('/ab');*/

        $acc=request()->validate([
            'email'=> 'required',
            'password' => 'required'
        ],
        [
            'email.required' => 'El correo es obligatorio.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        if(Auth::attempt($acc))
        {
            $con='OK';
        }
        $email = $request->get('email');
        $query = User::where('email','=',$email)->get();
        if($query->count() !=0)
        {
            $hashp=$query[0]->password;
            $password=$request->get('password');
            if(password_verify($password,$hashp))
            {
                return redirect('/ab');
            }
            else{
                return back()->withErrors(['password'=>'Contraseña no valida.'])
                    ->withInput([request('password')]);
            }
        }
        else{
            return back()->withErrors(['email'=>'Correo no valido.'])
                    ->withInput([request('usuario')]);
        }
    }

    public function cerrar(){
        Session::flush();

        Auth::logout();

        return redirect()->to('/login');
    }
   
    public function perfil()
    {
        $user = auth()->user();
        return view('auth.perfil')->with('user', $user);
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
             'name' => 'required|min:3|max:40|regex:/^[a-zA-Z]+\s[a-zA-Z]+(\s[a-zA-Z]+)?(\s[a-zA-Z]+)?$/',
             'email' => 'required|string|email|max:50',
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
            return redirect()->route('usuarios.perfil')
            ->with('mensaje', "Se actualizó exitosamente el perfil: ".$actualizarUser->name." ");
         }
    }

}
