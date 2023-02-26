<?php

namespace App\Http\Controllers;

use App\Models\DetallesUsuario;
use App\Models\Pedido;
use Database\Seeders\PlatillosyBebidasSeeder;
 
use Illuminate\Http\Request;

class PedidoUsuarioController extends Controller
{
    public function create()
    {
        return view("Menu.Cliente.pedido");
    }

    public function store(Request $request)
    {
        $request ->validate([
            'name' => ['required'],
            'tuplas' => ['required'],
        ],[
            'name.required' => 'No tiene un nombre ingresado',
            'tuplas.required' => 'El pedido esta vacio',
        ]);

        $pedido = new Pedido();
        $pedido->mesa= $request->input('mesa');
        $pedido->quiosco = $request->input('quiosco');
        $pedido->nombreCliente = $request->input('name');
        $pedido->imp = $request->input('imp');
        $pedido->total = $request->input('total');
        $pedido->save();


        for ($i=0; $i < intval($request->input("tuplas")) ; $i++) {
            $array = explode ( ' ', $request->input("det-".$i) );
            $detalle = new DetallesUsuario();
            $detalle->nombre = $pedido->id;
            $detalle->cantidad = $array[0];
            $detalle->precio = $array[1];
            $detalle->save();
        }

        return redirect()->route("cliente_menu.index");
    }
    public function pedido_terminados(){
        $pedido = Pedido::all();
        return view('Cosina/Pedidosterminados',compact('pedido'));
     }
     public function pedido_pendientes(){
        $pedido = Pedido::all();
        return view('Cosina/Pedidospendientes',compact('pedido'));
     }
}
