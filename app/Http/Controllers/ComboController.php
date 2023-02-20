<?php

namespace App\Http\Controllers;

use App\Models\Combo;
use Illuminate\Http\Request;
use App\Models\Componentescombo;
use App\Models\PlatillosyBebidas;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComboRequest;
use App\Http\Requests\UpdateComboRequest;
use App\Models\Componentestemporalcombo;

class ComboController extends Controller
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
        $complementos = PlatillosyBebidas::all();
        $componentes = Componentestemporalcombo::all();
        return view('combos/registro')->with('componentes', $componentes)->with('complementos', $complementos);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreComboRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'nombre' => 'required|max:100|min:3',
            'descripcion' => 'required|max:100|min:3',   
            'precio' => 'required|min:1|max:1000|numeric',
            'imagen' => 'required',
        ];

        $mensaje=[
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
            'imagen.required' => 'La imagen no puede estar vacío',
            'imagen.mimes' => 'La imagen debe de ser una imagen',
        ];

        $this->validate($request,$rules,$mensaje);

        $combo = new Combo();

        $combo->nombre = $request->input('nombre');
        $combo->descripcion = $request->input('descripcion');
        $combo->precio = $request->input('precio');

        $file = $request->file('imagen');
        $destinationPath = 'images/';
        $filename = time().'.'.$file->getClientOriginalName();
        $uploadSuccess = $request->file('imagen')->move($destinationPath,$filename);

        $combo->imagen = 'images/'.$filename;

        $creado = $combo->save();

        if ($creado) {
            

            $anteriorcomplemnto = Componentestemporalcombo::all();

            foreach($anteriorcomplemnto as $ac){
                $complemento = new Componentescombo();

                $complemento->id_complemento = $ac->id_complemento;
                $complemento->cantidad = $ac->cantidad;
                $complemento->id_combo = $combo->id;

                $creado2=$complemento->save();

                if($creado2){
                    Componentestemporalcombo::destroy($ac->id);
                }

            }

            return redirect()->route('index')
                ->with('mensaje', 'El combo fue creada exitosamente');

        }

    }

    public function temporal(Request $request)
    {
        $rules=[
            'complemento' => 'required|exists:platillosy_bebidas,id',            
            'cantidad' => 'required|min:1|max:1000|numeric',
        ];

        $mensaje=[
            'complemento.required' => 'La comida o bebida es obligatoria',
            'complemento.exists' => 'La comida o bebida no existe',
            'cantidad.required' => 'La cantidad es obligatoria',
            'cantidad.max' => 'La cantidad es muy grande',
            'cantidad.min' => 'La cantidad es muy pequeño',
            'cantidad.numeric' => 'La cantidad debe de ser numerico',
        ];

        $this->validate($request,$rules,$mensaje);

        $complementos = new Componentestemporalcombo();

        $complementos->id_complemento = $request->input('complemento');
        $complementos->cantidad = $request->input('cantidad');

        $creado = $complementos->save();

        if ($creado) {
            return redirect()->route('combo.create')
                ->with('mensaje', 'El complemento fue creada exitosamente');
        } else {

        }
        
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Combo  $combo
     * @return \Illuminate\Http\Response
     */
    public function show(Combo $combo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Combo  $combo
     * @return \Illuminate\Http\Response
     */
    public function edit(Combo $combo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateComboRequest  $request
     * @param  \App\Models\Combo  $combo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComboRequest $request, Combo $combo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Combo  $combo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Combo $combo)
    {
        //
    }
}
