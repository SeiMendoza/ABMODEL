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
        $products = Producto::where('estado', '=', '1')->where('disponible', '>=', '1')->get();
        $mesas = Mesa::where('estadoM', '=', '0')->get();
        return view('Menu.Pedido.todoPedidos', compact('products', 'mesas'));
    }

    public function bebidas()
    {
        $products = Producto::where('estado', '=', '1')
                    ->where('tipo', '=', '1')
                    ->where('disponible', '>=', '1')->get();
        $mesas = Mesa::where('estadoM', '=', '0')->get();
        return view('Menu.Pedido.bebidasPedido', compact('products', 'mesas'));
    }

    public function platillos()
    {
        $products = Producto::where('estado', '=', '1')
                    ->where('tipo', '=', '2')
                    ->where('disponible', '>=', '1')->get();
        $mesas = Mesa::where('estadoM', '=', '0')->get();
        return view('Menu.Pedido.platillosPedido', compact('products', 'mesas'));
    }

    public function complementos()
    {
        $products = Producto::where('estado', '=', '1')
                    ->where('tipo', '=', '0')
                    ->where('disponible', '>=', '1')->get();
        $mesas = Mesa::where('estadoM', '=', '0')->get();
        return view('Menu.Pedido.complementosPedido', compact('products' , 'mesas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $value = Producto::findOrFail($request->id);
        $value->disponible = $value->disponible + $request->disponible;
        $value->save();
        
        Cart::add(array(
            'id' => $request->id, // inique row ID
            'name' => $request->name,
            'price' =>$request->price,
            'quantity' => $request->quantity?$request->quantity:1,
           
            'attributes' => array(
                'disponible' => $value->disponible,
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
        $request->validate([
            'nombre' => ['required'],
            'mesa' => ['required'],
            't' => ['min:1'],
        ], [
            'nombre.required' => 'No tiene un nombre ingresado',
            'mesa.required' => 'Seleccione una mesa',
            't.min' =>'No hay detalles'
        ]);

        $m = Mesa::findOrFail($request->input('mesa')); 
        $pedido = new Pedido();

        //if ($request->input('t') > 0) {
            $pedido->quiosco = $m->kiosko->id;
            $pedido->nombreCliente = $request->input('nombre');
            $pedido->imp = (Cart::getTotal() * 0.15 );
            $pedido->total = Cart::getTotal();
            $pedido->estado = 1;
            $pedido->mesa_id = $request->input('mesa');
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
            $detalle->estado = 1;
            $detalle->cantidad = $row->quantity;
            $detalle->save();
            }


            foreach ($pedido->detalles as $value) {
                $producto = Producto::findOrFail($value->producto_id);
                $producto->disponible = $producto->disponible - $value->cantidad;
                $producto->save();
            }

            $a = $pedido->save();
            $b = $mesa->save();
            $c = $detalle->save();
            $d = $producto->save();

            if ($c) {
                Cart::clear();
                return redirect()->route('cart.index')->with('mensaje', 'Pedido Realizado');
            } else {
                return redirect()->route('cart.index')->with('mensaje', 'Pedido No Realizado');
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
       $cantidad = 0;
            $item = Cart::get($request->id);
            $cantidad = $item->quantity;

            if ($cantidad > 1) {
                $value = Producto::findOrFail($request->id);
                $value->disponible = $value->disponible + $request->d;
                $value->save();
                
            } elseif ($cantidad <= 1) {
                $value = Producto::findOrFail($request->id);
                $value->disponible = $value->disponible + $request->d;
                $value->save();

                Cart::remove($id);
                return back();
            }

            Cart::update($request->id, 
            array( 
                'quantity' => -$request->d,
            ));
            
            
            
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $cart)
    {
        $value = Producto::findOrFail($request->id);
        $value->disponible = $value->disponible + $request->disponible;
        $value->save();

        Cart::remove($cart);
        return back();
    }
    
    public function clear(){
        $items = Cart::getContent();
            
            foreach($items as $row) {
                $value = Producto::findOrFail($row->id);
                $value->disponible = $value->disponible + $row->quantity;
                $value->save();
            }
        Cart::clear();
        return redirect()->route('cart.index')->with('mensaje', 'Pedido Cancelado');
    }

}