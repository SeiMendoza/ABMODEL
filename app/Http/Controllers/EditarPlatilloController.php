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
            'nombre2' => 'required|max:100|min:3',
            'descripcion2' => 'required|max:100|min:3',   
            'precio2' => 'required|min:1|max:1000|numeric',   
            'tamanio2' => 'required', 
            'imagen2' => '',
            'disponible2' => 'required|min:1|max:1000|numeric',
        ],[
            'nombre2.required' => 'El nombre no puede estar vacío',
            'nombre2.max' => 'El nombre es muy extenso',
            'nombre2.min' => 'El nombre es muy corto',
            'descripcion2.required' => 'La descripcion no puede estar vacío',
            'descripcion2.max' => 'La descripcion es muy extenso',
            'descripcion2.min' => 'La descripcion es muy corto',
            'precio2.required' => 'El precio no puede estar vacío',
            'precio2.max' => 'El precio es muy grande',
            'precio2.min' => 'El precio es muy pequeño',
            'precio2.numeric' => 'El precio debe de ser numerico',
            'tamanio2.required' => 'El tamanio no puede estar vacío',
            'tamanio2.max' => 'El tamanio es muy extenso',
            'tamanio2.min' => 'El tamanio es muy corto',
            'disponible2.required' => 'El numero de platillos no puede estar vacío',
            'disponible2.max' => 'El numero de platillos disponibles es muy grande',
            'disponible2.min' => 'El numero de platillos disponibles es muy pequeño',
            'disponible2.numeric' => 'El numero de platillos disponibles debe de ser numerico',
        ]);

      
        $actualizacion = Platillo::findOrFail($id);

        $actualizacion->nombre = $request->input('nombre2');
        $actualizacion->descripcion = $request->input('descripcion2');
        $actualizacion->precio = $request->input('precio2');
        $actualizacion->tamanio = $request->input('tamanio2');
        $actualizacion->disponible = $request->input('disponible2');
               
        $creado = $actualizacion -> save();

        if ($creado) {
            return redirect()->route('menuAdmon.index')
            ->with('mensaje', "".$actualizacion->nombre." se actualizo correctamente");
        } 
        
    }
 }

