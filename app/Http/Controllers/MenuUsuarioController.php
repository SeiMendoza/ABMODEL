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
         
     public function prueba(Request $request){
        $platillos = Platillo::all();
        $bebidas = Bebida::all();
        $combos = Combo::all();
        return view("Menu.Cliente.Prueba", compact('platillos', 'combos','bebidas'));
     }
      public function search(Request $request)
    {
        $text = trim($request->get('busqueda'));
        $platillos = Platillo::where('nombre', 'like', '%' . $text . '%')
            ->orWhere('tamanio', 'like', '%' . $text . '%')
            ->orWhere('precio', 'like', '%' . $text . '%')->paginate(10);
        $bebidas = Bebida::where('nombre', 'like', '%' . $text . '%')
            ->orWhere('tamanio', 'like', '%' . $text . '%')
            ->orWhere('precio', 'like', '%' . $text . '%')->paginate(10);
        $combos = Combo::where('nombre', 'like', '%' . $text . '%')
            ->orWhere('precio', 'like', '%' . $text . '%')->paginate(10);
        return view("Menu.Cliente.Prueba", compact('platillos', 'text', 'combos','bebidas'));
    }
     public function qr(){
        return view('Menu/Admon/QR_Menu');
     }
}
