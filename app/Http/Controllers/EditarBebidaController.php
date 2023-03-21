<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PlatillosyBebidas;
use App\Models\Platillo;
use App\Models\Bebida;

class EditarBebidaController extends Controller
{
    //
    public function edit($id){
        $Bebidas = Bebida::findOrFail($id);
        return view('Menu/Admon/edicion/editarBebida') 
              -> with('Bebidas', $Bebidas);
    }

    public function update(Request $request, $id){

        $request -> validate ([
            'nombre1' => 'required|max:100|min:3',
            'descripcion1' => 'required|max:100|min:3',   
            'precio1' => 'required|min:1|max:1000|numeric',   
            'tamanio1' => 'required|max:100|min:3', 
            'imagen1' => '',
            'cantidad1' => 'required|min:1|max:1000|numeric',
        ],[
            'nombre1.required' => 'El nombre no puede estar vacío',
            'nombre1.max' => 'El nombre es muy extenso',
            'nombre1.min' => 'El nombre es muy corto',
            'descripcion1.required' => 'La descripcion no puede estar vacío',
            'descripcion1.max' => 'La descripcion es muy extenso',
            'descripcion1.min' => 'La descripcion es muy corto',
            'precio1.required' => 'El precio no puede estar vacío',
            'precio1.max' => 'El precio es muy grande',
            'precio1.min' => 'El precio es muy pequeño',
            'precio1.numeric' => 'El precio debe de ser numerico',
            'tamanio1.required' => 'El tamanio no puede estar vacío',
            'tamanio1.max' => 'El tamanio es muy extenso',
            'tamanio1.min' => 'El tamanio es muy corto',
            'imagen1.required' => 'La imagen no puede estar vacío',
            'imagen1.mimes' => 'La imagen debe de ser una imagen',
            'cantidad1.required' => 'El numero de bebidas no puede estar vacío',
            'cantidad1.max' => 'El numero de bebidas disponibles es muy grande',
            'cantidad1.min' => 'El numero de bebidas disponibles es muy pequeño',
            'cantidad1.numeric' => 'El numero de bebidas disponibles debe de ser numerico',
        ]);

            $actualizacion= Bebida::FindOrFail($id);
            
            $actualizacion->nombre = $request->input('nombre1');
            $actualizacion->descripcion = $request->input('descripcion1');
            $actualizacion->precio = $request->input('precio1');
            $actualizacion->tamanio = $request->input('tamanio1');
            $actualizacion->disponible = $request->input('cantidad1');

            $creado = $actualizacion -> save();

            if ($creado) {
                return redirect()->route('menuAdmon.index')
                    ->with('mensaje', 'La bebida fue modificada exitosamente');
            }
    }
 }


