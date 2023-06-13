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
}
