<?php

namespace App\Http\Controllers;

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
        return view("/Menu/Admon/admon_Restaurante")->with('platillos', $platillos);
    }

    public function p(){
        return view("pages.profile");
    }

    public function s(){
        return view("pages.sign-in");
    }

    public function r(){
        return view("pages.rtl");
    }
    public function registro(){
        return view("pages.registro");
    }
}
