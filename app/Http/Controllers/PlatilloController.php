<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Platillo;
use Illuminate\Http\Request;

class PlatilloController extends Controller
{
    public function activar(Request $request, $id)
    {
        $platillo = Platillo::findOrfail($id);
        $platillo->estado = $request->input('activar');
        $create = $platillo->save();

        if ($create) {
            if ($platillo->estado == 1) {
                return redirect()->route('menuAdmon.index')->with('mensaje', 'Platillo Activado correctamente');
            }else{
                return redirect()->route('menuAdmon.index')->with('mensaje', 'Platillo Desactivado correctamente');
            }
        }

    }

    public function destroy($id){

        $platillo = Platillo::findOrFail($id);
        $platillo->delete();

        return redirect()->route('menuAdmon.index')->with('mensaje', 'Platillo borrado correctamente');

    }
}