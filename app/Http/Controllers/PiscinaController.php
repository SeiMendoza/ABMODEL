<?php

namespace App\Http\Controllers;

use App\Models\Piscina;
use App\Models\PiscinaTipo;
use App\Models\PiscinaUso;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePiscinaRequest;
use App\Http\Requests\UpdatePiscinaRequest;
use Illuminate\Http\Request;

class PiscinaController extends Controller
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
        $tipo = PiscinaTipo::all();
        $uso = PiscinaUso::all();
        return view('Piscina.registrarPiscina',compact('tipo','uso'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePiscinaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fecha_actual = date("d-m-Y");
        $minima = date('d-m-Y',$minima = strtotime($fecha_actual."+ 1 month"));

        $rules=[
            'nombre' => 'required',
            'tipo' => 'required|exists:piscina_tipos,id',
            'uso' => 'required|exists:piscina_usos,id',
            'expiracion' => 'required|date|after:'.$minima,
        ];

        $mensaje=[
            'nombre.required' => 'El nombre no puede estar vacío',
            'tipo.required' => 'El tipo de producto no puede estar vacío',
            'tipo.exists' => 'El tipo de producto no es valido',
            'uso.required' => 'El uso de producto no puede estar vacío',
            'uso.exists' => 'El uso de producto no es valido',
            'expiracion.required' => 'La fecha de expiracion no puede estar vacío',
            'expiracion.date' => 'La fecha de expiracion debe de ser una fecha',
            'expiracion.after' => 'La fecha de expiracion debe de ser posterior a '.$minima,
        ];

        $this->validate($request,$rules,$mensaje);

            $piscina = new Piscina();

            $piscina->nombre = $request->input('nombre');
            $piscina->tipo = $request->input('tipo');
            $piscina->uso = $request->input('uso');
            $piscina->fecha_expiracion = $request->input('expiracion');

            $creado = $piscina->save();

            if ($creado) {
                return redirect()->route('piscina.create')
                    ->with('mensaje', 'El producto de piscina fue creada exitosamente');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Piscina  $piscina
     * @return \Illuminate\Http\Response
     */
    public function show(Piscina $piscina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Piscina  $piscina
     * @return \Illuminate\Http\Response
     */
    public function edit(Piscina $piscina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePiscinaRequest  $request
     * @param  \App\Models\Piscina  $piscina
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePiscinaRequest $request, Piscina $piscina)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Piscina  $piscina
     * @return \Illuminate\Http\Response
     */
    public function destroy(Piscina $piscina)
    {
        //
    }
}
