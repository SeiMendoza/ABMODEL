<?php

namespace App\Http\Controllers;

use App\Models\Bebida;
use App\Models\Combo;
use App\Models\Platillo;
use App\Models\Piscina;
use App\Models\PiscinaTipo;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index()
    {
        $datosalerta = Piscina::select('piscina_tipos.descripcion',DB::raw('COUNT(*) AS total'),DB::raw('SUM(piscinas.peso) AS peso'))
        ->join('piscina_tipos','piscinas.tipo','=','piscina_tipos.id')->groupby('piscina_tipos.descripcion')->get();

        return view("index",compact('datosalerta'));
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

        $productos = Producto::all();
        $platillos = Platillo::all();
        $bebidas = Bebida::all();
        $combos = Combo::all();
        return view("/Menu/Admon/admon_Restaurante")->with(['productos' => $productos, 'platillos' => $platillos, 'bebidas' => $bebidas, 'combos' => $combos]);
    }


    public function pruebaAdmon(){

        $productos = Producto::all();
        $platillos = Platillo::all();
        $bebidas = Bebida::all();
        $combos = Combo::all();
        return view("/Menu/Admon/pruebaAdmon")->with(['productos' => $productos, 'platillos' => $platillos, 'bebidas' => $bebidas, 'combos' => $combos]);
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