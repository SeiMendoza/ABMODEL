<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kiosko;
use App\Models\Mesa;
use App\Models\Pedido;
use App\Models\Reservacion;
use Carbon\Carbon;
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

    public function index(Request $request){

        $kioskos = Kiosko::all();
        if($request->ajax()){
            
            $kioskos = Kiosko::select('id', 'codigo')->get();
            return response()->json($kioskos);
        }

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

        $rules=[
            'descripcion' => 'required|max:100|min:5',      
            'ubicacion' => 'required|max:100|min:5',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ];

        $messages=[
            'codigo.regex' => 'El código no es válido, un ejemplo válido es: K01',
        ];

        $this->validate($request, $rules, $messages);

        $kioskoUpdate = Kiosko::findOrFail($id);
        $kioskoUpdate->descripcion = $request->input('descripcion');
        $kioskoUpdate->ubicacion = $request->input('ubicacion');


        if($request->hasFile('imagen')){

            $oldImage = $kioskoUpdate->imagen; //gurada la ruta de la imagen anterior

            $file = $request->file('imagen');
            $destinationPath = 'images/kioskos/';
            $filename = time().'.'.$file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPath,$filename);
            $kioskoUpdate->imagen = 'images/kioskos/'.$filename;

        }

        $kioskoUpdate->save();
        if (@getimagesize($oldImage) && ($oldImage != $kioskoUpdate->imagen)){ //verifica si existe imagen anterior
            
            if(substr($oldImage, 0, 11) != 'https://via') // no es imagen del faker
                unlink($oldImage); //elimina la imagen anterior  
        }
        return to_route('kiosko.index')->with('mensaje', 'Kiosko actualizado correctamente');
    }

    public function destroy($id){

        $k = Kiosko::findOrFail($id);
        $k->reservaciones()->delete();
        $m = Mesa::where('kiosko_id', '=', $id);
        $p = Pedido::where('quiosco', '=', $id);
        $p->delete();
        $k->mesas()->delete();
        $k->delete();

        return to_route('kiosko.index')->with('mensaje', 'Kiosko eliminado correctamente');

    }

    public function detalle($id){

        $kiosko = Kiosko::findOrFail($id);
        $mesas = Mesa::whereKiosko_id($id)->get();
        return view('Reservaciones.ReserAdmon.Kioskos.detalleKiosko', compact('kiosko', 'mesas'));
    }

    public function reservaciones($id){
        
        $kiosko = Kiosko::findOrFail($id);
        $reservaciones = Reservacion::whereKiosko_id($id)->orderBy('fecha')->get();
        $now = Carbon::now()->format('Y-m-d');

        if(!$reservaciones->isEmpty())
            return view('Reservaciones.ReserAdmon.Kioskos.detallesReservacionKiosko', compact('reservaciones', 'kiosko', 'now'));
        else
            return back()->with(['mensaje' => 'No hay reservaciones en '. $kiosko->codigo], ['icon'=> 'info']);
    }

    public function reservacionesHistorial($id){

        $kiosko = Kiosko::findOrFail($id);
        $now = Carbon::now()->format('Y-m-d');
        $reservaciones = Reservacion::where('kiosko_id', '=', $id)->where('fecha', '<', $now)->orderBy('fecha')->get();

        if(!$reservaciones->isEmpty())
            return view('Reservaciones.ReserAdmon.Kioskos.detallesReservacionesAnterioresKiosko', compact('reservaciones', 'kiosko', 'now'));
        else
            return back()->with(['mensaje' => 'No hay historial de reservaciones'], ['icon'=> 'info']);
    }
}
