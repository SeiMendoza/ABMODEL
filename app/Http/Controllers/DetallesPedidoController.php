<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Cart;

class DetallesPedidoController extends Controller
{
    public function index()
    {
        $products = Producto::all();
        return view('Menu.Pedido.Pedido')->with(['products' => $products]);
    }
 

}
