<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Platillo;
use App\Models\Bebida;
use App\Models\Combo;
use Illuminate\Http\Request;

class BusquedaAdmonController extends Controller
{
    public function index(Request $request){
            $platillos = Platillo::all();
            $bebidas = Bebida::all();
            $combos = Combo::all();
            $busqueda =trim($request->get('/'));
            $admon = Platillo::where('nombre', 'like', '%'.$busqueda.'%')->paginate(10);
            return view('Menu/Admon/admon_Restaurante', compact('platillos', 'busqueda', 'combos', 'bebidas'));
              }


}