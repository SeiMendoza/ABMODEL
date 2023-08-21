<?php

namespace App\Http\Livewire\Pedidos;

use App\Models\DetallesPedido as ModelsDetallesPedido;
use App\Models\Mesa;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
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
        $productos = \Cart::getContent();
        $mesas = Mesa::where('estadoM', '=', 0)->get();
        return view('livewire.pedidos.detalles-pedido', compact('mesas','productos'));
    }
    public function editar($id, $q){

        $item = \Cart::get($id);
        $value = Producto::findOrFail($id);
        $r = $item->quantity + $value->disponible;
        if ($q >= 1 & $value->disponible >= 1) {
            if ($q > $r) {
                return back();
            } elseif ($q <= $r & $q > $item->quantity) {
                $s = $q - $item->quantity;
                $value->disponible = $value->disponible - $s;
                $value->save();
                \Cart::update($id, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $q
                    )   
                ));
            }elseif ($q <= $r & $q < $item->quantity) {
                $s = $item->quantity - $q;
                $value->disponible = $value->disponible + $s;
                $value->save();
                \Cart::update($id, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $q
                    )   
                ));
            }   
        } elseif ($q <= 1) {
            $value->disponible = $value->disponible + $item->quantity;
            $value->save();
            \Cart::remove($id);
        }
        $this->emitTo('pedidos.menu', 'editar');
        $this->emitTo('pedidos.complementos', 'editar');
    }

    public function eliminar_item($id, $q){
        $value = Producto::findOrFail($id);
        $value->disponible = $value->disponible + $q;
        $value->save();

        \Cart::remove($id);

        $this->emitTo('pedidos.menu', 'eliminar_item');
        $this->emitTo('pedidos.complementos', 'eliminar_item');
    }

    public function vaciar(){
        $items = \Cart::getContent();
            
            foreach($items as $row) {
                $value = Producto::findOrFail($row->id);
                $value->disponible = $value->disponible + $row->quantity;
                $value->save();
            }
        \Cart::clear();
        
        $this->emitTo('pedidos.menu', 'vaciar');
        $this->emitTo('pedidos.complementos', 'vaciar');
        
        return back()->with('mensaje', 'Pedido Cancelado');  
    }

    public function cambiar_Cant($id, $q)
    {
        $item = \Cart::get($id);
        $value = Producto::findOrFail($id);
        if ($item->quantity > 1) {
            $value->disponible = $value->disponible + 1;
            $value->save();
            \Cart::update($id, array(
                'quantity' => array(
                    'relative' => true,
                    'value' => - 1,
                )
            ));
            
        } elseif ($item->quantity <= 1) {
            $value->disponible = $value->disponible + 1;
            $value->save();
            \Cart::remove($id);
        }

          
        $this->emitTo('pedidos.menu', 'cambiar_Cant');
        $this->emitTo('pedidos.complementos', 'cambiar_Cant');
    }
    public function cambiar_Cant2($id, $q)
    {
        $item = \Cart::get($id);
        $value = Producto::findOrFail($id);
        if ($item->quantity >= 1 & $value->disponible >=1) {
            $value->disponible = $value->disponible - 1;
            $value->save();
            \Cart::update($id, array(
                'quantity' => array(
                    'relative' => true,
                    'value' => 1,
                )
            )); 
        } else {
            return back();
        }
        $this->emitTo('pedidos.menu', 'cambiar_Cant2');
        $this->emitTo('pedidos.complementos', 'cambiar_Cant2');
    }

    public function guardar(Request $request)
    {   
        $request->validate([
            'name' => ['required'],
            'mesa' => ['required'],
            't' => ['min:1'],
        ], [
            'nombre.required' => 'No tiene un nombre ingresado',
            'mesa.required' => 'Seleccione una mesa',
            't.min' =>'No hay detalles'
        ]);

        $m = Mesa::findOrFail($request->input('mesa')); 
        $pedido = new Pedido();

            $pedido->quiosco = $m->kiosko->id;
            $pedido->nombreCliente = $request->input('name');
            $pedido->imp = (\Cart::getTotal() * 0.15 );
            $pedido->total = \Cart::getTotal();
            $pedido->estado = 1;
            $pedido->mesa_id = $request->input('mesa');
            $pedido->save();

            $mesa = Mesa::findOrFail($pedido->mesa_id);
            $mesa->estadoM = 1;
            $mesa->save();

            
            $items = \Cart::getContent();
            
            foreach($items as $row) {
            $detalle = new ModelsDetallesPedido();
            $detalle->pedido_id = $pedido->id;
            $detalle->producto_id = $row->id;
            $detalle->precio = $row->price;
            $detalle->estado = 1;
            $detalle->cantidad = $row->quantity;
            $detalle->save();
            }


           /* foreach ($pedido->detalles as $value) {
                $producto = Producto::findOrFail($value->producto_id);
                $producto->disponible = $producto->disponible - $value->cantidad;
                $producto->save();
            }*/

            $a = $pedido->save();
            $b = $mesa->save();
            $c = $detalle->save();
           // $d = $producto->save();

            if ($c & $a & $b) {
                \Cart::clear();
                $this->emitTo('pedidos.menu', 'guardar');
                $this->emitTo('pedidos.complementos', 'guardar');
                return back()->with('mensaje', 'Pedido realizado');
            } else {
                #...
            }
    }

}
