<?php

namespace App\Http\Livewire\Pedidos;

use Livewire\Component;
use Cart;

class Mostrar extends Component
{

    protected $listeners = ['addTodo','eliminar_item', 'cambiar_Cant', 'cambiar_Cant2', 'editar', 'vaciar', 'guardar'];

    public function addTodo(){     
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
    public function render()
    {
        return view('livewire.pedidos.mostrar');
    }
}
