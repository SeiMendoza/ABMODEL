<?php

namespace App\Http\Livewire\Pedidos;

use App\Models\Mesa;
use App\Models\Producto;
use Cart;
use Livewire\Component;

class Menu extends Component
{
    protected $listeners = ['eliminar_item', 'cambiar_Cant', 'cambiar_Cant2', 'editar', 'vaciar', 'guardar'];
    
    public function render()
    {  
        return view('livewire.pedidos.menu')->with([
            'products' => Producto::where('estado', '=', '1')->get()
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
            
            $value->disponible = $value->disponible - 1;
            $value->save();

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
            if ($value->disponible >=1) {
                $value->disponible = $value->disponible - 1;
                $value->save();
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