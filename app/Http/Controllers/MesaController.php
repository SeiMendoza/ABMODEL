<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mesa;
use Illuminate\Http\Request;

class MesaController extends Controller
{
     public function index()
    {
        $registros = Mesa::paginate(12);
        return view('Reservaciones.ReserAdmon.Mesas.mesasRegistro',  compact('registros'));
    } 
    public function search(Request $request)
    {
        $text = trim($request->get('busqueda'));
        $registros = Mesa::where('nombre', 'like', '%' . $text . '%')
            ->orWhere('cantidad', 'like', '%' . $text . '%')->paginate(12);
        return view("Reservaciones.ReserAdmon.Mesas.mesasRegistro", compact('registros', 'text'));
    }
    public function store(Request $request){

        $request -> validate ([
            'nombre' => 'required|regex:/^[a-zA-Z\s\pLñÑ\.]+$/|max:100|min:3',  
            'cantidad' => 'required|min:1|max:20|numeric',   
        ],[
            'nombre.required' => 'El nombre no puede estar vacío',
            'nombre.regex'=> 'El nombre tiene caracteres no permitidos',
            'nombre.max' => 'El nombre es muy extenso',
            'nombre.min' => 'El nombre es muy corto',
            'cantidad.required' => 'La cantidad no puede estar vacío',
            'cantidad.max' => 'la cantidad es muy alta',
            'cantidad.min' => 'La cantidad es muy baja',
            'cantidad.numeric' => 'La cantidad debe se dde tipo numérico',
        ]);

      
        $nuevo = new Mesa;

        $nuevo->nombre = $request->input('nombre');
        $nuevo->cantidad = $request->input('cantidad');               
        $creado = $nuevo -> save();

        if ($creado) {
            return redirect()->route('mesas_reg.index')
            ->with('mensaje', "".$nuevo->nombre." creada correctamente");
        }
        
    }

    public function update(Request $request, $id){

        $request -> validate ([
            'nombre' => 'required|regex:/^[a-zA-Z\s\pLñÑ\.]+$/|max:100|min:3',  
            'cantidad' => 'required|min:1|max:20|numeric',   
        ],[
            'nombre.required' => 'El nombre no puede estar vacío',
            'nombre.regex'=> 'El nombre tiene caracteres no permitidos',
            'nombre.max' => 'El nombre es muy extenso',
            'nombre.min' => 'El nombre es muy corto',
            'cantidad.required' => 'La cantidad no puede estar vacío',
            'cantidad.max' => 'la cantidad es muy alta',
            'cantidad.min' => 'La cantidad es muy baja',
            'cantidad.numeric' => 'La cantidad debe se dde tipo numérico',
        ]);

        $actualizacion = Mesa::findOrFail($id);

        $actualizacion->nombre = $request->input('nombre');
        $actualizacion->cantidad = $request->input('cantidad');               
        $creado = $actualizacion -> save();

        if ($creado) {
            return redirect()->route('mesas_reg.index')
            ->with('mensaje', "".$actualizacion->nombre." actualizada correctamente");
        } 
        
    }

    public function destroy($id){
        Mesa::destroy($id);
        return redirect()->route('mesas_reg.index')->with('mensaje', 'Mesa borrada correctamente');
    }

}
