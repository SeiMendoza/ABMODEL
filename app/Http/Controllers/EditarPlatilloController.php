<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            'imagen' => 'required',
            'cantidad' => 'nullable|min:1|max:1000|numeric',
            'disponible' => 'nullable|min:1|max:1000|numeric'
        ]);

        if ($request->input('tipo') == 2) {
            $actualizacion = Platillo::findOrFail($id);

        $actualizacion->nombre = $request->input('nombre');
        $actualizacion->descripcion = $request->input('descripcion');
        $actualizacion->precio = $request->input('precio');
        $actualizacion->tamanio = $request->input('tamanio');
        $actualizacion->disponible = $request->input('disponible');

        $file = $request->file('imagen');
        $destinationPath = 'images/';
        $filename = time().'.'.$file->getClientOriginalName();
        $uploadSuccess = $request->file('imagen')->move($destinationPath,$filename);

        $actualizacion -> imagen = 'images/'.$filename;

        $creado = $actualizacion -> save();

            if ($creado) {
               return redirect()->route('menuAdmon.index')
                ->with('mensaje', 'El platillo fue modificado exitosamente');
            } 

        }else{
            $actualizacion= Bebida::FindOrFail($id);
            
            $actualizacion->nombre = $request->input('nombre');
            $actualizacion->descripcion = $request->input('descripcion');
            $actualizacion->precio = $request->input('precio');
            $actualizacion->tamanio = $request->input('tamanio');
            $actualizacion->disponible = $request->input('cantidad');

            $file = $request->file('imagen');
            $destinationPath = 'images/';
            $filename = time().'.'.$file->getClientOriginalName();
            $uploadSuccess = $request->file('imagen')->move($destinationPath,$filename);

            $actualizacion->imagen = 'images/'.$filename;

            $creado = $actualizacion -> save();

            if ($creado) {
                return redirect()->route('admonRestaurante')
                    ->with('mensaje', 'La bebida fue modificada exitosamente');
            }
        }
    }
 }

