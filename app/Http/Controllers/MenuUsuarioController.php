<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\DetallesPedido;
use App\Models\Kiosko;
use App\Models\Mesa;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

class MenuUsuarioController extends Controller
{
    /*Visualizar el menu por usuario*/
         
    public function prueba()
    {
         // Verificar si hay una mesa disponible
    $mesas = Mesa::where('estadoM', '=', 0)->count();
    if ($mesas == 0) {
        return redirect()->route("index")->with('mensaje', 'No hay mesas disponibles.');
    }
 
        $pedido = Pedido::where('estado', '=', '0')->first();

        if (!$pedido) {
            $pedido = new Pedido();
            $pedido->estado = 0;
            $pedido->quiosco = 0;
            $pedido->nombreCliente = "";
            $pedido->imp = 0;
            $pedido->total = 0;
            $pedido->mesa_id = Mesa::where('estadoM', '=', 0)->first()->id; //selecciona la primera mesa disponible.
            $pedido->save();

        }

        $productos = Producto::where('estado', '=', '1')->get();
        $mesas = Mesa::where('estadoM', '=', 0)->get();
        $kiosko = Kiosko::all();
        $detalles = DetallesPedido::where('pedido_id', '=', $pedido->id)->where('estado', '=', '0')->get();

        return view('Menu.Cliente.Prueba')->with('pedido', $pedido)->with('kiosko', $kiosko)
            ->with('productos', $productos)->with('detalles', $detalles)
            ->with('mesas', $mesas);
    }

    public function details(Request $request)

    {
        $pedido = DetallesPedido::where('estado', '=', '0')->get();

        if ($pedido->count() == 0){
        $detalle = new DetallesPedido();
        $detalle->pedido_id = $request->input('pedido');
        $detalle->producto_id = $request->input('producto');
        $detalle->cantidad = $request->input('cantidad');
        $detalle->precio = $request->input('precio');
        $detalle->save();
        return redirect()->route("cliente_prueba")->with('mensaje', 'Producto añadido');
        } 
            
        if ($pedido) {
            foreach ($pedido as  $v) {
                if ($v->producto_id == $request->input('producto')){
                    return redirect()->route("cliente_prueba")->with('mensaje', 'Producto existente'); 
                } else{
                    $detalle = new DetallesPedido();
                    $detalle->pedido_id = $request->input('pedido');
                    $detalle->producto_id = $request->input('producto');
                    $detalle->cantidad = $request->input('cantidad');
                    $detalle->precio = $request->input('precio');
                    $detalle->save();
                    return redirect()->route("cliente_prueba")->with('mensaje', 'Producto añadido');
                }
            } 
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

            $detalles = DetallesPedido::where('pedido_id', '=', $pedido->id)->where('estado', '=', '0')->get();
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

        $detal = DetallesPedido::findOrFail($id);
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
        DetallesPedido::destroy($id);
        return redirect()->route('cliente_prueba')->with('mensaje', 'Detalle borrado correctamente');
    }
}
