<?php

namespace App\Http\Livewire\Pedidos;

use App\Models\Mesa;
use App\Models\Producto;
use Cart;
use Livewire\Component;

class DetallesPedido extends Component
{

    public $cart;

    protected $listeners = ['addTodo'];

    public function addTodo(){
        
    }
    public function render()
    {
        $productos = Cart::getContent();
        $mesas = Mesa::where('estadoM', '=', 0)->get();
        return view('livewire.pedidos.detalles-pedido', compact('mesas','productos'));
    }
    public function editar($id, $q){
       
        Cart::update($id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $q
            )
        ));
    }

    public function eliminar_item($id, $q){
        $value = Producto::findOrFail($id);
        $value->disponible = $value->disponible + $q;
        $value->save();

        Cart::remove($id);

        $this->emitTo('pedidos.menu', 'eliminar_item');
    }

    public function clear(){
        $items = Cart::getContent();
            
            foreach($items as $row) {
                $value = Producto::findOrFail($row->id);
                $value->disponible = $value->disponible + $row->quantity;
                $value->save();
            }
        Cart::clear();
        return back()->with('mensaje', 'Pedido Cancelado');
    }

}
