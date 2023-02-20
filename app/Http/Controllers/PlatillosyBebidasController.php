<?php

namespace App\Http\Controllers;

use App\Models\PlatillosyBebidas;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('PlatillosyBebidas/registro');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePlatillosyBebidasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'tipo' => 'required|in:0,1',
            'nombre' => 'required|max:100|min:3',
            'descripcion' => 'required|max:100|min:3',   
            'precio' => 'required|min:1|max:1000|numeric',   
            'tamanio' => 'required|max:100|min:3', 
            'imagen' => 'required',
            
            'cantidad' => 'nullable|min:1|max:1000|numeric',
            'disponible' => 'nullable|min:1|max:1000|numeric',
        ];

        $mensaje=[
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
            'imagen.required' => 'La imagen no puede estar vacío',
            'imagen.mimes' => 'La imagen debe de ser una imagen',
            'cantidad.max' => 'La cantidad es muy grande',
            'cantidad.min' => 'La cantidad es muy pequeño',
            'cantidad.numeric' => 'La cantidad debe de ser numerico',
            'disponible.max' => 'El numero de platillos disponibles es muy grande',
            'disponible.min' => 'El numero de platillos disponibles es muy pequeño',
            'disponible.numeric' => 'El numero de platillos disponibles debe de ser numerico',
        ];

        $this->validate($request,$rules,$mensaje);

        $platillos = new PlatillosyBebidas();

        $platillos->tipo = $request->input('tipo');
        $platillos->nombre = $request->input('nombre');
        $platillos->descripcion = $request->input('descripcion');
        $platillos->precio = $request->input('precio');
        $platillos->tamanio = $request->input('tamanio');
        $platillos->cantidad = $request->input('cantidad');
        $platillos->disponible = $request->input('disponible');

        $file = $request->file('imagen');
        $destinationPath = 'images/';
        $filename = time().'.'.$file->getClientOriginalName();
        $uploadSuccess = $request->file('imagen')->move($destinationPath,$filename);

        $platillos->imagen = 'images/'.$filename;

        $creado = $platillos->save();

        if ($creado) {
            return redirect()->route('index')
                ->with('mensaje', 'El platillo fue creada exitosamente');
        } else {

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
