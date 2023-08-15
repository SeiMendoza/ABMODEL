<?php

namespace App\Http\Livewire\Pedidos;

use App\Models\Mesa;
use App\Models\Producto;
use Cart;
use Livewire\Component;

class Menu extends Component
{
    //public $products = Producto::where('estado', '=', '1')->get();
    public $cart;
    protected $listeners = ['eliminar_item'];
    public function render()
    {  
        return view('livewire.pedidos.menu')->with([
            'products' => Producto::where('estado', '=', '1')->get()
        ]);
        
    }

    public function index()
    {   
        return view('livewire.pedidos.bebidas', [
            'products' => Producto::where('estado', '=', '1')
            ->get()
        ]);
        
    }

    function addTodo(Producto $pro)
    {
        $value = Producto::findOrFail($pro->id);
        $value->disponible = $value->disponible - 1;
        $value->save();
        $it =+ 1;
        Cart::add(array(
            'id' => $pro->id, // inique row ID
            'name' => $pro->nombre,
            'price' => $pro->precio,
            'quantity' => 1,
            'attributes' => array(
                'it' => 1,
            ),
            'associatedModel' => $pro
        ));

        $this->emitTo('pedidos.detalles-pedido', 'addTodo');
    }

    public function eliminar_item(){
    }
}
