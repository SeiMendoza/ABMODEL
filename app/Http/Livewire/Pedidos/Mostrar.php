<?php

namespace App\Http\Livewire\Pedidos;

use Livewire\Component;
use Cart;

class Mostrar extends Component
{

    protected $listeners = ['addTodo'];

    public function addTodo(){     
    }
    public function render()
    {
        return view('livewire.pedidos.mostrar');
    }
}
