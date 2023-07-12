<?php

namespace App\Http\Controllers;

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
        return view('Menu.Cliente.menuCaja');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        return redirect()->route('cart.index')->with('success_msg', 'Cart is Updated!');
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
        return back();
    }

}