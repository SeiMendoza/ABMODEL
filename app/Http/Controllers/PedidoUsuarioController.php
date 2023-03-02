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
        $request->validate([
            'tuplas' => ['required'],
        ], [
            'name.required' => 'No tiene un nombre ingresado',
            'tuplas.required' => 'El pedido esta vacio',
        ]);

        $pedido = new Pedido();
        $pedido->mesa = $request->input('mesa');
        $pedido->quiosco = $request->input('quiosco');
        $pedido->nombreCliente = "fulano";
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
    public function pedido_terminados()
    {
        $pedido = Pedido::with('detalle_usuario');
        return view('Menu/Cocina/Pedidosterminados', compact('pedido'));
    }
    public function pedido_pendientes()
    {
        $pedido = Pedido::with('detalle_usuario');
        return view('Menu/Cocina/Pedidospendientes', compact('pedido'));
    }
    public function terminarp(Request $request,  $id)
    {
        $activar = Pedido::findOrfail($id);
        $activar->t = $request->input('t');

        $create = $activar->save();

        if ($create) {
            return redirect()->route('pedidost.pedido')->with('mensaje', 'El pedido fue terminado exitosamente!');
        }
    }
    public function pedidosPendientes_Cocina(Request $request,  $id)
    {
        $activar = Pedido::findOrfail($id);
        $activar->t = $request->input('t');

        $create = $activar->save();

        if ($create) {
            return redirect()->route('pedidosp.pedido')->with('mensaje', 'El pedido fue completado con exito!');
        }
    }
}
