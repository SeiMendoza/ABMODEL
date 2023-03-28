<?php

namespace App\Http\Controllers;

use App\Models\DetallesUsuario;
use App\Models\Pedido;
use App\Models\PiscinaUso;
use Database\Seeders\PlatillosyBebidasSeeder;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

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
    public function pedido_terminados()
    {
        $pedido = Pedido::where('estado',0)
        ->orwhere('estado',2)->paginate(10);
        $texto="";
        return view('Menu/Cocina/Pedidosterminados', compact('pedido','texto'));
    }
    public function psearch(Request $request)
    { 
        //recuperar datos del filtro
       $texto=trim($request->get('busqueda'));
        $pedido = Pedido::where('mesa', 'like', '%' . $texto . '%')
        ->orwhere('quiosco', 'like', '%' . $texto . '%')->paginate(10);
        return view('Menu/Cocina/Pedidosterminados', compact('pedido','texto'));
    }
    public function terminados()
    {
        $pedido = Pedido::where('estado',3)->paginate(10);
        $texto="";
        return view('Menu/Cocina/Terminados', compact('pedido','texto'));
    }
    public function search(Request $request)
    { 
        //recuperar datos del filtro
       $texto=trim($request->get('busqueda'));
        $pedido = Pedido::where('nombreCliente', 'like', '%' . $texto . '%')->paginate(6);
        return view('Menu/Cocina/Terminados', compact('pedido','texto'));
    }
    public function pedido_pendientes()
    { 
        $pedido = Pedido::where('estado_cocina',1)->paginate(10); 
        $texto="";
        //$pedido = Pedido::where('nombreCliente', 'like', '%' . $texto . '%')->paginate(5);
        return view('Menu/Cocina/Pedidospendientes', compact('pedido','texto'));
    }
    public function pcsearch(Request $request)
    { 
        //recuperar datos del filtro
       $texto=trim($request->get('busqueda'));
        $pedido = Pedido::where('nombreCliente', 'like', '%' . $texto . '%')->paginate(10);
        return view('Menu/Cocina/Pedidospendientes', compact('pedido','texto'));
    }

    public function env_a_cocina(Request $request,  $id)
    {
        $request->validate([
            'estado_cocina' => 'required|in:1', // El campo estado es obligatorio y solo puede ser 1
        ]);
        $activar = Pedido::findOrfail($id);
        $activar->estado_cocina = $request->input('estado_cocina');

        $create = $activar->save();

        if ($create) {
            return redirect()->route('pedidost.pedido')->with('mensaje', 'Pedido enviado a cocina!');
        }
    } 
   /* public function env_a_caja(Request $request,  $id)
    {
        $request->validate([
            'estado' => 'required|in:2', // El campo estado es obligatorio y solo puede ser 1
        ]);
        $activar = Pedido::findOrfail($id);
        $activar->estado = $request->input('estado');

        $create = $activar->save();

        if ($create) {
            return redirect()->route('pedidost.pedido')->with('mensaje', 'Pedido enviado a caja!');
        }
    } */
    public function terminarp(Request $request,  $id)
    {
        $request->validate([
            'estado' => 'required|in:3', // El campo estado es obligatorio y solo puede ser 2
        ]);
        $activar = Pedido::findOrfail($id);
        $activar->estado = $request->input('estado');

        $create = $activar->save();

        if ($create) {
            return redirect()->route('pedidost.pedido')->with('mensaje', 'El pedido fue terminado exitosamente!');
        }
    } 
   public function pedidosPendientes_Cocina(Request $request,  $id)
    {
        $request->validate([
            'estado' => 'required|in:2', // El campo estado es obligatorio y solo puede ser 1
            'estado_cocina' => 'required|in:2',
        ]);
       // $request->session()->put('envia_de_cocina', $request->input('envia_de_cocina'));
        $activar = Pedido::findOrfail($id);
        $activar->estado = $request->input('estado'); 
        $activar->estado_cocina = $request->input('estado_cocina');
       /* if ('estado_cocina' == 1) {
            dd('procesando');
        } elseif ('estado_cocina' == 2) {
            dd('entregar');
        } else {
            
        }*/
       $create = $activar->save();

        if ($create) {
            return redirect()->route('pedidosp.pedido')->with('mensaje', 'Pedido enviado a caja!');
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


