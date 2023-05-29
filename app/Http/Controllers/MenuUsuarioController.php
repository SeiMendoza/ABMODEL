<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Bebida;
use App\Models\Combo;
use App\Models\DetallesUsuario;
use App\Models\Kiosko;
use App\Models\Mesa;
use App\Models\Pedido;
use Illuminate\Http\Request;
use App\Models\Platillo;
use Illuminate\Validation\Rules\Exists;

class MenuUsuarioController extends Controller
{
    /*Visualizar el menu por usuario*/
         
    public function prueba()
    {
        $pedido = Pedido::where('estado', '=', '0')->first();

        if (!$pedido) {
            $pedido = new Pedido();
            $pedido->estado = 0;
            $pedido->quiosco = 0;
            $pedido->nombreCliente = "";
            $pedido->imp = 0;
            $pedido->total = 0;
            $pedido->mesa_id = 1; 
            $pedido->save();

        }

        $platillos = Platillo::where('estado', '=', '1')->get();
        $bebidas = Bebida::where('estado', '=', '1')->get();
        $combos = Combo::where('estado', '=', '1')->get();
        $mesas = Mesa::where('estadoM', '=', 0)->get();
        $kiosko = Kiosko::all();
        $detalles = DetallesUsuario::where('pedido_id', '=', $pedido->id)->where('estado', '=', '0')->get();

        return view('Menu.Cliente.Prueba')->with('pedido', $pedido)->with('kiosko', $kiosko)
            ->with('platillos', $platillos)->with('combos', $combos)->with('detalles', $detalles)
            ->with('bebidas', $bebidas)->with('mesas', $mesas);
    }

    public function details(Request $request)

    {
        $pedido = DetallesUsuario::where('estado', '=', '0')->get();

        if ($pedido){
        $detalle = new DetallesUsuario();
        $detalle->pedido_id = $request->input('pedido');
        $detalle->producto = $request->input('producto');
        $detalle->nombre = $request->input('nombre');
        $detalle->cantidad = $request->input('cantidad');
        $detalle->precio = $request->input('precio');
        $detalle->save();
        return redirect()->route("cliente_prueba")->with('mensaje', 'Producto añadido');
        } else{
            return redirect()->route("cliente_prueba")->with('mensaje', 'Producto existente');
        }
       

        
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
            't.min' => 'El pedido esta vacio',
        ]);

        $kiosko = Mesa::findOrFail($request->input('mesa')); 
        $pedido = Pedido::findOrFail($request->input('pedido'));

        if ($request->input('t') > 0) {
            $pedido->quiosco = $kiosko->kiosko->id;
            $pedido->nombreCliente = $request->input('nombre');
            $pedido->imp = $request->input('isv');
            $pedido->total = $request->input('t');
            $pedido->estado = 1;
            $pedido->mesa_id = $request->input('mesa');
            $pedido->save();

            $mesa = Mesa::findOrFail($request->input('mesa'));
            $mesa->estadoM = 1;
            $mesa->save();

            $detalles = DetallesUsuario::where('pedido_id', '=', $pedido->id)->where('estado', '=', '0')->get();
            foreach ($detalles as $detalle) {
                $detalle->estado = 1;
                $detalle->save();
            }

            return redirect()->route("cliente_prueba")->with('mensaje', 'El pedido fue enviado exitosamente');
        }
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'numb' => ['required','numeric','min:1'],

        ], [
            'numb.required' => 'La cantidad no puede estar vacia',
            'numb.numeric' => 'La cantidad debe ser numérica',
            'numb.min' => 'La cantidad no puede ser menor a 1',
        ]);

        $detal = DetallesUsuario::findOrFail($id);
        $detal->cantidad = $request->input('numb');
        //$detal->save();
        $creado = $detal -> save();

        if ($creado) {
            return redirect()->route('cliente_prueba')
            ->with('mensaje', "".$detal->nombre." actualizada correctamente");
        } 
    }

    public function destroy($id)
    {
        DetallesUsuario::destroy($id);
        return redirect()->route('cliente_prueba')->with('mensaje', 'Detalle borrado correctamente');
    }
}
