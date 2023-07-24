<?php

namespace App\Http\Controllers;

use App\Models\DetallesPedido;
use App\Models\Mesa;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Cart;
use Darryldecode\Cart\Cart as CartCart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Producto::where('estado', '=', '1')->get();
        return view('Menu.Pedido.Pedido', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Cart::add(array(
            'id' => $request->id, // inique row ID
            'name' => $request->name,
            'price' =>$request->price,
            'quantity' => $request->quantity?$request->quantity:1,
            'attributes' => array(
                'color' => $request->color,
                'size' => $request->tamano,
            )
        ));
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        /*$request->validate([
            'nombre' => ['required'],
            'mesa' => ['required'],
            't' => ['min:1'],
        ], [
            'name.required' => 'No tiene un nombre ingresado',
            'mesa.required' => 'Seleccione una mesa',
            't.min' => 'El pedido esta vacio',
        ]);*/

        //$kiosko = Mesa::findOrFail($request->input('mesa')); 
        $pedido = new Pedido();

        //if ($request->input('t') > 0) {
            $pedido->quiosco = 1;
            $pedido->nombreCliente = "Fulano";
            $pedido->imp = (Cart::getTotal() * 0.15 );
            $pedido->total = Cart::getTotal();
            $pedido->estado = 1;
            $pedido->mesa_id = 1;
            $pedido->save();

            $mesa = Mesa::findOrFail($pedido->mesa_id);
            $mesa->estadoM = 1;
            $mesa->save();

            
            $items = Cart::getContent();
            
            foreach($items as $row) {
            $detalle = new DetallesPedido();
            $detalle->pedido_id = $pedido->id;
            $detalle->producto_id = $row->id;
            $detalle->precio = $row->price;
            $detalle->cantidad = $row->quantity;
            $detalle->save();
            }

            $a = $pedido->save();
            $b = $mesa->save();
            $c = $detalle->save();

            if ($a & $b & $c ) {
                return redirect()->route('cart.index')->with('success_msg', 'Pedido Realizado');
            } else {
                return redirect()->route('cart.index')->with('success_msg', 'Pedido No Realizado');
            }
            
        //}
        //}else{
            
        //}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ver()
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Cart::update($request->id,
            array(
                'quantity' => 1));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cart)
    {
        Cart::remove($cart);
        return back();
    }
    
    public function clear(){
        Cart::clear();
        return redirect()->route('cart.index')->with('success_msg', 'Car is cleared!');
    }

}