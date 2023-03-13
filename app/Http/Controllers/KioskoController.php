<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kiosko;
use Illuminate\Http\Request;

class KioskoController extends Controller
{
    public function store(Request $request){

        $rules=[
            'codigo' => 'required|numeric|unique:kioskos', 
            'descripcion' => 'required|max:100|min:3',      
            'cantidad_de_Mesas' => 'required|integer ', 
            'ubicacion' => 'required|max:100|min:3',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ];

        $this->validate($request, $rules);

        $kiosko = new Kiosko();
        $kiosko->codigo = $request->input('codigo');
        $kiosko->descripcion = $request->input('descripcion');
        $kiosko->ubicacion = $request->input('ubicacion');
        $kiosko->disponible = 1;
        $kiosko->cantidad_de_Mesas = $request->input('cantidad_de_Mesas');
       
        //Imagen
        $destinationPath = 'images/kioskos/';
        $filename = time().'.'.$request->imagen->extension();
        $request->imagen->move($destinationPath, $filename);
        $kiosko->imagen = 'images/kioskos' . $filename;

        $create = $kiosko->save();


        if ($create) {

            return to_route('kiosko.index')->with('mensaje', 'Kiosko registrado correctamente');
        }


    }

    public function index(){

        $kioskos = Kiosko::all();

        return view('/Reservaciones/ReserAdmon/index')->with(['kioskos' => $kioskos]);
    }

    public function create(){
        return view('/Reservaciones/ReserAdmon/registroKioskos');
    }
}
