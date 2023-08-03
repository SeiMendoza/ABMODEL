<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use App\Models\Pedido;
use App\Models\DetallesPedido;
use Illuminate\Support\Facades\Session;
use App\Models\Producto;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\DB;

class PedidoUsuarioController extends Controller
{
    public function create()
    {
        return view("Menu.Cliente.pedido");
    }
    public function Cambiar_mesa(Request $request, $id)
    {
        $rules = [
            'nueva_mesa' => 'exists:mesas,id',
        ];
        $mensaje = [
            'nueva_mesa.exists' => 'El nombre no existe',

        ];
        $this->validate($request, $rules, $mensaje);
        $pedido = Pedido::findOrFail($id);
        //nueva mesa seleccionada
        $mesaNueva = $request->input('nueva_mesa');

        //cambiar el estado de la mesa actual
        $mesaAct = Mesa::findOrFail($pedido->mesa_id);
        $mesaAct->estadoM = 0;
        $mesaAct->save();
        //muestra solo las mesas disponibles
        $mesas = Mesa::where('estadoM', 0)->get();
        //actualiza la mesa del pedido
        $pedido->mesa_id = $mesaNueva;

        //cambia el estado a la nueva mesa
        $mesaNueva = Mesa::findOrFail($mesaNueva);
        $mesaNueva->estadoM = 1;
        $mesaNueva->save();

        $pedido->save();
        return redirect()->route('pedidost.detalle', ['id' => $pedido->id])->with('mensaje', 'Pedido Actualizado');
    }
    public function store(Request $request)
    {
        $request->validate([
            'tuplas' => ['required'],
        ], [
            'name.required' => 'No tiene un nombre ingresado',
            'tuplas.required' => 'El pedido esta vacio',
        ]);

        $pedido = new Pedido();
        $pedido->quiosco = $request->input('quiosco');
        $pedido->nombreCliente = 'Sutano';
        $pedido->mesa_id = 3;
        $pedido->imp = 0.00;
        $pedido->total = 100;
        $pedido->save();

        for ($i = 0; $i < intval($request->input("tuplas")); $i++) {
            $array = explode(' ', $request->input("det-" . $i));
            $detalle = new DetallesPedido();
            $detalle->pedido_id = $pedido->id;
            $detalle->producto_id = 1;
            $detalle->cantidad = 1;
            $detalle->precio = 1;
            $detalle->save();
        }

        return redirect()->route("cliente_prueba")->with('mensaje', 'El pedido fue enviado exitosamente');
    }
    public function pedido_terminados()
    {
        $pedido = Pedido::where('estado', 0)
            ->orwhere('estado', 1)
            ->orwhere('estado', 2)
            ->orderby('id')
            ->get();
        $p = Mesa::all();
        $texto = "";
        return view('Menu/Cocina/Pedidoscaja', compact('pedido', 'texto', 'p'));
    }

    public function terminados()
    {
        $pedido = Pedido::where('estado', 3)->orderby('id')->get();
        $p = Mesa::all();
        $texto = "";
        return view('Menu/Cocina/Terminados', compact('pedido', 'texto', 'p',));
    }
    public function search(Request $request)
    {
        //recuperar datos del filtro 
        $texto = trim($request->get('busqueda'));
        $pedido = Pedido::where('nombreCliente', 'like', '%' . $texto . '%')
            ->orWhere('quiosco', 'like', '%' . $texto . '%')
            ->orWhereHas('mesa_nombre', function ($query) use ($texto) {
                $query->where('nombre', 'like', '%' . $texto . '%');
            })->paginate(10);
        return view('Menu/Cocina/Terminados', compact('pedido', 'texto'));
    }
    public function pedido_pendientes()
    {
        $pedido = Pedido::where('estado_cocina', 1)->orderby('id')->get();
        //$pedido = Pedido::where('estado_cocina',1)->paginate(10); 
        $texto = "";
        //$pedido = Pedido::where('nombreCliente', 'like', '%' . $texto . '%')->paginate(5);
        return view('Menu/Cocina/Pedidoscocina', compact('pedido', 'texto'));
    }
    public function pcsearch(Request $request)
    {
        //recuperar datos del filtro
        $texto = trim($request->get('busqueda'));
        $pedido = Pedido::where('nombreCliente', 'like', '%' . $texto . '%')
            ->orWhere('quiosco', 'like', '%' . $texto . '%')
            ->orWhereHas('mesa_nombre', function ($query) use ($texto) {
                $query->where('nombre', 'like', '%' . $texto . '%');
            })->paginate(10);
        return view('Menu/Cocina/Pedidoscocina', compact('pedido', 'texto'));
    }

    public function env_a_cocina(Request $request,  $id)
    {
        $request->validate([
            'estado_cocina' => 'required|in:1',
            'estado' => 'required|in:1', // El campo estado es obligatorio y solo puede ser 1
        ]);
        $activar = Pedido::findOrfail($id);
        $activar->estado_cocina = $request->input('estado_cocina');
        $activar->estado = $request->input('estado');
        $create = $activar->save();

        if ($create) {
            return redirect()->route('pedidos.caja')->with('mensaje', 'Pedido enviado a cocina!');
        }
    }

    public function terminarp(Request $request,  $id)
    {
        $request->validate([
            'estado' => 'required|in:3', // El campo estado es obligatorio y solo puede ser 2
        ]);
        $activar = Pedido::findOrfail($id);
        $kiosko = Mesa::findOrFail($request->input('mesa'));

        $activar->estado = $request->input('estado');
        $activar->quiosco = $kiosko->kiosko->id;
        $activar->mesa_id = $request->input('mesa');
        /**cambia el estado de la mesa */
        $mesa = Mesa::findOrFail($request->input('mesa'));
        $mesa->estadoM = 0;
        $mesa->save();
        $create = $activar->save();

        if ($create) {
            return redirect()->route('pedidos.caja')->with('mensaje', 'El pedido fue terminado exitosamente!');
        }
    }
    public function pedidosPendientes_Cocina(Request $request,  $id)
    {
        $request->validate([
            'estado' => 'required|in:2', // El campo estado es obligatorio y solo puede ser 1
            'estado_cocina' => 'required|in:2',
        ]);

        $activar = Pedido::findOrfail($id);
        $activar->estado = $request->input('estado');
        $activar->estado_cocina = $request->input('estado_cocina');

        $create = $activar->save();

        if ($create) {
            return redirect()->route('pedidosp.pedido')->with('mensaje', 'Pedido enviado a caja!');
        }
    }
    public function detalle_pedido_terminados($id)
    {

        $pedido = Pedido::findOrFail($id);
        $detapedido = DetallesPedido::where('pedido_id', $id)->get();
        $mesas = Mesa::where('estadoM', 0)->get();
        $suma = 0;
        $tasa_impuesto = 0.15;

        foreach ($detapedido as $detalle) {
            if ($detalle->estado == 1) {
                $suma += $detalle->precio * $detalle->cantidad;
            }
        }

        $sub = number_format($suma - $suma * $tasa_impuesto, 2, ".", ",");
        $isv = number_format($suma * $tasa_impuesto, 2, ".", ",");
        $tot = number_format($suma, 2, ".", ",");
        return view('Menu/Cocina/detallecaja', compact('pedido', 'detapedido', 'mesas', 'tot', 'sub', 'isv'));
    }
    public function Agregar($id, $tipo = null)
    {
        $mesas = Mesa::where('estadoM', '=', '0')->get();
        $pedido = Pedido::findOrFail($id);
        if ($tipo === 'todos') {
            $productos = Producto::where('estado', '=', '1')
                ->where('disponible', '>', 0)
                ->get();
        } else {
            // Asignar nombres descriptivos a cada tipo
            $tipos = [
                'complementos' => 0,
                'bebidas' => 1,
                'platillos' => 2,
            ];
            // Si se proporciona un valor de tipo, utilizar el nombre descriptivo
            $tipo = $tipos[$tipo] ?? null;
            // Filtrar productos por tipo si se proporciona un valor de tipo
            switch ($tipo) {
                case 0: // complementos
                    $productos = Producto::where('estado', '=', '1')
                        ->where('tipo', 0)
                        ->where('disponible', '>', 0)
                        ->get();
                    break;
                case 1: // bebidas
                    $productos = Producto::where('estado', '=', '1')
                        ->where('tipo', 1)
                        ->where('disponible', '>', 0)
                        ->get();
                    break;
                case 2: // platillos
                    $productos = Producto::where('estado', '=', '1')
                        ->where('tipo', 2)
                        ->where('disponible', '>', 0)
                        ->get();
                    break;
            }
        }
        $detalles = DetallesPedido::where('pedido_id', $id)->get();
        // si no hay complementos muestra mensaje
        /* if ($productos->isEmpty()) {
            return redirect()->route('pedidost.detalle', ['id' => $pedido->id])->with('mensaje', 'No hay complementos disponibles');
        }*/
        return view('Menu/Cocina/Nuevo_compl', compact('pedido', 'productos', 'detalles', 'mesas', 'tipo'));
    }
    public function Acomple(Request $request, $id)
    {
        // Obtener los datos enviados en el formulario
        $producto_id = $request->input('id');
        $producto_nombre = $request->input('name');
        $producto_precio = $request->input('price');
        $cantidad = $request->input('quantity');

        // Obtener el producto a partir de su ID
        $producto = Producto::find($producto_id);

        // Verificar si ya existe un complemento con el mismo producto y precio 
        $complemento_existente = DetallesPedido::where([
            ['pedido_id', '=', $id],
            ['producto_id', '=', $producto_id],
            ['precio', '=', $producto_precio],
        ])->first();

        if ($complemento_existente) {
            // Si el complemento ya existe solo se actualiza la cantidad
            $complemento_existente->cantidad += $cantidad;
            $complemento_existente->estado = 0;
            $complemento_existente->save();
        } else {
            // Crear un nuevo detalle del pedido con el producto y la cantidad
            if (!$producto) {
                return redirect()->back()->with('mensaje', 'El producto no existe.');
            }
            $complemento = new DetallesPedido();
            $complemento->pedido_id = $id;
            $complemento->producto_id = $producto->id;
            $complemento->cantidad = $cantidad;
            $complemento->precio = $producto_precio;
            $complemento->estado = 0;
            $complemento->save();
        }

        // Actualizar el impuesto y el total del pedido
        $pedido = Pedido::find($id);
        $detalles = $pedido->detalles;
        $total = 0;
        foreach ($detalles as $detalle) {
            $total += $detalle->cantidad * $detalle->precio;
        }
        $impuesto = $total * 0.15; // calcular el impuesto
        $pedido->imp = $impuesto;
        $pedido->total = $total;
        // $pedido->save();

        // Restar la cantidad disponible del producto
        $producto->disponible -= $cantidad;
        $producto->save();

        // Redirigir al usuario a la página de detalles del pedido con un mensaje de confirmación
        return redirect()->route('Agregar', ['id' => $pedido->id, 'tipo' => 'todos', 'vista' => 2])->with('mensaje', 'Producto añadido.');
    }

    public function Guardar(Request $request, $id, $detalle_id)
    {
        // Obtiene el pedido existente
        $pedido_actual = Pedido::findorfail($id);
        $rules=[
            'nombreC' => 'required|regex:/^[\\pL\\s]+$/u',
            'mesa' => 'required|exists:mesas,id',
        ];
        $mensaje=[
            'nombreC.required' => 'El nombre no puede estar vacío',
            'nombre.regex' => 'Solo se aceptan letras',
             'mesa.required' => 'Debe seleccionar una mesa',
             'mesa.exists' => 'La mesa seleccionada no existe'
        ];

        $this->validate($request,$rules,$mensaje);
        // Obtener los nuevos valores del formulario
        $nombreCliente = $request->input('nombreC');
        $mesa = $request->input('mesa');

        // Actualizar el registro del pedido con los nuevos valores
        $pedido_actual->nombreCliente = $nombreCliente;
        $pedido_actual->mesa_id = $mesa;
        $pedido_actual->save();
        // Obtiene los detalles del pedido actual
        $detalles_actual = $pedido_actual->detalles;
        $detalles_nuevo = $pedido_actual->detalles;

        $mesa_id = $pedido_actual->mesa_id;
        $mesa = Mesa::findOrFail($mesa_id);
        $quiosco = $mesa->kiosko->id;
        // Actualizar los detalles del pedido existente
        foreach ($detalles_actual as $detalle_actual) {
            $detalle_id = $detalle_actual->id;
            foreach ($detalle_actual as $detalle) {
                if ($detalle_id == $detalle_id) {
                    $detalle_actual->cantidad = $detalle_actual->cantidad;
                    $detalle_actual->precio = $detalle_actual->precio;
                    $detalle_actual->estado = 1;
                    $detalle_actual->save();
                    break;
                }
            }
        }
        // Agregar nuevos detalles al pedido
        foreach ($detalles_nuevo as $detalle) {
            if (!isset($detalle['id'])) {
                $detalle_nuevo = new DetallesPedido();
                $detalle_nuevo->producto_id = $detalle['producto_id'];
                $detalle_nuevo->cantidad = $detalle['cantidad'];
                $detalle_nuevo->precio = $detalle['precio'];
                $detalle_nuevo->estado = 1;
                $pedido_actual->detalles()->save($detalle_nuevo);
            }
        }
        // Actualizar el impuesto y el total del pedido
        $pedido_actual = Pedido::find($id);
        $detalles = $pedido_actual->detalles;
        $total = 0;
        foreach ($detalles as $detalle) {
            $total += $detalle->cantidad * $detalle->precio;
        }
        $impuesto = $total * 0.15; // calcular el impuesto
        $pedido_actual->imp = $impuesto;
        $pedido_actual->total = $total;

        $a = $pedido_actual->save();
        if ($a) {
            return redirect()->route('pedidost.detalle', ['id' => $pedido_actual->id])->with('mensaje', 'Pedido guardado correctamente.');
        }
    }
    public function detalle_pedido_pendientes($id)
    {
        $detapedido = DetallesPedido::where('pedido_id', $id)->get();
        $pedido = Pedido::findOrfail($id);
        $suma = 0;
        $tasa_impuesto = 0.15;

        foreach ($detapedido as $detalle) {
            $suma += $detalle->precio * $detalle->cantidad;
        }

        $sub = number_format($suma - $suma * $tasa_impuesto, 2, ".", ",");
        $isv = number_format($suma * $tasa_impuesto, 2, ".", ",");
        $tot = number_format($suma, 2, ".", ",");
        return view('Menu/Cocina/detallecocina', compact('pedido', 'detapedido', 'tot', 'sub', 'isv'));
    }

    public function detalle_terminados($id)
    {
        $detapedido = DetallesPedido::where('pedido_id', $id)->get();
        $pedido = Pedido::findOrfail($id);
        $suma = 0;
        $tasa_impuesto = 0.15;

        foreach ($detapedido as $detalle) {
            $suma += $detalle->precio * $detalle->cantidad;
        }

        $sub = number_format($suma - $suma * $tasa_impuesto, 2, ".", ",");
        $isv = number_format($suma * $tasa_impuesto, 2, ".", ",");
        $tot = number_format($suma, 2, ".", ",");
        return view('Menu/Cocina/detalleterminado', compact('pedido', 'detapedido', 'tot', 'sub', 'isv'));
    }

    public function pedidos_anteriores(Request $request)
    {
        //recuperar datos
        $texto = trim($request->get('busqueda'));
        $pedido = Pedido::where('nombreCliente', 'like', '%' . $texto . '%')->get();
        return view('Menu/Cocina/PedidosAnteriores', compact('pedido', 'texto'));
    }

    //borrar datos de los pedidos anteriores
    public function borrarDatos()
    {
        $cliente = DB::table('Pedidos')->where('estado', 3)->count();
        if ($cliente > 0) {
            DB::table('Pedidos')->where('estado', 3)->delete();
            return back()->with('mensaje', 'Pedidos borrados correctamente.');
        } else {
            return redirect()->route("terminados.terminados")->with('errors', 'No hay pedidos para borrar.');
        }
    }

    /*  public function borrarDatos()
    {
        $cliente = DB::table('Pedidos')->where('estado', 3)->delete();
        return back()->with('mensaje', 'Pedidos Borrados Satisfactoriamente.');
    }*/

    public function detalles_anteriores($id)
    {
        $pedido = Pedido::findOrfail($id);
        return view('Menu/Cocina/detallesPedAnteriores', compact('pedido'));
    }
    public function destroy($id, $vista)
    {
        $detalle = DetallesPedido::findOrfail($id);
        $pedido = $detalle->pedido;
        $detalle->estado = 0;
        $pedido->detalles()->where('id', $detalle->id)->delete();

        //sumar la cantidad disponible del producto borrado
        $producto = $detalle->producto;
        $producto->disponible += $detalle->cantidad;
        $producto->save();
        if ($vista == 1) {
            // si se eliminan todos los detalles del pedido se actualiza el estado de la mesa
            if ($pedido->detalles->count() == 0) {
                $mesa = $pedido->mesa_nombre;
                $mesa->estadoM = 0;
                $mesa->save();
                $pedido->delete();
                return redirect()->route('pedidos.caja')->with('mensaje', 'Detalles del pedido borrados');
            } else {
                // Actualizar el impuesto y el total del pedido general
                $detalles = $pedido->detalles;
                $total = 0;
                foreach ($detalles as $detalle) {
                    $total += $detalle->cantidad * $detalle->precio;
                }
                $impuesto = $total * 0.15; // calcular el impuesto
                $pedido->imp = $impuesto;
                $pedido->total = $total;
                $pedido->save();
                return redirect()->route('pedidost.detalle', $pedido->id)->with('mensaje', 'Detalle borrado correctamente');
            }
        } elseif ($vista == 2) {
            // si se eliminan todos los detalles del pedido se actualiza el estado de la mesa
            if ($pedido->detalles->count() == 0) {
                $mesa = $pedido->mesa_nombre;
                $mesa->estadoM = 0;
                $mesa->save();
                $pedido->delete();
                return redirect()->route('pedidos.caja')->with('mensaje', 'Detalles del pedido borrados');
            } else {
                // Actualizar el impuesto y el total del pedido general
                $detalles = $pedido->detalles;
                $total = 0;
                foreach ($detalles as $detalle) {
                    $total += $detalle->cantidad * $detalle->precio;
                }
                $impuesto = $total * 0.15; // calcular el impuesto
                $pedido->imp = $impuesto;
                $pedido->total = $total;
                $pedido->save();
                return redirect()->route('Agregar', ['id' => $pedido->id, 'tipo' => 'todos', 'vista' => 2])->with('mensaje', 'Detalle borrado correctamente');
            }
        }
    }
    public function edit($pedido_id, $detalle_id)
    {
        $edit = DetallesPedido::findOrFail($detalle_id);
        $pedido = Pedido::findOrfail($pedido_id);
        $productos = Producto::select('id', 'nombre')->where('estado', '=', '1')
            ->whereIn('tipo', ['0', '1', '2'])
            //->orwhere('disponible', '>', 0)
            ->get();
        // Agregar el precio del producto al input
        Session::put('producto_precio', $edit->precio);
        return view('Menu/Cocina/editardetallecaja', compact('edit', 'pedido', 'productos'));
    }
    public function update(Request $request, $pedido_id, $detalle_id)
    {
        $detalle = DetallesPedido::findOrFail($detalle_id);

        //muestra la cantidad que ya tiene el producto
        $cantidad_existente = $detalle->cantidad;

        //muestra la nueva cantidad ingresada al editar
        $cantidad_nueva = $request->input('cantidad');

        // si la cantidad nueva es mayo que la cantidad disponible hace la validacion
        if ($cantidad_nueva != $cantidad_existente) {
            $producto_id = $request->input('producto_id');
            $producto = Producto::where('id', $producto_id)->where('estado', '=', '1')
                ->firstOrFail();
            $disponible = $producto->disponible;
            $precio = $producto->precio;
            $request->validate([
                'cantidad' => ['required', 'numeric', 'min:1', 'max:' . $disponible],
                'precio' => ['required', 'numeric', 'min:' . $precio],
                'producto_id' => ['required', 'exists:productos,id']
            ], [
                'cantidad.required' => 'La cantidad es obligatoria',
                'cantidad.numeric' => 'Solo se aceptan  números',
                'cantidad.min' => 'La cantidad minima es 1',
                'cantidad.max' => 'La cantidad maxima no debe ser mayor a ' . $disponible,
                'precio.required' => 'La cantidad es obligatoria',
                'precio.numeric' => 'Solo se aceptan  números',
                'precio.min' => 'La cantidad minima es ' . $precio,
                'producto_id.required' => 'El nombre del producto es obligatorio',
                'producto_id.exists' => 'El nombre del producto no existe'
            ]);

            $detalle = DetallesPedido::findOrfail($detalle_id);
            $pedido = $detalle->pedido;
            $detalle->producto_id = $producto->id;
            $detalle->cantidad = $request->input('cantidad');
            $detalle->precio = $request->input('precio');
            $detalle->save();

            // Actualizar los impuestos y totales correspondientes en el objeto Pedido
            $detalles = $pedido->detalles;
            $total = 0;
            foreach ($detalles as $detalle) {
                $total += $detalle->cantidad * $detalle->precio;
            }
            $impuesto = $total * 0.15;
            $pedido->imp = $impuesto;
            $pedido->total = $total;
            $pedido->save();
            //restar la cantidad disponible del producto borrado
            $producto = $detalle->producto;
            $producto->disponible -= $detalle->cantidad;
            $producto->save();
        }
        return redirect()->route('pedidost.detalle', ['id' => $pedido_id])->with('mensaje', 'El detalle del pedido ha sido actualizado exitosamente.');
    }
    /**Obtener el precio de los productos al seleccionarlos en el input nombre de la view editardetalles */
    public function PrecioAcompl(Request $request)
    {
        $producto = Producto::find($request->producto);
        if ($producto) {
            $precio = $producto->precio;
            $descrip = $producto->descripcion;
            $imagen = asset($producto->imagen);
            return response()->json([
                'precio' => $precio,
                'imagen' => $imagen,
                'descrip' => $descrip
            ]);
        } else {
            return response()->json(null);
        }
    }
    public function cancelarPedido($pedido_id)
    {
        $detalles = DetallesPedido::where('pedido_id', $pedido_id)->where('estado', 0)->get();
        foreach ($detalles as $detalle) {
            $producto = $detalle->producto;
            $producto->disponible += $detalle->cantidad;
            $producto->save();
        }
        DetallesPedido::where('pedido_id', $pedido_id)->where('estado', 0)->delete();
        return response()->json(['success' => true]);
    }
}
