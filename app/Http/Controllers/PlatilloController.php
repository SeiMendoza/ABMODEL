<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Platillo;
use App\Models\Producto;
use Illuminate\Http\Request;

class PlatilloController extends Controller
{
    public function activar(Request $request, $id)
    {
        $platillo = Producto::findOrfail($id);
        $platillo->estado = $request->input('activar');
        $create = $platillo->save();

        if ($create) {
            if ($platillo->estado == 1) {
                return back()->with('mensaje', 'Platillo '.$platillo->nombre .'  activado');
            }else{
                return back()->with('mensaje', 'Platillo '.$platillo->nombre .' Desactivado');
            }
        }

    }

    
}