<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Platillo;
use App\Models\Bebida;
use App\Models\Combo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BusquedaAdmonController extends Controller
{
    public function index(Request $request){     
      $busqueda =trim($request->get('busqueda'));
            $platillos = DB::table('platillos')
                  ->where('nombre', 'like', '%'.$busqueda.'%')->paginate(10);
            $bebidas = DB::table('bebidas')
                  ->where('nombre', 'like', '%'.$busqueda.'%')->paginate(10);
            $combos = DB::table('combos')
                  ->where('nombre', 'like', '%'.$busqueda.'%')->paginate(10);
            return view('Menu/Admon/admon_Restaurante', compact('platillos','bebidas', 'combos',  'busqueda'));
              }
}