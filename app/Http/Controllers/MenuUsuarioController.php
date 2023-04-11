<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Bebida;
use App\Models\Combo;
use App\Models\DetallesUsuario;
use App\Models\Mesa;
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
        $mesas = Mesa::all();
        return view("Menu.Cliente.Prueba", compact('platillos', 'combos','bebidas','mesas'));
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

     public function store(Request $request)
    {
        $request->validate([
            'tuplas' => ['required'],
        ], [
            'name.required' => 'No tiene un nombre ingresado',
            'tuplas.required' => 'El pedido esta vacio',
        ]);

        $pedido = new Pedido();
        $pedido->quiosco = $request->input('quiosco');
        $pedido->nombreCliente = 'Sutano';
        $pedido->mesa_id = 3;
        $pedido->imp = 0.00;
        $pedido->total = 100;
        $pedido->save();


        for ($i = 0; $i < intval($request->input("tuplas")); $i++) {
            $array = explode(' ', $request->input("det-" . $i));
            $detalle = new DetallesUsuario();
            $detalle->pedido_id = $pedido->id;
            $detalle->producto_id = 1;
            $detalle->cantidad = 1;
            $detalle->precio = 1;
            $detalle->save();
        }

        return redirect()->route("cliente_prueba")->with('mensaje', 'El pedido fue enviado exitosamente');
    }
}
