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
         
     public function prueba(){
        $platillos = Platillo::where('estado', '=', '1')->get();
        $bebidas = Bebida::where('estado', '=', '1')->get();
        $combos = Combo::where('estado', '=', '1')->get();
        $mesas = Mesa::where('estadoM', '=', 0)->get();
        $pedido = Pedido::where('estado', '=', '0')->get();
        $detalles = DetallesUsuario::where('estado', '=', '0')->get();
        if ($pedido->count() == 0) {
            $pedido_new = new Pedido();
            $pedido_new->estado_compra = '0';
            $pedido_new->save();

            return view('Menu.Cliente.Prueba')->with('pedido', $pedido_new)
                ->with('platillos', $platillos)->with('combos', $combos)->with('detalles', $detalles)
                ->with('bebidas', $bebidas)->with('mesas', $mesas); 
        } 

        return view('Menu.Cliente.Prueba')->with('pedido', $pedido[0])
        ->with('platillos', $platillos)->with('combos', $combos)->with('detalles', $detalles)
        ->with('bebidas', $bebidas)->with('mesas', $mesas);
     }
    public function details(Request $request)
    {
        $detalles = new DetallesUsuario();
        $detalles->pedido_id = $request->input('pedido');
        $detalles->producto = $request->input('producto');
        $detalles->nombre = $request->input('nombre');
        $detalles->cantidad = $request->input('cantidad');
        $detalles->precio = $request->input('precio');
        $detalles->save();

        return redirect()->route('cliente_prueba');
    }
     public function qr(){
        return view('Menu/Admon/QR_Menu');
     }

     public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required'],
            'mesa' => ['required'],
            't' => ['min:1'],

        ], [
            'name.required' => 'No tiene un nombre ingresado',
            'mesa.required' => 'Seleccione una mesa',
            //'t.required' => 'El pedido esta vacio',
            't.min' => 'El pedido esta vacio',
        ]);

        
        $pedido = new Pedido();
        $pedido->quiosco = $request->input('kiosko');
        $pedido->nombreCliente = $request->input('nombre');
        $pedido->imp = $request->input('isv');
        $pedido->total = $request->input('t');
        $pedido->mesa_id = $request->input('mesa');
        $pedido->save();

        $pedido->detalles_usuarios;
        
        /*foreach ($pedido as $key => $value) {
            $d = DetallesUsuario::findOrFail($value->detalles_usuario->pedido_id);
            $d->estado = 1;
            $d->save();
        }*/

        return redirect()->route("cliente_prueba")->with('mensaje', 'El pedido fue enviado exitosamente');
    }

    public function destroy($id)
    {
        DetallesUsuario::destroy($id);
        return redirect()->route('cliente_prueba')->with('mensaje', 'Detalle borrado correctamente');
    }
}
