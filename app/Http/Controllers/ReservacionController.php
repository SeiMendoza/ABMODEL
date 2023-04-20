<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kiosko;
use App\Models\Reservacion;
use Illuminate\Http\Request;

class ReservacionController extends Controller
{
    public function index2()
    {
        $reservaciones = Reservacion::all();
        return view('Reservaciones.ReserAdmon.Quiosco.kioskoReservaciones',  compact('reservaciones'));
    }
    /*public function search2(Request $request)
    {
        $text = trim($request->get('buscar'));
        $reservaciones = Reservacion::where('nombre', 'like', '%' . $text . '%')->paginate(5);
        return view("Reservaciones.ReserAdmon.Quiosco.kioskoReservaciones", compact('reservaciones', 'text'));
    }*/
    public function create()
    {   $kiosko = Kiosko::all();
        return view('Reservaciones.ReserAdmon.Quiosco.formularioReservaciones', compact('kiosko'));
    }
    public function store(Request $request){
        $fecha_act = date("d-m-Y");
        $min = date('d-m-Y',$min = strtotime($fecha_act."+ 1 day"));

        $request -> validate ([
            'nombre' => 'required|regex:/^[a-zA-Z\s\pLñÑ\.]+$/|max:50|min:3',
            'celular' => 'required|numeric|regex:/^[2,3,8,9][0-9]{7}+$/|min_digits:8|max_digits:8|',
            'cantidad' => 'required|min:1|max:20|numeric|min_digits:1|max_digits:3',
            'fecha' => 'required|date|after:'.$min,   
            'hora' => 'required',   
            'pago' => 'required|min:100|max:8000|numeric', 
            'formaPago' => 'required',   
        ],[
            'nombre.required' => 'El nombre no puede estar vacío',
            'nombre.regex'=> 'El nombre tiene caracteres no permitidos',
            'nombre.max' => 'El nombre es muy extenso',
            'nombre.min' => 'El nombre es muy corto',
            'celular.required' => 'El número telefónico es obligatorio',
            'celular.numeric' => 'La cantidad debe ser de tipo numérico',
            'celular.regex'=>'El número telefónico debe iniciar con (2),(3),(8) ó (9)',
            'celular.min_digits'=>'El número telefónico debe tener 8 dígitos',
            'celular.max_digits'=>'El número telefónico debe tener 8 dígitos',
            

            'cantidad.required' => 'La cantidad no puede estar vacía',
            'cantidad.min' => 'La cantidad es muy baja',
            'cantidad.min_digits'=>'la cantidad debe tener mínimo 1 dígito',
            'cantidad.max_digits'=>'la cantidad debe tener máximo 3 dígitos',
            'cantidad.max' => 'la cantidad es muy alta',
            'cantidad.numeric' => 'La cantidad debe ser de tipo numérico',

            'fecha.required'=> 'La fecha de asistencia es obligatoria',
            'fecha.date' => 'La fecha de expiración debe de ser una fecha mayor a la de hoy',
            'fecha.after' => 'La fecha de reservación debe de ser posterior a '.$min,
            
            'hora.required'=> 'La hora es obligatoria',

            'recio.required' => 'El pago no puede estar vacío',
            'pago.min' => 'El pago es muy bajo',
            'pago.max' => 'El pago es muy alto',
            'pago.numeric' => 'El pago debe de ser numérico',

            'formaPago.required' => 'La forma de pago no puede estar vacía',
        ]);

      
        $nuevo = new Reservacion;

        $nuevo->nombre = $request->input('nombre');
        $nuevo->celular=$request->input('celular');
        $nuevo->cantidad=$request->input('cantidad');
        $nuevo->fecha=$request->input('fecha');
        $nuevo->hora=$request->input('hora');
        $nuevo->pago=$request->input('pago');
        $nuevo->formaPago=$request->input('formaPago'); 
        $nuevo->mesa_id= 1;       
        $creado = $nuevo -> save();

        if ($creado) {
            return redirect()->route('kiosko_res.index')
            ->with('mensaje', "".$nuevo->nombre." creada correctamente");
        }
        
    }
    public function edit($id)
    {   
        $kiosko = Kiosko::all();
        $registro = Reservacion::findOrFail($id);
        return view('Reservaciones.ReserAdmon.Quiosco.editarReservaciones',  compact('registro', 'kiosko'));
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
            return redirect()->route('kiosko_res.index')
            ->with('mensaje', "".$actualizacion->nombre." actualizada correctamente");
        } 
        
    }
    public function destroy($id){
        Reservacion::destroy($id);
        return redirect()->route('kiosko_res.index')->with('mensaje', 'Reservación borrada correctamente');
    }
    public function detail($id){
        $reservacion = Reservacion::findOrFail($id);
        return \view('Reservaciones.ReserAdmon.Quiosco.detailReservaciones',  compact('reservacion'));
    }
}
