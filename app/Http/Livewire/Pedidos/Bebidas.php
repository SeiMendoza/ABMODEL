<?php

namespace App\Http\Livewire\Pedidos;

use App\Models\Producto;
use Livewire\Component;

class Bebidas extends Component
{
    protected $listeners = ['eliminar_item', 'cambiar_Cant', 'cambiar_Cant2', 'editar', 'vaciar', 'guardar'];
    
    public function render()
    {  
        return view('livewire.pedidos.bebidas')->with([
            'products' => Producto::where('estado', '=', '1')
            ->where('tipo', '=', '1')->get(),
            'items' => \Cart::getContent()
        ])->extends('livewire.pedidos.pedido')
          ->section('productos');
    }
    function addTodo(Producto $pro)
    {
        $c = \Cart::get($pro->id);
        $value = Producto::findOrFail($pro->id);
        $d = \Cart::getContent();
        if ($value->disponible > 1 & !$c) {
            $it = 1;
            foreach ($d as $key => $v) {
                if ($it == $v->attributes->it) {
                $it = $v->attributes->it + 1;
                } else {
                    $it = $v->attributes->it + $it;
                } 
            }

            \Cart::add(array(
                'id' => $pro->id, // inique row ID
                'name' => $pro->nombre,
                'price' => $pro->precio,
                'quantity' => 1,
                'attributes' => array(
                    'it' => $it,
                ),
                'associatedModel' => $pro
            ));
        } else {
            if ($value->disponible >=1 & $c->quantity < $value->disponible) {
                \Cart::update($pro->id, array(
                    'quantity' => array(
                        'relative' => true,
                        'value' => 1,
                    )
                )); 
            } else {
                return back();
            }
        }
        
        $this->emitTo('pedidos.detalles-pedido', 'addTodo');
        $this->emitTo('pedidos.mostrar', 'addTodo');
    }
    public function eliminar_item(){
    }
    public function cambiar_Cant(){
    }
    public function cambiar_Cant2(){
    }
    public function editar(){
    }
    public function vaciar(){
    }
    public function guardar(){
    }
}
