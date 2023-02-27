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
        $operacion = "activado";

        if ($platillo->estado == 0) {
            //Si estaba desactivado lo activamos
            $platillo->estado = 1;
        } else {
            //Si estaba activado lo desactivamos
            $platillo->estado = 0;
            $operacion = 'desactivado';
        }

        $create = $platillo->save();

        if ($create) {
            return redirect()->route('menuAdmon.index')->with('mensaje', [$platillo->nombre, " ", $operacion, " satisfactoriamente"]);
        }

    }
}