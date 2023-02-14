<?php

namespace App\Http\Controllers;

//use Database\Seeders\PlatillosyBebidasSeeder;
use App\Models\PlatillosyBebidas;
use Illuminate\Http\Request;

class PedidoUsuarioController extends Controller
{
    /*Visualizar el menu por usuario*/
public function index(){
    $menu = PlatillosyBebidas::all();
        return view ('Menu/Usuario/Menu')->with('menu', $menu);
}

}
