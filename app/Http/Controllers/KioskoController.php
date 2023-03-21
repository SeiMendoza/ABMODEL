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
        $file = $request->file('imagen');
        $destinationPath = 'images/kioskos/';
        $filename = time().'.'.$file->getClientOriginalName();
        $uploadSuccess = $request->file('imagen')->move($destinationPath,$filename);
        $kiosko->imagen = 'images/kioskos/'.$filename;

        $create = $kiosko->save();


        if ($create) {
            return to_route('kiosko.index')->with('mensaje', 'Kiosko registrado correctamente');
        }


    }

    public function index(){

        $kioskos = Kiosko::all();

        return view('/Reservaciones/ReserAdmon/Kioskos/indexKioskos')->with(['kioskos' => $kioskos]);
    }

    public function create(){
        return view('/Reservaciones/ReserAdmon/Kioskos/registroKioskos');
    }

    public function edit($id){

        $kiosko = Kiosko::findOrFail($id);

        return \view('Reservaciones.ReserAdmon.Kioskos.edicionKioskos')->with('k', $kiosko);
    }

    public function update(Request $request, $id){

        $kioskoUpdate = Kiosko::findOrFail($id);
        $kioskoUpdate->descripcion = $request->input('descripcion');
        $kioskoUpdate->ubicacion = $request->input('ubicacion');
        $kioskoUpdate->disponible = 1;
        $kioskoUpdate->cantidad_de_Mesas = $request->input('cantidad_de_Mesas');

        if(isset($k->imagen)){
            //Imagen
        $file = $request->file('imagen');
        $destinationPath = 'images/kioskos/';
        $filename = time().'.'.$file->getClientOriginalName();
        $uploadSuccess = $request->file('imagen')->move($destinationPath,$filename);
        $kioskoUpdate->imagen = 'images/kioskos/'.$filename;
        
        }

        $kioskoUpdate->save();

        $rules=[ 
            'descripcion' => 'required|max:100|min:3',      
            'cantidad_de_Mesas' => 'required|integer ', 
            'ubicacion' => 'required|max:100|min:3',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ];

        return to_route('kiosko.index')->with('mensaje', 'Kiosko actualizado correctamente!');
    }

    public function destroy($id){
        Kiosko::findOrFail($id)->delete();
        return to_route('kiosko.index')->with('mensaje', 'Kiosko Borrado correctamente!');

    }
}
