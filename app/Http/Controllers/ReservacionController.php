<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reservacion;
use Illuminate\Http\Request;

class ReservacionController extends Controller
{
    public function index2()
    {
        $reservaciones = Reservacion::all();
        return view('Reservaciones.ReserAdmon.Mesas.mesasReservaciones',  compact('reservaciones'));
    }
    public function search2(Request $request)
    {
        $text = trim($request->get('buscar'));
        $reservaciones = Reservacion::where('nombre', 'like', '%' . $text . '%')->paginate(10);
        return view("Reservaciones.ReserAdmon.Mesas.mesasReservaciones", compact('reservaciones', 'text'));
    }
    public function store(Request $request){

        $request -> validate ([
            'nombre' => 'required|regex:/^[a-zA-Z\s\pLñÑ\.]+$/|max:100|min:3',   
        ],[
            'nombre.required' => 'El nombre no puede estar vacío',
            'nombre.regex'=> 'El nombre tiene caracteres no permitidos',
            'nombre.max' => 'El nombre es muy extenso',
            'nombre.min' => 'El nombre es muy corto',
        ]);

      
        $nuevo = new Reservacion;

        $nuevo->nombre = $request->input('nombre');              
        $creado = $nuevo -> save();

        if ($creado) {
            return redirect()->route('mesas_res.index')
            ->with('mensaje', "".$nuevo->nombre." creada correctamente");
        }
        
    }
    public function update(Request $request, $id){

        $request -> validate ([
            'nombre' => 'required|regex:/^[a-zA-Z\s\pLñÑ\.]+$/|max:100|min:3',   
        ],[
            'nombre.required' => 'El nombre no puede estar vacío',
            'nombre.regex'=> 'El nombre tiene caracteres no permitidos',
            'nombre.max' => 'El nombre es muy extenso',
            'nombre.min' => 'El nombre es muy corto',
        ]);

        $actualizacion = Reservacion::findOrFail($id);

        $actualizacion->nombre = $request->input('nombre');               
        $creado = $actualizacion -> save();

        if ($creado) {
            return redirect()->route('mesas_res.index')
            ->with('mensaje', "".$actualizacion->nombre." actualizada correctamente");
        } 
        
    }
    public function destroy($id){
        Reservacion::destroy($id);
        return redirect()->route('mesas_res.index')->with('mensaje', 'Reservación borrada correctamente');
    }
}
