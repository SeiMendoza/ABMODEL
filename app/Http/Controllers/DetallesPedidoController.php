<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Darryldecode\Cart\Cart;

class DetallesPedidoController extends Controller
{
    public function shop()
    {
        $products = Producto::all();
       //dd($products);
        return view('Menu.Cliente.menuCaja')->with(['products' => $products]);
    }
 

}
