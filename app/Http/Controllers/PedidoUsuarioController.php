<?php

namespace App\Http\Controllers;

use App\Models\DetallesUsuario;
use App\Models\Mesa;
use App\Models\Pedido;
use Illuminate\Support\Facades\Session;
use App\Models\PiscinaUso;
use Database\Seeders\PlatillosyBebidasSeeder;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class PedidoUsuarioController extends Controller
{
    public function create()
    {
        return view("Menu.Cliente.pedido");
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
            $detalle = new DetallesUsuario();
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
            ->orwhere('estado', 2)->orderby('id')->get();
        $p = Mesa::all();
        $texto = "";
        return view('Menu/Cocina/Pedidoscaja', compact('pedido', 'texto', 'p'));
    }
    public function psearch(Request $request)
    {
        /*  $texto = trim($request->get('busqueda'));
$pedido = Pedido::where('nombreCliente', 'like', '%' . $texto . '%')
    ->orWhere('quiosco', 'like', '%' . $texto . '%')
    ->orWhereHas('mesa_nombre', function ($query) use ($texto) {
        $query->where('nombre', 'like', '%' . $texto . '%');
    })->paginate(10);
    return view('Menu/Cocina/Pedidosterminados', compact('pedido','texto'));
        //recuperar datos del filtro
     /*  $texto=trim($request->get('busqueda'));
        $pedido = Pedido::where('mesa', 'like', '%' . $texto . '%')
        ->orwhere('quiosco', 'like', '%' . $texto . '%')->paginate(10);
        return view('Menu/Cocina/Pedidosterminados', compact('pedido','texto'));*/
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
    /* public function env_a_caja(Request $request,  $id)
    {
        $request->validate([
            'estado' => 'required|in:2', // El campo estado es obligatorio y solo puede ser 1
        ]);
        $activar = Pedido::findOrfail($id);
        $activar->estado = $request->input('estado');

        $create = $activar->save();

        if ($create) {
            return redirect()->route('pedidost.pedido')->with('mensaje', 'Pedido enviado a caja!');
        }
    } */
    public function terminarp(Request $request,  $id)
    {
        $request->validate([
            'estado' => 'required|in:3', // El campo estado es obligatorio y solo puede ser 2
        ]);
        $activar = Pedido::findOrfail($id);
        $activar->estado = $request->input('estado');

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
        // $request->session()->put('envia_de_cocina', $request->input('envia_de_cocina'));
        $activar = Pedido::findOrfail($id);
        $activar->estado = $request->input('estado');
        $activar->estado_cocina = $request->input('estado_cocina');
        /* if ('estado_cocina' == 1) {
            dd('procesando');
        } elseif ('estado_cocina' == 2) {
            dd('entregar');
        } else {
            
        }*/
        $create = $activar->save();

        if ($create) {
            return redirect()->route('pedidosp.pedido')->with('mensaje', 'Pedido enviado a caja!');
        }
    }
    public function detalle_pedido_terminados($id)
{
    $pedido = Pedido::findOrFail($id);  
    $detapedido = DetallesUsuario::where('pedido_id', $id)->get();
  
    $suma = 0;
    $total_con_impuesto = 0;
    $impuesto = 0;

    foreach ($detapedido as $detalle) {
        $tasa_impuesto = 0.15;
        $suma += $detalle->precio * $detalle->cantidad;
        $impuesto = $suma * $tasa_impuesto;

        $total_con_impuesto = $suma + $impuesto;
    }

    return view('Menu/Cocina/detallecaja', compact('pedido', 'detapedido', 'total_con_impuesto', 'impuesto'));
}
   
    public function detalle_pedido_pendientes($id)
    {
        $detapedido = DetallesUsuario::where('pedido_id', $id)->get();
        $pedido = Pedido::findOrfail($id);
        $suma = 0;
        $total_con_impuesto = 0;
        $impuesto = 0;
        foreach ($detapedido as $detalle) {
            $tasa_impuesto = 0.15;
            $suma += $detalle->precio * $detalle->cantidad;
            $impuesto = $suma * $tasa_impuesto;

            $total_con_impuesto = $suma + $impuesto;
        }
        return view('Menu/Cocina/detallecocina', compact('pedido', 'detapedido', 'total_con_impuesto', 'impuesto'));
    }

    public function detalle_terminados($id)
    {
        $detapedido = DetallesUsuario::where('pedido_id', $id)->get();
        $pedido = Pedido::findOrfail($id);
        $suma = 0;
        $total_con_impuesto = 0;
        $impuesto = 0;
        foreach ($detapedido as $detalle) {
            $tasa_impuesto = 0.15;
            $suma += $detalle->precio * $detalle->cantidad;
            $impuesto = $suma * $tasa_impuesto;

            $total_con_impuesto = $suma + $impuesto;
        }
        return view('Menu/Cocina/detalleterminado', compact('pedido', 'detapedido', 'total_con_impuesto', 'impuesto'));
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
            return back()->with('errors', 'No hay pedidos para borrar.');
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
    public function destroy($id)
    {
        DetallesUsuario::destroy($id);
        return redirect()->route('pedidos.caja')->with('mensaje', 'Detalle borrado correctamente');
    }
    public function edit($pedido_id, $detalle_id)
    {
        $edit = DetallesUsuario::findOrFail($detalle_id);
        $pedido = Pedido::findOrfail($pedido_id);
        $productos = DetallesUsuario::pluck('nombre')->unique();
        return view('Menu/Cocina/editardetallecaja', compact('edit', 'pedido', 'productos'));
    }
    public function update(Request $request, $pedido_id, $detalle_id)
    {
        $request->validate([
            'cantidad' => ['required', 'numeric', 'digits_between:1,3', 'min:1'],
            'precio' => ['required', 'numeric', 'min:1'],
        ], [
            'cantidad.required' => 'La cantidad es obligatoria',
            'cantidad.numeric' => 'Solo se aceptan  números',
            'cantidad.min' => 'La cantidad minima es 1',
            'cantidad.digits_between' => 'Solo se permiten 3 dígitos',

            'precio.required' => 'La cantidad es obligatoria',
            'precio.numeric' => 'Solo se aceptan  números',
            'precio.min' => 'La cantidad minima es 1',
        ]);

        $detalle = DetallesUsuario::find($detalle_id);
        $pedido = $detalle->pedido;
        $detalle->nombre = $request->nombre;
        $detalle->cantidad = $request->input('cantidad');
        $detalle->precio = $request->input('precio');
        $impuesto = $detalle->precio * $detalle->cantidad * 0.15; // calcular el impuesto
        $total = $detalle->precio * $detalle->cantidad + $impuesto; // calcular el total

        $pedido->imp = $impuesto;
        $pedido->total = $total;

        $detalle->save();
        $pedido->save();
        return redirect()->route('pedidost.detalle', ['id' => $pedido_id])->with('mensaje', 'El detalle del pedido ha sido actualizado exitosamente.');
    }
/**Obtener el precio de los productos al seleccionarlos en el input nombre de la view editardetalles */
    public function obtenerPrecio(Request $request)
    {
        $producto = $request->input('producto');
        $precio = DB::table('detalles_usuarios')->where('nombre', $producto)->value('precio');
        Session::put('producto_precio', $precio);
        return $precio;
    }
}
