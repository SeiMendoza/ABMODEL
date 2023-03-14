<?php

namespace App\Http\Controllers;

use App\Models\DetallesUsuario;
use App\Models\Pedido;
use Database\Seeders\PlatillosyBebidasSeeder;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $pedido->nombreCliente = 'Sutano';
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
    public function pedido_terminados(Request $request)
    {
        //recuperar datos del filtro
        $texto=trim($request->get('busqueda'));

        $pedido = Pedido::where('nombreCliente', 'like', '%' . $texto . '%')->paginate(10);
        return view('Menu/Cocina/Pedidosterminados', compact('pedido','texto'));
    }
    public function terminados(Request $request)
    {
        //recuperar datos del filtro
        $texto=trim($request->get('busqueda'));
        $pedido = Pedido::where('nombreCliente', 'like', '%' . $texto . '%')->get();
        return view('Menu/Cocina/Terminados', compact('pedido','texto'));
    }
    public function pedido_pendientes(Request $request)
    {
        $pedido = Pedido::where('estado','=','0')->paginate(10);
        //recuperar datos del filtro
        $texto=trim($request->get('busqueda'));
        $pedido = Pedido::where('nombreCliente', 'like', '%' . $texto . '%')->paginate(10);
        return view('Menu/Cocina/Pedidospendientes', compact('pedido','texto'));
    }
    public function terminarp(Request $request,  $id)
    {
        $activar = Pedido::findOrfail($id);
        $activar->estado = $request->input('estado');

        $create = $activar->save();

        if ($create) {
            return redirect()->route('pedidost.pedido')->with('mensaje', 'El pedido fue terminado exitosamente!');
        }
    } 
    public function pedidosPendientes_Cocina(Request $request,  $id)
    {
        $activar = Pedido::findOrfail($id);
        $activar->estado = $request->input('estado');

        $create = $activar->save();

        if ($create) {
            return redirect()->route('pedidosp.pedido')->with('mensaje', 'El pedido fue completado con exito!');
        }
    }

    public function detalle_pedido_terminados($id){
        $pedido = Pedido::findOrfail($id);
        return view('Menu/Cocina/detallecaja', compact('pedido'));
    }

    public function detalle_pedido_pendientes($id){
        $pedido = Pedido::findOrfail($id);
        return view('Menu/Cocina/detallecocina', compact('pedido'));
    }

    public function detalle_terminados($id){
        $pedido = Pedido::findOrfail($id);
        return view('Menu/Cocina/detalleterminado', compact('pedido'));
    }

    public function pedidos_anteriores(Request $request)
    {
        //recuperar datos
        $texto=trim($request->get('busqueda'));
        $pedido = Pedido::where('nombreCliente', 'like', '%' . $texto . '%')->get();
        return view('Menu/Cocina/PedidosAnteriores', compact('pedido','texto'));
    }

    //borrar datos de los pedidos anteriores
    public function borrarDatos(){
        $cliente= DB::table('Pedidos')->delete();
        return back()->with('mensaje', 'Datos Borrados Satisfactoriamente.'); 
      }

    public function detalles_anteriores($id){
        $pedido = Pedido::findOrfail($id);
        return view('Menu/Cocina/detallesPedAnteriores', compact('pedido'));
    }
}


