<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use App\Http\Controllers\Controller;
use App\Models\PlatillosyBebidas;
use App\Models\Platillo;
use App\Models\Bebida;

class EditarPlatilloController extends Controller
{
    //
    public function edit($id){
        $Platillos = Platillo::findOrFail($id);
        return view('Menu/Admon/edicion/editarPlatillo') 
              -> with('Platillos', $Platillos);
    }


    public function update(Request $request, $id){

        $request -> validate ([
            'tipo' => 'required|in:2,1',
            'nombre' => 'required|max:100|min:3',
            'descripcion' => 'required|max:100|min:3',   
            'precio' => 'required|min:1|max:1000|numeric',   
            'tamanio' => 'required|max:100|min:3', 
            'imagen' => '',
            'cantidad' => 'nullable|min:1|max:1000|numeric',
            'disponible' => 'nullable|min:1|max:1000|numeric',
        ],[
            'tipo.required' => 'El tipo no puede estar vacío',
            'nombre.required' => 'El nombre no puede estar vacío',
            'nombre.max' => 'El nombre es muy extenso',
            'nombre.min' => 'El nombre es muy corto',
            'descripcion.required' => 'La descripcion no puede estar vacío',
            'descripcion.max' => 'La descripcion es muy extenso',
            'descripcion.min' => 'La descripcion es muy corto',
            'precio.required' => 'El precio no puede estar vacío',
            'precio.max' => 'El precio es muy grande',
            'precio.min' => 'El precio es muy pequeño',
            'precio.numeric' => 'El precio debe de ser numerico',
            'tamanio.required' => 'El tamanio no puede estar vacío',
            'tamanio.max' => 'El tamanio es muy extenso',
            'tamanio.min' => 'El tamanio es muy corto',
            'cantidad.max' => 'El numero de bebidas disponibles es muy grande',
            'cantidad.min' => 'El numero de bebidas disponibles es muy pequeño',
            'cantidad.numeric' => 'El numero de bebidas disponibles debe de ser numerico',
            'disponible.max' => 'El numero de platillos disponibles es muy grande',
            'disponible.min' => 'El numero de platillos disponibles es muy pequeño',
            'disponible.numeric' => 'El numero de platillos disponibles debe de ser numerico',
        ]);

      
        $actualizacion = Platillo::findOrFail($id);

        $actualizacion->nombre = $request->input('nombre');
        $actualizacion->descripcion = $request->input('descripcion');
        $actualizacion->precio = $request->input('precio');
        $actualizacion->tamanio = $request->input('tamanio');
        $actualizacion->disponible = $request->input('cantidad');
               
        $creado = $actualizacion->save();

        if ($creado) {
            return redirect()->route('menuAdmon.index')
            ->with('mensaje', "Platillo ".$actualizacion->nombre." se actualizó correctamente");
        } 
        
    }
 }

