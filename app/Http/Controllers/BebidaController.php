<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bebida;
use App\Models\Producto;
use Illuminate\Http\Request;

class BebidaController extends Controller
{

    public function activar(Request $request, $id)
    {
        $p = Producto::findOrfail($id);
        $p->estado = $request->input('activar');
        $create = $p->save();

        if ($create) {
            if ($p->estado == 1) {
                return back()->with('mensaje', 'Bebida Activada correctamente');
            }else{
                return back()->with('mensaje', 'Bebida Desactivada correctamente');
            }
        }

    }

    public function destroy($id){

        $platillo = Producto::findOrFail($id);
        $platillo->delete();
        return back()->with('mensaje', 'Bebida borrada correctamente');

    }
}
