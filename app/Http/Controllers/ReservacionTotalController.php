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
        return view('/Reservaciones/ReserLocal/FormularioCliente');
    }

    public function store(Request $request,){
        $request -> validate([
            'Nombre_Cliente' => 'required|regex:/^[a-zA-Z\s\pLñÑ\.]+$/|max:50|min:4',
            'Apellido_Cliente' => 'required|regex:/^[a-zA-Z\s\pLñÑ\.]+$/|max:50|min:4',
            'Fecha' => 'required',   
            'Hora' => 'required',   
            'Contacto' => ['required', 'min:8', 'regex:/^[2,3,8,9][0-9]{7}+$/'], 
            'Tipo_Evento' => 'required',
        ],[

            'Nombre_Cliente.required' => 'El nombre es obligatorio',
            'Nombre_Cliente.regex'=> 'El nombre debe tener solo letras',
            'Nombre_Cliente.regex'=> 'Solo se permiten letras',

            'Apellido_Cliente.required' => 'El nombre es obligatorio',
            'Apellido_Cliente.regex'=> 'El nombre debe tener solo letras',
            'Apellido_Cliente.regex'=> 'Solo se permiten letras',

            'Fecha.required'=> 'La fecha de asistencia es obligatoria',
            
            'Hora.required'=> 'La hora de llegada es obligatoria',

            'Contacto.required' => 'El número telefónico es obligatorio',
            'Contacto.min'=>'El número telefónico debe tener 8 dígitos',
            'Contacto.regex'=>'El número telefónico debe iniciar con (2),(3),(8) ó (9)',

            'Tipo_Evento.required' => 'El tipo no puede estar vacío',
        ]);

        /*Variable para reconocer los nuevos registros a la tabla*/
        $nuevoCliente = new reservacion_total();

        $nuevoCliente->Nombre_Cliente=$request->input('Nombre_Cliente');
        $nuevoCliente->Apellido_Cliente=$request->input('Apellido_Cliente');
        $nuevoCliente->Fecha=$request->input('Fecha');
        $nuevoCliente->Hora=$request->input('Hora');
        $nuevoCliente->Contacto=$request->input('Contacto');
        $nuevoCliente->Tipo_Evento=$request->input('Tipo_Evento');

        /*Variable para guardar los nuevos registros */
        $creado = $nuevoCliente->save();

        if($creado){
            return redirect()->route('cliente.reservaLocal')
            ->with('mensaje', "Datos enviados correctamente");
        }
    }

        /** Editar Reservacion del local */
    public function edit($id){
        $reservacion = reservacion_total::findOrFail($id);
            return view('Reservaciones/ReserLocal/EditarReservacion') 
                  -> with('r', $reservacion);
    }
    
    
    public function update(Request $request, $id){
        $request -> validate([
            'Nombre_Cliente' => 'required|regex:/^[a-zA-Z\s\pLñÑ\.]+$/|max:50|min:4',
            'Apellido_Cliente' => 'required|regex:/^[a-zA-Z\s\pLñÑ\.]+$/|max:50|min:4',
            'Fecha' => 'required',   
            'Hora' => 'required',   
            'Contacto' => ['required', 'min:8', 'regex:/^[2,3,8,9][0-9]{7}+$/'], 
            'Tipo_Evento' => 'required',
        ],[

            'Nombre_Cliente.required' => 'El nombre es obligatorio',
            'Nombre_Cliente.regex'=> 'El nombre debe tener solo letras',
            'Nombre_Cliente.regex'=> 'Solo se permiten letras',

            'Apellido_Cliente.required' => 'El nombre es obligatorio',
            'Apellido_Cliente.regex'=> 'El nombre debe tener solo letras',
            'Apellido_Cliente.regex'=> 'Solo se permiten letras',

            'Fecha.required'=> 'La fecha de asistencia es obligatoria',
            
            'Hora.required'=> 'La hora de llegada es obligatoria',

            'Contacto.required' => 'El número telefónico es obligatorio',
            'Contacto.min'=>'El número telefónico debe tener 8 dígitos',
            'Contacto.regex'=>'El número telefónico debe iniciar con (2),(3),(8) ó (9)',

            'Tipo_Evento.required' => 'El tipo no puede estar vacío',
        ]);
   
            $actualizacion = reservacion_total::findOrFail($id);

            $actualizacion->Nombre_Cliente=$request->input('Nombre_Cliente');
            $actualizacion->Apellido_Cliente=$request->input('Apellido_Cliente');
            $actualizacion->Fecha=$request->input('Fecha');
            $actualizacion->Hora=$request->input('Hora');
            $actualizacion->Contacto=$request->input('Contacto');
            $actualizacion->Tipo_Evento=$request->input('Tipo_Evento');
                   
            $creado = $actualizacion -> save();
    
            if ($creado) {
                   return redirect()->route('cliente.reservaLocal')
                    ->with('mensaje', "".$actualizacion->Nombre_Cliente." se actualizo correctamente");
            } 
   }

   /*Borrar cliente*/ 
   public function destroy($id){
    reservacion_total::findOrFail($id)->delete();
    return to_route('cliente.reservaLocal')->with('mensaje', 'Cliente Borrado correctamente!');
   }
}
