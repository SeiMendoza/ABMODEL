<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bebida;
use Illuminate\Http\Request;

class BebidaController extends Controller
{

    public function activar(Request $request, $id)
    {
        $platillo = Bebida::findOrfail($id);
        $platillo->estado = $request->input('activar');
        $create = $platillo->save();

        if ($create) {
            if ($platillo->estado == 1) {
                return redirect()->route('menuAdmon.index')->with('mensaje', 'Bebida Activada correctamente');
            }else{
                return redirect()->route('menuAdmon.index')->with('mensaje', 'Bebida Desactivada correctamente');
            }
        }

    }

    public function destroy($id){

        $platillo = Bebida::findOrFail($id);
        $platillo->delete();

        return redirect()->route('menuAdmon.index')->with('mensaje', 'Platillo borrado correctamente');

    }
}
