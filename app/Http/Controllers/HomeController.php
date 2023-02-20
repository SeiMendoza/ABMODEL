<?php

namespace App\Http\Controllers;

use App\Models\Combo;
use App\Models\PlatillosyBebidas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view("index");
    }

    public function b(){
        return view("pages.billing");
    }

    public function t(){
        return view("pages.tables");
    }

    public function admonRestaurante(){

        $platillos = PlatillosyBebidas::all();
        $combos = Combo::all();
        return view("/Menu/Admon/admon_Restaurante")->with(['platillos'=> $platillos, 'combos' => $combos]);
    }

    public function p(){
        return view('pages.profile');
    }

    public function s(){
        return view("pages.sign-in");
    }

    public function r(){
        return view("pages.rtl");
    }
    public function d(){
        return view("pages.dashboard");
    }
    public function registro(){
        return view("pages.registro");
    }
}
