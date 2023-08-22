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
        if ($q >= 1 & $value->disponible >= 1) {
            if ($q > $value->disponible) {
                return back();
            } elseif ($q <= $value->disponible & $q > $item->quantity) {
                \Cart::update($id, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $q
                    )   
                ));
            }elseif ($q <= $value->disponible & $q < $item->quantity) {
                \Cart::update($id, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $q
                    )   
                ));
            }   
        } elseif ($q <= 0) {
            return back();
        }
        $this->emitTo('pedidos.menu', 'editar');
        $this->emitTo('pedidos.complementos', 'editar');
        $this->emitTo('pedidos.platillos', 'editar');
        $this->emitTo('pedidos.bebidas', 'editar');
    }

    public function eliminar_item($id, $q){
        \Cart::remove($id);

        $this->emitTo('pedidos.menu', 'eliminar_item');
        $this->emitTo('pedidos.complementos', 'eliminar_item');
        $this->emitTo('pedidos.platillos', 'eliminar_item');
        $this->emitTo('pedidos.bebidas', 'eliminar_item');
    }

    public function vaciar(){
        \Cart::clear();
        
        $this->emitTo('pedidos.menu', 'vaciar');
        $this->emitTo('pedidos.complementos', 'vaciar');
        $this->emitTo('pedidos.platillos', 'vaciar');
        $this->emitTo('pedidos.bebidas', 'vaciar');
        
        return back()->with('mensaje', 'Pedido Cancelado');  
    }

    public function cambiar_Cant($id, $q)
    {
        $item = \Cart::get($id);
        if ($item->quantity > 1) {
            \Cart::update($id, array(
                'quantity' => array(
                    'relative' => true,
                    'value' => - 1,
                )
            ));
            
        } elseif ($item->quantity <= 1) {
            return back();
        }

          
        $this->emitTo('pedidos.menu', 'cambiar_Cant');
        $this->emitTo('pedidos.complementos', 'cambiar_Cant');
        $this->emitTo('pedidos.platillos', 'cambiar_Cant');
        $this->emitTo('pedidos.bebidas', 'cambiar_Cant');
    }
    public function cambiar_Cant2($id, $q)
    {
        $item = \Cart::get($id);
        $value = Producto::findOrFail($id);
        if ($item->quantity >= 1 & $q < $value->disponible) {
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
        $this->emitTo('pedidos.platillos', 'cambiar_Cant2');
        $this->emitTo('pedidos.bebidas', 'cambiar_Cant2');
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


           foreach ($pedido->detalles as $value) {
                $producto = Producto::findOrFail($value->producto_id);
                $producto->disponible = $producto->disponible - $value->cantidad;
                $producto->save();
            }

            $a = $pedido->save();
            $b = $mesa->save();
            $c = $detalle->save();
            $d = $producto->save();

            if ($c & $a & $b & $d) {
                \Cart::clear();
                $this->emitTo('pedidos.menu', 'guardar');
                $this->emitTo('pedidos.complementos', 'guardar');
                $this->emitTo('pedidos.platillos', 'guardar');
                $this->emitTo('pedidos.bebidas', 'guardar');
                return back()->with('mensaje', 'Pedido realizado');
            } else {
                #...
            }
    }

}
