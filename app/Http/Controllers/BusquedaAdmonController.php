<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PlatillosyBebidas;
use Illuminate\Http\Request;

class BusquedaAdmonController extends Controller
{
    public function index(Request $request){
            $platillos = PlatillosyBebidas::all();
            $combos = PlatillosyBebidas::all();
            $busqueda =trim($request->get('busqueda'));
            $platillos = PlatillosyBebidas::where('nombre', 'like', '%'.$busqueda.'%');
            return view('Menu/Admon/admon_Restaurante', compact('platillos', 'busqueda', 'combos'));
   }
}