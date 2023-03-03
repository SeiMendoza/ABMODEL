<?php

namespace App\Http\Controllers;

use App\Models\Bebida;
use App\Models\Combo;
use App\Models\Platillo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view("index");
    }

    public function b()
    {
        return view("pages.billing");
    }

    public function t()
    {
        return view("pages.tables");
    }

    public function indexAdmon()
    {

        $platillos = Platillo::all();
        $bebidas = Bebida::all();
        $combos = Combo::all();
        return view("/Menu/Admon/admon_Restaurante")->with(['platillos' => $platillos, 'bebidas' => $bebidas, 'combos' => $combos]);
    }


    public function pruebaAdmon(){
        $platillos = Platillo::all();
        $bebidas = Bebida::all();
        $combos = Combo::all();
        return view("/Menu/Admon/pruebaAdmon")->with(['platillos' => $platillos, 'bebidas' => $bebidas, 'combos' => $combos]);
    }


    public function p()
    {
        return view('pages.profile');
    }

    public function s()
    {
        return view("pages.sign-in");
    }

    public function r()
    {
        return view("pages.rtl");
    }
    public function d()
    {
        return view("pages.dashboard");
    }
    public function registro()
    {
        return view("pages.registro");
    }
    public function u()
    {
        return view("pages.sign-up");
    }
}