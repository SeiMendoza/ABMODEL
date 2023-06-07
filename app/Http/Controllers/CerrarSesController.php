<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CerrarSesController extends Controller
{
    //
    public function cerrar(){
        Session::flush();

        Auth::logout();

        return redirect()->to('/login');
    }
}
