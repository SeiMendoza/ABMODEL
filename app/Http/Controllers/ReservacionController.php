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
            'name' => 'required|regex:/^[a-zA-Z\s\pLñÑ\.]+$/|max:50|min:3',
            'celular' => 'required|numeric|regex:/^[2,3,8,9][0-9]{7}+$/|min_digits:8|max_digits:8|',
            'fecha' => 'required|date|after:'.$min,   
            'inicio' => 'required',   
            'fin' => 'required',
            'tipoE' => 'required|regex:/^[a-zA-Z\s\pLñÑ\.]+$/|max:50|min:3',
            'kiosko' => 'required',
            'cantidadN' => 'min:1|max:20|numeric|min_digits:1|max_digits:3',
            'cantidad' => 'required|min:1|max:20|numeric|min_digits:1|max_digits:3',
            'total' => 'required|min:100|max:8000|numeric', 
            'anticipo' => 'required|numeric',
            'pendiente' => 'required|numeric',
            'formaPago' => 'required',   
        ],[
            'name.required' => 'El nombre no puede estar vacío',
            'name.regex'=> 'El nombre tiene caracteres no permitidos',
            'name.max' => 'El nombre es muy extenso',
            'name.min' => 'El nombre es muy corto',

            'celular.required' => 'El número telefónico es obligatorio',
            'celular.numeric' => 'La cantidad debe ser de tipo numérico',
            'celular.regex'=>'El número telefónico debe iniciar con (2),(3),(8) ó (9)',
            'celular.min_digits'=>'El número telefónico debe tener 8 dígitos',
            'celular.max_digits'=>'El número telefónico debe tener 8 dígitos',
            
            'fecha.required'=> 'La fecha de asistencia es obligatoria',
            'fecha.date' => 'La fecha de expiración debe de ser una fecha mayor a la de hoy',
            'fecha.after' => 'La fecha de reservación debe de ser posterior a '.$min,
            
            'inicio.required'=> 'La hora es obligatoria',
            'fin.required'=> 'La hora es obligatoria',

            'tipoE.required' => 'El nombre no puede estar vacío',
            'tipoE.regex'=> 'El nombre tiene caracteres no permitidos',
            'tipoE.max' => 'El nombre es muy extenso',
            'tipoE.min' => 'El nombre es muy corto',

            'kiosko.required'=> 'La hora es obligatoria',

            'cantidad.required' => 'La cantidad no puede estar vacía',
            'cantidad.min' => 'La cantidad es muy baja',
            'cantidad.min_digits'=>'la cantidad debe tener mínimo 1 dígito',
            'cantidad.max_digits'=>'la cantidad debe tener máximo 3 dígitos',
            'cantidad.max' => 'la cantidad es muy alta',
            'cantidad.numeric' => 'La cantidad debe ser de tipo numérico',

           
            'cantidadN.min' => 'La cantidad es muy baja',
            'cantidadN.min_digits'=>'la cantidad debe tener mínimo 1 dígito',
            'cantidadN.max_digits'=>'la cantidad debe tener máximo 3 dígitos',
            'cantidadN.max' => 'la cantidad es muy alta',
            'cantidadN.numeric' => 'La cantidad debe ser de tipo numérico',

            'total.required' => 'El pago no puede estar vacío',
            'total.min' => 'El pago es muy bajo',
            'total.max' => 'El pago es muy alto',
            'total.numeric' => 'El pago debe de ser numérico',

            'anticipo.required' => 'El pago no puede estar vacío',
            'anticipo.numeric' => 'El pago debe de ser numérico',

            'pendiente.required' => 'El pago no puede estar vacío',
            'pendiente.numeric' => 'El pago debe de ser numérico',

            'formaPago.required' => 'La forma de pago no puede estar vacía',
        ]);

      
        $nuevo = new Reservacion;

        $nuevo->nombreCliente = $request->input('name');
        $nuevo->celular=$request->input('celular');
        $nuevo->fecha=$request->input('fecha');
        $nuevo->horaI=$request->input('inicio');
        $nuevo->horaF=$request->input('fin');
        $nuevo->kiosko_id=$request->input('kiosko');
        $nuevo->tipo=$request->input('tipoE');
        $nuevo->cantidadNinios=$request->input('cantidadN');
        $nuevo->cantidadAdultos=$request->input('cantidad');
        $nuevo->precioAdultos= 100;
        $nuevo->precioNinios= 100;
        $nuevo->total=$request->input('total');
        $nuevo->anticipo=$request->input('anticipo');
        $nuevo->pendiente=$request->input('pendiente');
        $nuevo->formaPago=$request->input('formaPago'); 
      
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
