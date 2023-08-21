<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\reservacion_total;
use Illuminate\Support\Facades\DB;

class ReservacionTotalController extends Controller
{
    public function reali(Request $request)
    {
        $reservacion = reservacion_total::paginate(10);
        return view('Reservaciones/ReserLocal/ReservRealizadas', compact('reservacion'));
    }

    // busqueda
    public function reservaLocal(Request $request)
    {
        $reservacion = reservacion_total::where('estado', 0)->orderby('Fecha', 'ASC')->get();
        return view('Reservaciones/ReserLocal/Localindex', compact('reservacion'));
    }


    public function create(){
        $reservacion = reservacion_total::orderBy('Fecha', 'ASC')->get();
        return view('/Reservaciones/ReserLocal/FormularioReg', compact('reservacion'));
    }

    public function store(Request $request,){
        $fecha_act = date("d-m-Y");
        $min = date('d-m-Y',$min = strtotime($fecha_act));

        $total = $request->input('Total'); //obtener valor del input

        $request -> validate([
            'Nombre_Cliente' => 'required|regex:/^[a-zA-Z\s\áÁéÉíÍóÓpLñÑ\.]+$/|max:25|min:3',
            'Apellido_Cliente' => 'required|regex:/^[a-zA-Z\s\áÁéÉíÍóÓpLñÑ\.]+$/|max:25|min:3',
            'Contacto' => 'required|min:8|max:8|regex:/^[2,3,8,9][0-9]{7}+$/',
            'Cantidad' => 'required|min:20|max:1000|numeric',
            'Tipo_Reservacion' => 'required',
            'Tipo_Evento' => 'required|regex:/^[a-zA-Z\s\áÁéÉíÍóÓpLñÑ,;:.]+$/|max:50|min:3',
            'Fecha' => 'required|date|after:'.$min,   
            'HoraEntrada' => 'required|date_format:H:i',
            'HoraSalida' => 'required|date_format:H:i|after:HoraEntrada', 
            'Total' => 'required|min:500|max:15000|numeric', 
            'FormaPago' => 'required',
            'Anticipo' => 'required|numeric|min:300|max:' .$total,
            'Pendiente' => 'required',
        ],[

            'Nombre_Cliente.required' => 'El nombre es obligatorio',
            'Nombre_Cliente.regex'=> 'El nombre debe tener solo letras',
            'Nombre_Cliente.regex'=> 'El nombre debe inciar con letra mayuscula',
            'Nombre_Cliente.min'=> 'El nombre debe tener al menos 3 letras',

            'Apellido_Cliente.required' => 'El apellido es obligatorio',
            'Apellido_Cliente.regex'=> 'El apellido debe tener solo letras',
            'Apellido_Cliente.regex'=> 'El apellido debe inciar con letra mayuscula',
            'Apellido_Cliente.min'=> 'El apellido debe tener al menos 3 letras',

            'Contacto.required' => 'El número telefónico es obligatorio',
            'Contacto.min'=>'El número telefónico debe tener minimo: 8 dígitos',
            'Contacto.max'=>'El número telefónico debe tener maximo: 8 dígitos',
            'Contacto.regex'=>'El número telefónico debe iniciar con (2),(3),(8) ó (9)',

            'Cantidad.required' => 'La cantidad no puede estar vacía',
            'Cantidad.min' => 'La cantidad es muy baja',
            'Cantidad.max' => 'La cantidad es muy alta',
            'Cantidad.numeric' => 'La cantidad debe ser de tipo numérico',

            'Tipo_Reservacion.required' => 'El tipo no puede estar vacío',

            'Tipo_Evento.required' => 'El tipo no puede estar vacío',
            'Tipo_Evento.regex'=> 'Existen caracteres no permitidos',
            'Tipo_Evento.max' => 'El nombre es muy largo',
            'Tipo_Evento.min'=> 'Solo se aceptan al menos 3 letras',

            'Fecha.required'=> 'La fecha de asistencia es obligatoria',
            'Fecha.date' => 'La fecha de expiracion debe de ser una fecha mayor a la de hoy',
            'Fecha.after' => 'La fecha de reservacion debe de ser posterior a '.$min,
            
            'HoraEntrada.required'=> 'La hora de llegada es obligatoria',

            'HoraSalida.required'=> 'La hora de salida es obligatoria',
            'HoraSalida.after'=> 'La hora debe ser posterior a la hora de llegada',

            'Total.required' => 'El precio no puede estar vacío',
            'Total.min' => 'El precio es muy bajo',
            'Total.max' => 'El precio es muy alto',
            'Total.numeric' => 'El precio debe de ser numerico',

            'FormaPago.required' => 'La forma de pago no puede estar vacía',

            'Anticipo.required' =>'El anticipo no puede estar vacío',
            'Anticipo.numeric' => 'El anticipo debe ser de tipo numérico',
            'Anticipo.min' => 'El anticipo debe ser mayor a L. 300.00',
            'Anticipo.max' => 'El anticipo no debe ser mayor a ' .$total,

            'Pendiente.required' =>'El saldo pendiente es obligatorio',
        ]);

        /*Variable para reconocer los nuevos registros a la tabla*/
        $nuevoCliente = new reservacion_total();

        $nuevoCliente->Nombre_Cliente=$request->input('Nombre_Cliente');
        $nuevoCliente->Apellido_Cliente=$request->input('Apellido_Cliente');
        $nuevoCliente->Contacto=$request->input('Contacto');
        $nuevoCliente->Cantidad=$request->input('Cantidad');
        $nuevoCliente->Tipo_Reservacion=$request->input('Tipo_Reservacion');
        $nuevoCliente->Tipo_Evento=$request->input('Tipo_Evento');
        $nuevoCliente->Fecha=$request->input('Fecha');
        $nuevoCliente->HoraEntrada=$request->input('HoraEntrada');
        $nuevoCliente->HoraSalida=$request->input('HoraSalida');
        $nuevoCliente->Total=$request->input('Total');
        $nuevoCliente->FormaPago=$request->input('FormaPago');
        $nuevoCliente->Anticipo=$request->input('Anticipo');
        $nuevoCliente->Pendiente=$request->input('Pendiente');
        
        /*Variable para guardar los nuevos registros */
        $creado = $nuevoCliente->save();

        if($creado){
            return redirect()->route('cliente.reservaLocal')
            ->with('mensaje', "Reservación exitosa");
        }
    }

        /** Editar Reservacion del local */
    public function edit($id){
        $reservacion = reservacion_total::findOrFail($id);
            return view('Reservaciones/ReserLocal/EditarReservacion') 
                  -> with('r', $reservacion);
    }
    
    
    public function update(Request $request, $id){

        $fecha_act = date("d-m-Y");
        $min = date('d-m-Y',$min = strtotime($fecha_act));

        $request->merge(['HoraEntrada' => date('H:i', strtotime($request->HoraEntrada))]);
        $request->merge(['HoraSalida' => date('H:i', strtotime($request->HoraSalida))]);


        $total = $request->input('Total'); //obtener valor del input

        $request -> validate([
            'Nombre_Cliente' => 'required|regex:/^[a-zA-Z\s\áÁéÉíÍóÓpLñÑ\.]+$/|max:25|min:3',
            'Apellido_Cliente' => 'required|regex:/^[a-zA-Z\s\áÁéÉíÍóÓpLñÑ\.]+$/|max:25|min:3',
            'Contacto' => 'required|min:8|max:8|regex:/^[2,3,8,9][0-9]{7}+$/',
            'Cantidad' => 'required|min:20|max:1000|numeric',
            'Tipo_Reservacion' => 'required',
            'Tipo_Evento' => 'required|regex:/^[a-zA-Z\s\áÁéÉíÍóÓpLñÑ,;:.]+$/|max:50|min:3',
            'Fecha' => 'required|date|after:'.$min,   
            'HoraEntrada' => 'required|date_format:H:i',
            'HoraSalida' => 'required|after:HoraEntrada|date_format:H:i',
            'Total' => 'required|min:500|max:15000|numeric', 
            'FormaPago' => 'required',
            'Anticipo' => 'required|min:300|numeric|max:' .$total,
            'Pendiente' => 'required',
        ],[
            'Nombre_Cliente.required' => 'El nombre es obligatorio',
            'Nombre_Cliente.regex'=> 'El nombre debe tener solo letras',
            'Nombre_Cliente.regex'=> 'El nombre debe inciar con letra mayuscula',
            'Nombre_Cliente.max'=> 'El nombre es muy largo',
            'Nombre_Cliente.min'=> 'El nombre debe tener al menos 3 letras',

            'Apellido_Cliente.required' => 'El apellido es obligatorio',
            'Apellido_Cliente.regex'=> 'El apellido debe tener solo letras',
            'Apellido_Cliente.regex'=> 'El apellido debe inciar con letra mayuscula',
            'Apellido_Cliente.min'=> 'El apellido debe tener al menos 3 letras',

            'Contacto.required' => 'El número telefónico es obligatorio',
            'Contacto.min'=>'El número telefónico debe tener minimo: 8 dígitos',
            'Contacto.max'=>'El número telefónico debe tener maximo: 8 dígitos',
            'Contacto.regex'=>'El número telefónico debe iniciar con (2),(3),(8) ó (9)',

            'Cantidad.required' => 'La cantidad no puede estar vacía',
            'Cantidad.min' => 'La cantidad es muy baja',
            'Cantidad.max' => 'La cantidad es muy alta',
            'Cantidad.numeric' => 'La cantidad debe ser de tipo numérico',

            'Tipo_Reservacion.required' => 'El tipo no puede estar vacío',

            'Tipo_Evento.required' => 'El tipo no puede estar vacío',
            'Tipo_Evento.regex'=> 'Existen caracteres no permitidos',
            'Tipo_Evento.max' => 'El nombre es muy largo',
            'Tipo_Evento.min'=> 'Solo se aceptan al menos 3 letras',

            'Fecha.required'=> 'La fecha de asistencia es obligatoria',
            'Fecha.date' => 'La fecha de expiracion debe de ser una fecha',
            'Fecha.after' => 'La fecha de reservacion debe de ser posterior a '.$min,
            
            'HoraEntrada.required'=> 'La hora de llegada es obligatoria',

            'HoraSalida.required'=> 'La hora de salida es obligatoria',
            'HoraSalida.after'=> 'La hora debe ser posterior a la hora de llegada',

            'Total.required' => 'El precio no puede estar vacío',
            'Total.min' => 'El precio es muy bajo',
            'Total.max' => 'El precio es muy alto',
            'Total.numeric' => 'El precio debe de ser numerico',

            'FormaPago.required' => 'La forma de pago no puede estar vacía',

            'Anticipo.required' =>'El anticipo no puede estar vacío',
            'Anticipo.numeric' => 'El anticipo debe ser de tipo numérico',
            'Anticipo.min' => 'El anticipo debe ser mayor a L. 300.00',
            'Anticipo.max' => 'El anticipo no debe ser mayor a ' .$total,

            'Pendiente.required' =>'El saldo pendiente es obligatorio',
        ]);
   
            $actualizacion = reservacion_total::findOrFail($id);

            $actualizacion->Nombre_Cliente=$request->input('Nombre_Cliente');
            $actualizacion->Apellido_Cliente=$request->input('Apellido_Cliente');
            $actualizacion->Contacto=$request->input('Contacto');
            $actualizacion->Cantidad=$request->input('Cantidad');
            $actualizacion->Tipo_Reservacion=$request->input('Tipo_Reservacion');
            $actualizacion->Tipo_Evento=$request->input('Tipo_Evento');
            $actualizacion->Fecha=$request->input('Fecha');
            $actualizacion->HoraEntrada=$request->input('HoraEntrada');
            $actualizacion->HoraSalida=$request->input('HoraSalida');
            $actualizacion->Total=$request->input('Total');
            $actualizacion->FormaPago=$request->input('FormaPago');
            $actualizacion->Anticipo=$request->input('Anticipo');
            $actualizacion->Pendiente=$request->input('Pendiente');

            $creado = $actualizacion -> save();
    
            if ($creado) {
                   return redirect()->route('cliente.reservaLocal')
                    ->with('mensaje', " Reservación de ".$actualizacion->Nombre_Cliente." se actualizó correctamente");
            } 
   }

   /**Detalles de la reservación */
   public function detalle_reservacion($id){
    $reservar = reservacion_total::findOrfail($id);
        return view('Reservaciones/ReserLocal/DetalleReservacion', compact('reservar'));
   }


   /*Borrar cliente*/ 
   public function destroy($id){
    reservacion_total::findOrFail($id)->delete();
    return to_route('evento.realizado')->with('mensaje', 'Cliente borrado correctamente!');
   }

   /**Estado de reservaciones */
   public function reservacionesRealizadas(Request $request,  $id)
    {
        $request->validate([
            'estado' => 'required|in:1', 
        ]);
        $activar = reservacion_total::findOrfail($id);
        $activar->estado = $request->input('estado');
        $activar->Pendiente = 0.00;

        $create = $activar->save();

        if ($create) {
            return redirect()->route('cliente.reservaLocal')->with('mensaje', 'Reservación realizada con éxito.');
        }
    }

    /**Reservaciones realizadas */
    public function Realizadas() { 
        $reservacion = reservacion_total::where('estado', 1)->orderBy('Fecha','ASC')->get();
        
        return view('Reservaciones/ReserLocal/ReservRealizadas', compact('reservacion'));
    }

     /**Detalles de la reservación realizadas */
   public function detalleRealizadas($id){
    $reservar = reservacion_total::findOrfail($id);
        return view('Reservaciones/ReserLocal/DetalleReserRealizadas', compact('reservar'));
   }
}
