<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Bebida;
use App\Models\Combo;
use App\Models\Pedido;
use Illuminate\Http\Request;
use App\Models\Platillo;

class MenuUsuarioController extends Controller
{
    /*Visualizar el menu por usuario*/
    public function index(Request $request)
    {
        $platillos = Platillo::all();
        $bebidas = Bebida::all();
        $combos = Combo::all();
        $text = trim($request->get('/'));
        $menu = Platillo::where('nombre', 'like', '%' . $text . '%')
            ->orWhere('tamanio', 'like', '%' . $text . '%')->paginate(10);
        return view('Menu/Cliente/Menu', compact('platillos', 'text', 'combos','bebidas'));
    }
     public function qr(){
        return view('Menu/Admon/QR_Menu');
     }

     
     public function prueba(Request $request){
        $platillos = Platillo::all();
        $bebidas = Bebida::all();
        $combos = Combo::all();
        $text = trim($request->get('busqueda'));
        $platillos = Platillo::where('nombre', 'like', '%' . $text . '%')
            ->orWhere('tamanio', 'like', '%' . $text . '%')->paginate(10);
            $bebidas = Platillo::where('nombre', 'like', '%' . $text . '%')
            ->orWhere('tamanio', 'like', '%' . $text . '%')->paginate(10);
            $combos = Platillo::where('nombre', 'like', '%' . $text . '%')
            ->orWhere('tamanio', 'like', '%' . $text . '%')->paginate(10);
        return view("Menu.Cliente.Menu", compact('platillos', 'text', 'combos','bebidas'));
     }
      
}
