<?php

namespace App\Http\Livewire\Pedidos;

use App\Models\Mesa;
use App\Models\Producto;
use Livewire\Component;

class Pedido extends Component
{
    public function todo()
    {
        return view('');
    }

    public function bebidas()
    {
        $products = Producto::where('estado', '=', '1')
                    ->where('tipo', '=', '1')
                    ->where('disponible', '>=', '1');
        $mesas = Mesa::where('estado', '=', 1);
        return view('livewire.pedidos.bebidasPedido', compact('products','mesas'));
    }

    public function platillos()
    {
        $products = Producto::where('estado', '=', '1')
                    ->where('tipo', '=', '2')
                    ->where('disponible', '>=', '1')->get();
        return view('livewire.pedidos.platillosPedido', compact('products'));
    }

    public function complementos()
    {
        $products = Producto::where('estado', '=', '1')
                    ->where('tipo', '=', '0')
                    ->where('disponible', '>=', '1')->get();
        return view('livewire.pedidos.complementosPedido', compact('products'));
    }
}
