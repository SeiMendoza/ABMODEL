<?php

namespace App\Http\Controllers;

use App\Models\PlatillosyBebidas;
use App\Models\Platillo;
use App\Models\Bebida;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePlatillosyBebidasRequest;
use App\Http\Requests\UpdatePlatillosyBebidasRequest;

class PlatillosyBebidasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function bebidasnuevo(Request $request){
        $rules=[
            'nombre1' => 'required|max:100|min:3',
            'descripcion1' => 'required|max:100|min:3',   
            'precio1' => 'required|min:1|max:1000|numeric',   
            'tamanio1' => 'required|max:100|min:3', 
            'imagen1' => 'required',
            'cantidad1' => 'required|min:1|max:1000|numeric',
        ];

        $mensaje=[
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
        ];

        $this->validate($request,$rules,$mensaje);

        $platillos = new Bebida();
            
        $platillos->nombre = $request->input('nombre1');
        $platillos->descripcion = $request->input('descripcion1');
        $platillos->precio = $request->input('precio1');
        $platillos->tamanio = $request->input('tamanio1');
        $platillos->disponible = $request->input('cantidad1');

        $file = $request->file('imagen1');
        $destinationPath = 'images/';
        $filename = time().'.'.$file->getClientOriginalName();
        $uploadSuccess = $request->file('imagen1')->move($destinationPath,$filename);

        $platillos->imagen = 'images/'.$filename;

        $creado = $platillos->save();

        if ($creado) {
            return redirect()->route('menuAdmon.index')
                ->with('mensaje', 'La bebida fue creada exitosamente');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePlatillosyBebidasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function platillosnuevo(Request $request)
    {
        $rules=[
            'nombre2' => 'required|max:100|min:3',
            'descripcion2' => 'required|max:100|min:3',   
            'precio2' => 'required|min:1|max:1000|numeric',   
            'tamanio2' => 'required', 
            'imagen2' => 'required',
            'disponible2' => 'required|min:1|max:1000|numeric',
        ];

        $mensaje=[
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
            'imagen2.required' => 'La imagen no puede estar vacío',
            'imagen2.mimes' => 'La imagen debe de ser una imagen',
            'disponible2.required' => 'El numero de platillos no puede estar vacío',
            'disponible2.max' => 'El numero de platillos disponibles es muy grande',
            'disponible2.min' => 'El numero de platillos disponibles es muy pequeño',
            'disponible2.numeric' => 'El numero de platillos disponibles debe de ser numerico',
        ];

        $this->validate($request,$rules,$mensaje);

        $platillos = new Platillo();

        $platillos->nombre = $request->input('nombre2');
        $platillos->descripcion = $request->input('descripcion2');
        $platillos->precio = $request->input('precio2');
        $platillos->tamanio = $request->input('tamanio2');
        $platillos->disponible = $request->input('disponible2');

        $file = $request->file('imagen2');
        $destinationPath = 'images/';
        $filename = time().'.'.$file->getClientOriginalName();
        $uploadSuccess = $request->file('imagen2')->move($destinationPath,$filename);

        $platillos->imagen = 'images/'.$filename;

        $creado = $platillos->save();

        if ($creado) {
            return redirect()->route('menuAdmon.index')
                ->with('mensaje', 'El platillo fue creada exitosamente');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlatillosyBebidas  $platillosyBebidas
     * @return \Illuminate\Http\Response
     */
    public function show(PlatillosyBebidas $platillosyBebidas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlatillosyBebidas  $platillosyBebidas
     * @return \Illuminate\Http\Response
     */
    public function edit(PlatillosyBebidas $platillosyBebidas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePlatillosyBebidasRequest  $request
     * @param  \App\Models\PlatillosyBebidas  $platillosyBebidas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlatillosyBebidasRequest $request, PlatillosyBebidas $platillosyBebidas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlatillosyBebidas  $platillosyBebidas
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlatillosyBebidas $platillosyBebidas)
    {
        //
    }
}
