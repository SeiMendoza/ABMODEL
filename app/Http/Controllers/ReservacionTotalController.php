<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\reservacion_total;

class ReservacionTotalController extends Controller
{
    
    // busqueda
    public function reservaLocal(Request $request)
    {
        $texto=trim($request->get('busqueda'));

        $reservacion = reservacion_total::where('Nombre_Cliente', 'like', '%' . $texto . '%')->paginate(10);
        return view('Reservaciones/ReserLocal/Localindex', compact('reservacion','texto'));
    }


    public function create(){
        return view('/Reservaciones/ReserLocal/FormularioReg');
    }

    public function store(Request $request,){

        $fecha_act = date("d-m-Y");
        $min = date('d-m-Y',$min = strtotime($fecha_act."+ 1 day"));

        $request -> validate([
            'Nombre_Cliente' => 'required|regex:/^[a-zA-Z\s\áÁéÉíÍóÓpLñÑ\.]+$/|max:25|min:4',
            'Apellido_Cliente' => 'required|regex:/^[a-zA-Z\s\áÁéÉíÍóÓpLñÑ\.]+$/|max:25|min:4',
            'Contacto' => ['required', 'min:8', 'regex:/^[2,3,8,9][0-9]{7}+$/'],
            'Cantidad' => 'required|min:50|max:1000|numeric',
            'Tipo_Reservacion' => 'required',
            'Tipo_Evento' => 'required',
            'Fecha' => 'required|date|after:'.$min,   
            'Hora' => 'required',   
            'Precio' => 'required|min:2000|max:8000|numeric', 
            'FormaPago' => 'required',
        ],[

            'Nombre_Cliente.required' => 'El nombre es obligatorio',
            'Nombre_Cliente.regex'=> 'El nombre debe tener solo letras',
            'Nombre_Cliente.regex'=> 'Solo se permiten letras',

            'Apellido_Cliente.required' => 'El nombre es obligatorio',
            'Apellido_Cliente.regex'=> 'El nombre debe tener solo letras',
            'Apellido_Cliente.regex'=> 'Solo se permiten letras',

            'Contacto.required' => 'El número telefónico es obligatorio',
            'Contacto.min'=>'El número telefónico debe tener 8 dígitos',
            'Contacto.regex'=>'El número telefónico debe iniciar con (2),(3),(8) ó (9)',

            'Cantidad.required' => 'La cantidad no puede estar vacía',
            'Cantidad.min' => 'La cantidad es muy baja',
            'Cantidad.max' => 'la cantidad es muy alta',
            'Cantidad.numeric' => 'La cantidad debe ser de tipo numérico',

            'Tipo_Reservacion.required' => 'El tipo no puede estar vacío',

            'Tipo_Evento.required' => 'El tipo no puede estar vacío',

            'Fecha.required'=> 'La fecha de asistencia es obligatoria',
            'Fecha.date' => 'La fecha de expiracion debe de ser una fecha mayor a la de hoy',
            'Fecha.after' => 'La fecha de reservacion debe de ser posterior a '.$min,
            
            'Hora.required'=> 'La hora de llegada es obligatoria',

            'Precio.required' => 'El precio no puede estar vacío',
            'Precio.min' => 'El precio es muy bajo',
            'Precio.max' => 'El precio es muy alto',
            'Precio.numeric' => 'El precio debe de ser numerico',

            'FormaPago.required' => 'La forma de pago no puede estar vacía',
            
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
        $nuevoCliente->Hora=$request->input('Hora');
        $nuevoCliente->Precio=$request->input('Precio');
        $nuevoCliente->FormaPago=$request->input('FormaPago');
        
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
        $min = date('d-m-Y',$min = strtotime($fecha_act."+ 0 day"));

        $request -> validate([
            'Nombre_Cliente' => 'required|regex:/^[a-zA-Z\s\áÁéÉíÍóÓpLñÑ\.]+$/|max:25|min:4',
            'Apellido_Cliente' => 'required|regex:/^[a-zA-Z\s\áÁéÉíÍóÓpLñÑ\.]+$/|max:25|min:4',
            'Contacto' => ['required', 'min:8', 'regex:/^[2,3,8,9][0-9]{7}+$/'],
            'Cantidad' => 'required|min:50|max:1000|numeric',
            'Tipo_Reservacion' => 'required',
            'Tipo_Evento' => 'required',
            'Fecha' => 'required|date|after:'.$min,   
            'Hora' => 'required',   
            'Precio' => 'required|min:2000|max:8000|numeric', 
            'FormaPago' => 'required',
        ],[
            'Nombre_Cliente.required' => 'El nombre es obligatorio',
            'Nombre_Cliente.regex'=> 'El nombre debe tener solo letras',
            'Nombre_Cliente.regex'=> 'Solo se permiten letras',
            'Nombre_Cliente.max'=> 'El nombre es muy largo',

            'Apellido_Cliente.required' => 'El nombre es obligatorio',
            'Apellido_Cliente.regex'=> 'El nombre debe tener solo letras',
            'Apellido_Cliente.regex'=> 'Solo se permiten letras',

            'Contacto.required' => 'El número telefónico es obligatorio',
            'Contacto.min'=>'El número telefónico debe tener 8 dígitos',
            'Contacto.regex'=>'El número telefónico debe iniciar con (2),(3),(8) ó (9)',

            'Cantidad.required' => 'La cantidad no puede estar vacía',
            'Cantidad.min' => 'La cantidad es muy baja',
            'Cantidad.max' => 'la cantidad es muy alta',
            'Cantidad.numeric' => 'La cantidad debe ser de tipo numérico',

            'Tipo_Reservacion.required' => 'El tipo no puede estar vacío',

            'Tipo_Evento.required' => 'El tipo no puede estar vacío',

            'Fecha.required'=> 'La fecha de asistencia es obligatoria',
            'Fecha.date' => 'La fecha de expiracion debe de ser una fecha',
            'Fecha.after' => 'La fecha de reservacion debe de ser posterior a '.$min,
            
            'Hora.required'=> 'La hora de llegada es obligatoria',

            'Precio.required' => 'El precio no puede estar vacío',
            'Precio.min' => 'El precio es muy bajo',
            'Precio.max' => 'El precio es muy alto',
            'Precio.numeric' => 'El precio debe de ser numerico',

            'FormaPago.required' => 'La forma de pago no puede estar vacía',
        ]);
   
            $actualizacion = reservacion_total::findOrFail($id);

            $actualizacion->Nombre_Cliente=$request->input('Nombre_Cliente');
            $actualizacion->Apellido_Cliente=$request->input('Apellido_Cliente');
            $actualizacion->Contacto=$request->input('Contacto');
            $actualizacion->Cantidad=$request->input('Cantidad');
            $actualizacion->Tipo_Reservacion=$request->input('Tipo_Reservacion');
            $actualizacion->Tipo_Evento=$request->input('Tipo_Evento');
            $actualizacion->Fecha=$request->input('Fecha');
            $actualizacion->Hora=$request->input('Hora');
            $actualizacion->FormaPago=$request->input('FormaPago');

            $creado = $actualizacion -> save();
    
            if ($creado) {
                   return redirect()->route('cliente.reservaLocal')
                    ->with('mensaje', " Cliente ".$actualizacion->id." se actualizo correctamente");
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
    return to_route('cliente.reservaLocal')->with('mensaje', 'Cliente borrado correctamente!');
   }
}
