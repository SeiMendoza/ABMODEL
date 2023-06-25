<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kiosko;
use Illuminate\Http\Request;

class KioskoController extends Controller
{
    public function store(Request $request){

        $rules=[
            'codigo' => 'required|unique:kioskos|regex:/^[K][0-9][0-9]$/|min:3|max:3',
            'descripcion' => 'required|max:100|min:5',      
            'ubicacion' => 'required|max:100|min:5',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ];

        $messages=[
            'codigo.regex' => 'El código no es válido, un ejemplo válido es: K01',
        ];

        $this->validate($request, $rules, $messages);

        $kiosko = new Kiosko();
        $kiosko->codigo = $request->input('codigo');
        $kiosko->descripcion = $request->input('descripcion');
        $kiosko->ubicacion = $request->input('ubicacion');
        $kiosko->disponible = 1;
        $kiosko->cantidad_de_Mesas = 0;
       
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


        if($request->hasFile('imagen')){
            $file = $request->file('imagen');
            $destinationPath = 'images/kioskos/';
            $filename = time().'.'.$file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPath,$filename);
            $kioskoUpdate->imagen = 'images/kioskos/'.$filename;

        }else{
        }

        $kioskoUpdate->save();
        return to_route('kiosko.index')->with('mensaje', 'Kiosko actualizado correctamente');
    }

    public function destroy($id){

        $k = Kiosko::findOrFail($id);
        $k->reservaciones()->delete();
        $k->mesas()->delete();
        $k->delete();

        return to_route('kiosko.index')->with('mensaje', 'Kiosko eliminado correctamente');

    }
}
