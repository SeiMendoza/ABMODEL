<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mesa;
use Illuminate\Http\Request;

class MesaController extends Controller
{
     public function index()
    {
        $registros = Mesa::paginate(10);
        return view('Reservaciones.ReserAdmon.Mesas.mesasRegistro',  compact('registros'));
    } 
    public function search(Request $request)
    {
        $text = trim($request->get('busqueda'));
        $registros = Mesa::where('nombre', 'like', '%' . $text . '%')
            ->orWhere('cantidad', 'like', '%' . $text . '%')->paginate(12);
        return view("Reservaciones.ReserAdmon.Mesas.mesasRegistro", compact('registros', 'text'));
    }
    public function create()
    {
        return view('Reservaciones.ReserAdmon.Mesas.formularioRegistro');
    }
    public function store(Request $request){

        $request -> validate ([
            'codigo' => 'required|numeric|min_digits:13|max_digits:13',
            'nombre' => 'required|regex:/^[a-zA-Z\s\pLñÑ\.\0-9\_]+$/|max:50|min:3',  
            'cantidad' => 'required|min:1|max:20|numeric',  
            //'kiosko' => 'required' 
        ],[
            'codigo.required' => 'El código no puede estar vacío',
            'codigo.min_digits' => 'El código debe tener 13 números',
            'codigo.max_digits' => 'El código debe tener 13 números',
            'codigo.numeric' => 'El código debe ser de tipo numérico',
            'nombre.required' => 'El nombre no puede estar vacío',
            'nombre.regex'=> 'El nombre tiene caracteres no permitidos',
            'nombre.max' => 'El nombre es muy extenso',
            'nombre.min' => 'El nombre es muy corto',
            'cantidad.required' => 'La cantidad no puede estar vacío',
            'cantidad.max' => 'la cantidad es muy alta',
            'cantidad.min' => 'La cantidad es muy baja',
            'cantidad.numeric' => 'La cantidad debe se dde tipo numérico',
           // 'kiosko.required' => 'Kiosko no puede estar vacío',
        ]);

      
        $nuevo = new Mesa;

        $nuevo->codigo = $request->input('codigo');
        $nuevo->nombre = $request->input('nombre');
        $nuevo->cantidad = $request->input('cantidad'); 
        $nuevo->kiosko_id = 1;             
        $creado = $nuevo -> save();

        if ($creado) {
            return redirect()->route('mesas_reg.index')
            ->with('mensaje', "".$nuevo->nombre." creada correctamente");
        }
        
    }

    public function edit($id)
    {
        $registro = Mesa::findOrFail($id);
        return view('Reservaciones.ReserAdmon.Mesas.editarRegistro',  compact('registro'));
    }

    public function update(Request $request, $id){

        $request -> validate ([
            'codigo' => 'required|min:13|numeric',
            'nombre' => 'required|regex:/^[a-zA-Z\s\pLñÑ\.\0-9\_]+$/|max:100|min:3',  
            'cantidad' => 'required|min:1|max:20|numeric',   
            //'kiosko' => 'required'
        ],[
            'codigo.required' => 'El código no puede estar vacío',
            //'codigo.max' => 'El código debe tener 13 números',
            'codigo.min' => 'El código debe tener 13 números',
            'codigo.numeric' => 'El código debe ser de tipo numérico',
            'nombre.required' => 'El nombre no puede estar vacío',
            'nombre.regex'=> 'El nombre tiene caracteres no permitidos',
            'nombre.max' => 'El nombre es muy extenso',
            'nombre.min' => 'El nombre es muy corto',
            'cantidad.required' => 'La cantidad no puede estar vacío',
            'cantidad.max' => 'la cantidad es muy alta',
            'cantidad.min' => 'La cantidad es muy baja',
            'cantidad.numeric' => 'La cantidad debe ser de tipo numérico',
            //'kiosko.required' => 'Kiosko no puede estar vacío',
        ]);

        $actualizacion = Mesa::findOrFail($id);

        $actualizacion->codigo = $request->input('codigo');
        $actualizacion->nombre = $request->input('nombre');
        $actualizacion->cantidad = $request->input('cantidad'); 
        $actualizacion->kiosko_id = 1;              
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
