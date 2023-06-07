<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegistroRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegistroController extends Controller
{
    //
    public function show(){
        //acceder solo autenticado
        if(Auth::check()){
            return redirect('/');
        }
        return view('auth.registro');
    }

    //validacion del registro
    public function registro(RegistroRequest $request){
        $user = User::create($request->validated());
        //redirigir
        return redirect('/login')->with('success', 'Cuenta creada con éxito');
    }
}
