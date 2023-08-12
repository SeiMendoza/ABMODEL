<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kiosko;
use App\Models\Mesa;
use App\Models\Reservacion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservacionController extends Controller
{
    public function index2(Request $request)
    {
        $reservaciones = Reservacion::all();
        $reservaciones = Reservacion::join('kioskos', 'reservacions.kiosko_id', '=', 'kioskos.id')
        ->select('reservacions.*', 'codigo')->where('estado','=', 0)->get();

        if ($request->ajax()) {
            $reservacionesKioskos = Kiosko::join('reservacions', 'reservacions.kiosko_id', '=', 'kioskos.id')
            ->select('codigo as kiosko', 'nombreCliente', 'fecha')->where('estado','=', 0)->get(); //join para obtener la fecha, el nombre y el codigo de los kiosko 
            return response()->json($reservacionesKioskos);
        }

        return view('Reservaciones.ReserAdmon.Quiosco.kioskoReservaciones', compact('reservaciones'));
    }
    /*public function search2(Request $request)
    {
        $text = trim($request->get('buscar'));
        $reservaciones = Reservacion::where('nombre', 'like', '%' . $text . '%')->paginate(5);
        return view("Reservaciones.ReserAdmon.Quiosco.kioskoReservaciones", compact('reservaciones', 'text'));
    }*/
    public function create(Request $request)
    {
        $kiosko = Kiosko::all();

        return view('Reservaciones.ReserAdmon.Quiosco.formularioReservaciones', compact('kiosko'));
    }
    public function store(Request $request)
    {
        $fecha_act = date("d-m-Y");
        $min = date('d-m-Y', $min = strtotime($fecha_act));

        $t= $request->input('cantidadN') * $request->input('precioN') + $request->input('precio') * $request->input('cantidad');

        $request->validate([
            'name' => 'required|regex:/^[\pL\s]+$/u|max:50|min:3',
            'celular' => 'required|numeric|regex:/^[2,3,8,9][0-9]{7}+$/|min_digits:8|max_digits:8|',
            'fecha' => 'required|date|after_or_equal:' . $min,
            'inicio' => 'required',
            'fin' => 'required|after:inicio',
            'tipoE' => 'required|regex:/^[\pL\s]+$/u|max:50|min:3',
            'kiosko' => 'required',
            'cantidadN' => 'min:0|max:20|numeric|min_digits:1|max_digits:3',
            'precioN' => 'min:30|max:100|numeric|min_digits:1|max_digits:3',
            'cantidad' => 'required|min:2|max:20|numeric|min_digits:1|max_digits:3',
            'precio' => 'required|min:80|max:200|numeric|min_digits:1|max_digits:3',
            'anticipo' => 'required|numeric|min:0|max:'.$t,
            'formaPago' => 'required',
        ], [
            'name.required' => 'El nombre no puede estar vacío',
            'name.regex' => 'El nombre tiene caracteres no permitidos',
            'name.max' => 'El nombre es muy extenso',
            'name.min' => 'El nombre es muy corto',

            'celular.required' => 'El número telefónico es obligatorio',
            'celular.numeric' => 'La cantidad debe ser de tipo numérico',
            'celular.regex' => 'El número telefónico debe iniciar con (2),(3),(8) ó (9)',
            'celular.min_digits' => 'El número telefónico debe tener 8 dígitos',
            'celular.max_digits' => 'El número telefónico debe tener 8 dígitos',

            'fecha.required' => 'La fecha de asistencia es obligatoria',
            'fecha.date' => 'La fecha de expiración debe de ser una fecha mayor a la de hoy',
            'fecha.after' => 'La fecha de reservación debe de ser posterior a ' . $min,

            'inicio.required' => 'La hora es obligatoria',
            'fin.required' => 'La hora es obligatoria',
            'fin.after' => 'La hora debe ser posterior a la de inicio',

            'tipoE.required' => 'El nombre no puede estar vacío',
            'tipoE.regex' => 'El nombre tiene caracteres no permitidos',
            'tipoE.max' => 'El nombre es muy extenso',
            'tipoE.min' => 'El nombre es muy corto',

            'kiosko.required' => 'El kisoko es obligatorio',

            'cantidad.required' => 'La cantidad no puede estar vacía',
            'cantidad.min' => 'La cantidad es muy baja',
            'cantidad.min_digits' => 'la cantidad debe tener mínimo 1 dígito',
            'cantidad.max_digits' => 'la cantidad debe tener máximo 3 dígitos',
            'cantidad.max' => 'la cantidad es muy alta',
            'cantidad.numeric' => 'La cantidad debe ser de tipo numérico',

            'precio.required' => 'EL precio no puede estar vacía',
            'precio.min' => 'EL precio es muy bajo',
            'precio.min_digits' => 'El precio debe tener mínimo 1 dígito',
            'precio.max_digits' => 'El precio debe tener máximo 3 dígitos',
            'precio.max' => 'El precio es muy alta',
            'precio.numeric' => 'El precio debe ser de tipo numérico',

            'cantidadN.min' => 'La cantidad es muy baja',
            'cantidadN.min_digits' => 'la cantidad debe tener mínimo 1 dígito',
            'cantidadN.max_digits' => 'la cantidad debe tener máximo 3 dígitos',
            'cantidadN.max' => 'la cantidad es muy alta',
            'cantidadN.numeric' => 'La cantidad debe ser de tipo numérico',

            'precioN.min' => 'El precio es muy baja',
            'precioN.min_digits' => 'El precio debe tener mínimo 1 dígito',
            'precioN.max_digits' => 'El precio debe tener máximo 3 dígitos',
            'precioN.max' => 'El precio es muy alta',
            'precioN.numeric' => 'El precio debe ser de tipo numérico',

            'anticipo.required' => 'El pago no puede estar vacío',
            'anticipo.numeric' => 'El pago debe de ser numérico',
            'anticipo.max' => 'El pago no debe ser mayor al total',
            'anticipo.min' => 'El pago no puede ser menor a cero',

            'formaPago.required' => 'La forma de pago no puede estar vacía',
        ]);

        $nuevo = new Reservacion;
        $nuevo->nombreCliente = $request->input('name');
        $nuevo->celular = $request->input('celular');
        $nuevo->fecha = $request->input('fecha');
        $nuevo->horaI = $request->input('inicio');
        $nuevo->horaF = $request->input('fin');
        $nuevo->kiosko_id = $request->input('kiosko');
        $nuevo->tipo = $request->input('tipoE');
        $nuevo->cantidadNinios = $request->input('cantidadN');
        $nuevo->cantidadAdultos = $request->input('cantidad');
        $nuevo->precioAdultos = $request->input('precio');
        $nuevo->precioNinios = $request->input('precioN');
        $nuevo->anticipo = $request->input('anticipo');
        $nuevo->formaPago = $request->input('formaPago');

        //Quita disponibilidad a las mesas del kiosko
        $mesas = Mesa::where('kiosko_id', '=', $request->input('kiosko'))->get();
        foreach ($mesas as $m) {
            $m->estadoM = 0;
        }

        $creado = $nuevo->save();

        if ($creado) {
            return redirect()->route('kiosko_res.index')
                ->with('mensaje', "Reservacion de" . $nuevo->nombreCliente . " creada correctamente");
        }

    }
    public function edit($id)
    {
        $kiosko = Kiosko::all();
        $registro = Reservacion::findOrFail($id);
        return view('Reservaciones.ReserAdmon.Quiosco.editarReservaciones', compact('registro', 'kiosko'));
    }
    public function update(Request $request, $id)
    {

        $fecha_act = date("d-m-Y");
        $min = date('d-m-Y', $min = strtotime($fecha_act));

        $t= $request->input('cantidadN') * $request->input('precioN') + $request->input('precio') * $request->input('cantidad');

        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s\pLñÑ\.]+$/|max:50|min:3',
            'celular' => 'required|numeric|regex:/^[2,3,8,9][0-9]{7}+$/|min_digits:8|max_digits:8|',
            'fecha' => 'required|date|after_or_equal:' . $min,
            'inicio' => 'required',
            'fin' => 'required|after:inicio',
            'tipoE' => 'required|regex:/^[a-zA-Z\s\pLñÑ\.]+$/|max:50|min:3',
            'kiosko' => 'required',
            'cantidadN' => 'min:0|max:20|numeric|min_digits:1|max_digits:3',
            'precioN' => 'min:30|max:100|numeric|min_digits:1|max_digits:3',
            'cantidad' => 'required|min:2|max:20|numeric|min_digits:1|max_digits:3',
            'precio' => 'required|min:80|max:200|numeric|min_digits:1|max_digits:3',
            'anticipo' => 'required|numeric|min:0|max:'.$t,
            'formaPago' => 'required',
        ], [
            'name.required' => 'El nombre no puede estar vacío',
            'name.regex' => 'El nombre tiene caracteres no permitidos',
            'name.max' => 'El nombre es muy extenso',
            'name.min' => 'El nombre es muy corto',

            'celular.required' => 'El número telefónico es obligatorio',
            'celular.numeric' => 'La cantidad debe ser de tipo numérico',
            'celular.regex' => 'El número telefónico debe iniciar con (2),(3),(8) ó (9)',
            'celular.min_digits' => 'El número telefónico debe tener 8 dígitos',
            'celular.max_digits' => 'El número telefónico debe tener 8 dígitos',

            'fecha.required' => 'La fecha de asistencia es obligatoria',
            'fecha.date' => 'La fecha de expiración debe de ser una fecha mayor a la de hoy',
            'fecha.after' => 'La fecha de reservación debe de ser posterior a ' . $min,

            'inicio.required' => 'La hora es obligatoria',
            'fin.required' => 'La hora es obligatoria',
            'fin.after' => 'La hora debe ser posterior a la de inicio',

            'tipoE.required' => 'El nombre no puede estar vacío',
            'tipoE.regex' => 'El nombre tiene caracteres no permitidos',
            'tipoE.max' => 'El nombre es muy extenso',
            'tipoE.min' => 'El nombre es muy corto',

            'kiosko.required' => 'La hora es obligatoria',

            'cantidad.required' => 'La cantidad no puede estar vacía',
            'cantidad.min' => 'La cantidad es muy baja',
            'cantidad.min_digits' => 'la cantidad debe tener mínimo 1 dígito',
            'cantidad.max_digits' => 'la cantidad debe tener máximo 3 dígitos',
            'cantidad.max' => 'la cantidad es muy alta',
            'cantidad.numeric' => 'La cantidad debe ser de tipo numérico',

            'precio.required' => 'EL precio no puede estar vacía',
            'precio.min' => 'EL precio es muy bajo',
            'precio.min_digits' => 'El precio debe tener mínimo 1 dígito',
            'precio.max_digits' => 'El precio debe tener máximo 3 dígitos',
            'precio.max' => 'El precio es muy alta',
            'precio.numeric' => 'El precio debe ser de tipo numérico',

            'cantidadN.min' => 'La cantidad es muy baja',
            'cantidadN.min_digits' => 'la cantidad debe tener mínimo 1 dígito',
            'cantidadN.max_digits' => 'la cantidad debe tener máximo 3 dígitos',
            'cantidadN.max' => 'la cantidad es muy alta',
            'cantidadN.numeric' => 'La cantidad debe ser de tipo numérico',

            'precioN.min' => 'El precio es muy baja',
            'precioN.min_digits' => 'El precio debe tener mínimo 1 dígito',
            'precioN.max_digits' => 'El precio debe tener máximo 3 dígitos',
            'precioN.max' => 'El precio es muy alta',
            'precioN.numeric' => 'El precio debe ser de tipo numérico',

            'anticipo.required' => 'El pago no puede estar vacío',
            'anticipo.numeric' => 'El pago debe de ser numérico',
            'anticipo.max' => 'El pago no debe ser mayor al total',
            'anticipo.min' => 'El pago no puede ser menor a cero',

            'formaPago.required' => 'La forma de pago no puede estar vacía',
        ]);

        $actualizar = Reservacion::findOrFail($id);
        $anterior = Reservacion::findOrFail($id);

        $actualizar->nombreCliente = $request->input('name');
        $actualizar->celular = $request->input('celular');
        $actualizar->fecha = $request->input('fecha');
        $actualizar->horaI = $request->input('inicio');
        $actualizar->horaF = $request->input('fin');
        $actualizar->kiosko_id = $request->input('kiosko');
        $actualizar->tipo = $request->input('tipoE');
        $actualizar->cantidadNinios = $request->input('cantidadN');
        $actualizar->cantidadAdultos = $request->input('cantidad');
        $actualizar->precioAdultos = $request->input('precio');
        $actualizar->precioNinios = $request->input('precioN');
        $actualizar->anticipo = $request->input('anticipo');
        $actualizar->formaPago = $request->input('formaPago');
        $creado = $actualizar->save();


        if ($creado) {
            //Quita disponibilidad a las mesas del kiosko
            $mesas = Mesa::where('kiosko_id', '=', $actualizar->kiosko_id);
            foreach ($mesas as $m) {
                $m->estadoM = 0;
                $m->save();
            }

            return redirect()->route('kiosko_res.index')
                ->with('mensaje', "Reservación de " . $actualizar->nombreCliente . " actualizada correctamente");
        }

    }
    public function destroy($id)
    {
        Reservacion::destroy($id);
        return back()->with('mensaje', 'Reservación borrada correctamente');
    }
    public function detail($id)
    {
        $reservacion = Reservacion::findOrFail($id);
        return \view('Reservaciones.ReserAdmon.Quiosco.detailReservaciones', compact('reservacion'));
    }

    /**
     * Reservaciones Terminadas
     */

     public function estado($id)
    {
        $cambiar = Reservacion::findOrFail($id);

        $cambiar->estado = 1;
        $cambiar->save();

        return back()->with('mensaje', 'Reservación'. $cambiar->nombreCliente . 'terminada');
    }

    public function indexT()
    {
        $reservaciones = Reservacion::join('kioskos', 'reservacions.kiosko_id', '=', 'kioskos.id')
        ->select('reservacions.*', 'codigo')->where('estado', '=', 1)->get();

        return view('Reservaciones.ReserAdmon.Quiosco.reservacionesTerminadas', compact('reservaciones'));
    }

    public function detalles($id)
    {
        $reservacion = Reservacion::findOrFail($id);
        return \view('Reservaciones.ReserAdmon.Quiosco.detallesReservaciones', compact('reservacion'));
    }

    public function destroy2()
    {
        $terminadas = DB::table('reservacions')->where('estado', '=', 1)->count();
        if ($terminadas > 0) {
            DB::table('reservacions')->where('estado', '=', 1)->delete();
            return back()->with('mensaje', 'Reservaciones borradas correctamente');
        } else {
            return redirect()->route('kiosko_res_t.index')->with('errors', 'No hay reservaciones para borrar');
        }
       
    }
}