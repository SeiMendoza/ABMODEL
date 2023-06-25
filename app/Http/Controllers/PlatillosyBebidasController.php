<?php

namespace App\Http\Controllers;

use App\Models\PlatillosyBebidas;
use App\Models\Platillo;
use App\Models\Bebida;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePlatillosyBebidasRequest;
use App\Http\Requests\UpdatePlatillosyBebidasRequest;
use App\Models\Producto;

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
    public function create($origen)
    {
        return view('/Menu/Admon/Registro/registroPlatillosYBebidas')->with('origen',  $origen);
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
            'tipo' => 'required|in:0,2,1',
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
            'cantidad.max' => 'El numero de bebidas disponibles es muy grande',
            'cantidad.min' => 'El numero de bebidas disponibles es muy pequeño',
            'cantidad.numeric' => 'El numero de bebidas disponibles debe de ser numerico',
            'disponible.max' => 'El numero de platillos disponibles es muy grande',
            'disponible.min' => 'El numero de platillos disponibles es muy pequeño',
            'disponible.numeric' => 'El numero de platillos disponibles debe de ser numerico',
        ];

        $this->validate($request,$rules,$mensaje);

        if ($request->input('tipo') == 2) {
            $platillos = new Producto();

            $platillos->nombre = $request->input('nombre');
            $platillos->descripcion = $request->input('descripcion');
            $platillos->precio = $request->input('precio');
            $platillos->tamanio = $request->input('tamanio');
            $platillos->disponible = $request->input('cantidad');
            $platillos->tipo = $request->input('tipo');


            $file = $request->file('imagen');
            $destinationPath = 'images/';
            $filename = time().'.'.$file->getClientOriginalName();
            $uploadSuccess = $request->file('imagen')->move($destinationPath,$filename);

            $platillos->imagen = 'images/'.$filename;

            $creado = $platillos->save();

            if ($creado) {
                return redirect()->route('menuAdmon.platillos')
                    ->with('mensaje', 'El platillo fue creada exitosamente');
            }

        }else if($request->input('tipo') == 1 ){
            $platillos = new Producto();

            $platillos->nombre = $request->input('nombre');
            $platillos->descripcion = $request->input('descripcion');
            $platillos->precio = $request->input('precio');
            $platillos->tamanio = $request->input('tamanio');
            $platillos->disponible = $request->input('cantidad');
            $platillos->tipo = $request->input('tipo');

            $file = $request->file('imagen');
            $destinationPath = 'images/';
            $filename = time().'.'.$file->getClientOriginalName();
            $uploadSuccess = $request->file('imagen')->move($destinationPath,$filename);

            $platillos->imagen = 'images/'.$filename;

            $creado = $platillos->save();

            if ($creado) {
                return redirect()->route('menuAdmon.bebidas')
                    ->with('mensaje', 'La bebida fue creada exitosamente');
            }
        }else if($request->input('tipo') == 0){
            $platillos = new Producto();

            $platillos->nombre = $request->input('nombre');
            $platillos->descripcion = $request->input('descripcion');
            $platillos->precio = $request->input('precio');
            $platillos->tamanio = $request->input('tamanio');
            $platillos->disponible = $request->input('cantidad');
            $platillos->tipo = $request->input('tipo');

            $file = $request->file('imagen');
            $destinationPath = 'images/';
            $filename = time().'.'.$file->getClientOriginalName();
            $uploadSuccess = $request->file('imagen')->move($destinationPath,$filename);

            $platillos->imagen = 'images/'.$filename;

            $creado = $platillos->save();

            if ($creado) {
                return redirect()->route('menuAdmon.complementos')
                    ->with('mensaje', 'El Complemento fue creado exitosamente');
            }
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
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePlatillosyBebidasRequest  $request
     * @param  \App\Models\PlatillosyBebidas  $platillosyBebidas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $request -> validate ([
            'tipo' => 'required|in:3,2,1',
            'nombre' => 'required|max:100|min:3|regex:/^[a-zA-Z\s\áÁéÉíÍóÓpLñÑ\.]+$/',
            'descripcion' => 'required|max:100|min:3',   
            'precio' => 'required|min:1|max:1000|numeric',   
            'tamanio' => 'required|max:100|min:3', 
            'imagen' => '',
            'cantidad' => 'min:1|max:1000|numeric',
        ],[
            'tipo.required' => 'El tipo no puede estar vacío',
            'nombre.required' => 'El nombre no puede estar vacío',
            'nombre.max' => 'El nombre es muy extenso',
            'nombre.min' => 'El nombre es muy corto',
            'nombre.regex'=> 'El nombre debe tener solo letras',
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
            'cantidad.max' => 'El número de complementos disponibles es muy grande',
            'cantidad.min' => 'El número de complementos disponibles es muy pequeño',
            'cantidad.numeric' => 'La cantidad de complementos disponibles debe de ser numerico',
        ]);

            $actualizacion= Producto::FindOrFail($id);

            $actualizacion->nombre = $request->input('nombre');
            $actualizacion->descripcion = $request->input('descripcion');
            $actualizacion->precio = $request->input('precio');
            $actualizacion->tamanio = $request->input('tamanio');
            $actualizacion->disponible = $request->input('cantidad');
            $actualizacion->esComplemento = 1;
            $actualizacion->tipo = 0;

            if($request->hasFile('imagen')){
                $file = $request->file('imagen');
                $destinationPath = 'images/';
                $filename = time().'.'.$file->getClientOriginalName();
                $uploadSuccess = $request->file('imagen')->move($destinationPath,$filename);
                $actualizacion->imagen = 'images/'.$filename;
    
                }else{
                    unset($actualizacion['imagen']);
            }

            $creado = $actualizacion->save();

            if ($creado) {
                return redirect()->route('menuAdmon.complementos')
                    ->with('mensaje', "Complemento ".$actualizacion->nombre." se actualizó correctamente");
            }
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
