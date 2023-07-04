<?php

namespace App\Http\Controllers;

use App\Models\Piscina;
use App\Models\PiscinaTipo;
use App\Models\PiscinaUso;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule as ValidationRule;
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
        $prod = Piscina::all();
        $tip = PiscinaTipo::all();
        return view('Piscina/inventario/listaproductos',compact('prod','tip'));
    }
/*public function search(Request $request){
    $prod = Piscina::all();
    $tip = PiscinaTipo::all();
    $text = trim($request->get('busqueda'));
    $prod = Piscina::where('nombre', 'like', '%' . $text . '%')->paginate(10);
    $tip = PiscinaTipo::where('descripcion', 'like', '%' . $text . '%')->paginate(10);
        return view('Piscina/inventario/listaproductos',compact('prod','tip','text'));
}*/
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
    /*    $fecha_actual = date("d-m-Y");
        $minima = date('d-m-Y',$minima = strtotime($fecha_actual."+ 1 month"));
*/
        $rules=[
            'nombre' => 'required|regex:/^[\\pL\\s]+$/u|unique:piscinas',
            'tipo' => 'required|exists:piscina_tipos,id',
            'uso' => 'required|exists:piscina_usos,id',
           // 'expiracion' => 'required|date|after:'.$minima,
            'kilos' => 'required|numeric|min:0|max:1000'
        ];

        $mensaje=[
            'nombre.required' => 'El nombre no puede estar vacío',
            'nombre.regex' => 'Solo se aceptan letras',
            'nombre.unique' => 'El producto solo se puede registra una vez',
            'tipo.required' => 'El tipo de producto no puede estar vacío',
            'tipo.exists' => 'El tipo de producto no es valido',
            'uso.required' => 'El uso de producto no puede estar vacío',
            'uso.exists' => 'El uso de producto no es valido',
            'expiracion.required' => 'La fecha de expiracion no puede estar vacío',
           // 'expiracion.date' => 'La fecha de expiracion debe de ser una fecha',
           // 'expiracion.after' => 'La fecha de expiracion debe de ser posterior a '.$minima,
            'kilos.required' => 'El peso no puede estar vacío',
            'kilos.max' => 'El peso es muy grande',
            'kilos.min' => 'El peso es muy pequeño',
            'kilos.numeric' => 'El peso debe de ser numerico',
        ];

        $this->validate($request,$rules,$mensaje);

        // Busca si ya existe un registro con el mismo nombre, tipo y uso
    $piscina = Piscina::where('nombre', $request->input('nombre'))
    ->where('tipo', $request->input('tipo'))
    ->where('uso', $request->input('uso'))
    ->first();

        if ($piscina) {
            // Si ya existe el producto solo se suma la cantidad
            $piscina->peso += $request->input('kilos');
            $piscina->save();
        } else {
            // Si no existe el producto se crea uno nuevo
            $piscina = new Piscina();
            $piscina->nombre = $request->input('nombre');
            $piscina->tipo = $request->input('tipo');
            $piscina->uso = $request->input('uso');
          //  $piscina->fecha_expiracion = $request->input('expiracion');
            $piscina->peso = $request->input('kilos');

            $creado = $piscina->save();
        }
          //  if ($creado) {
                return redirect()->route('prodpiscina.index')
                    ->with('mensaje', 'El producto de piscina fue creada exitosamente');
          //  }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Piscina  $piscina
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $piscina = Piscina::findOrFail($id);
        $tipo = PiscinaTipo::all();
        return view('Piscina/inventario/editarproductop',compact('piscina','tipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePiscinaRequest  $request
     * @param  \App\Models\Piscina  $piscina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $piscina = Piscina::FindOrFail($id);
    /*    $fecha_actual = date("d-m-Y");
        $minima = date('d-m-Y',$minima = strtotime($fecha_actual."+ 1 month"));
*/
        $rules=[
            'nombre' => [
                'required',
                'regex:/^[\\pL\\s]+$/u',
                ValidationRule::unique('piscinas')->ignore($piscina->id),],
            'tipo' => 'required|exists:piscina_tipos,id',
            'uso' => 'required|exists:piscina_usos,id',
           // 'expiracion' => 'required|date|after:'.$minima,
            'kilos' => 'required|numeric|min:1|max:1000'
        ];

        $mensaje=[
            'nombre.required' => 'El nombre no puede estar vacío',
            'nombre.regex' => 'Solo se aceptan letras',
            'nombre.unique' => 'El producto solo se puede registra una vez',
            'tipo.required' => 'El tipo de producto no puede estar vacío',
            'tipo.exists' => 'El tipo de producto no es valido',
            'uso.required' => 'El uso de producto no puede estar vacío',
            'uso.exists' => 'El uso de producto no es valido',
           // 'expiracion.required' => 'La fecha de expiración no puede estar vacío',
           // 'expiracion.date' => 'La fecha de expiración debe de ser una fecha',
           // 'expiracion.after' => 'La fecha de expiración debe de ser posterior a '.$minima,
            'kilos.required' => 'El peso no puede estar vacío',
            'kilos.max' => 'El peso es muy grande',
            'kilos.min' => 'El peso es muy pequeño',
            'kilos.numeric' => 'El peso debe de ser numerico',
        ];

        $this->validate($request,$rules,$mensaje);

        $piscina = Piscina::FindOrFail($id);

            $piscina->nombre = $request->input('nombre');
            $piscina->tipo = $request->input('tipo');
            $piscina->uso = $request->input('uso');
           // $piscina->fecha_expiracion = $request->input('expiracion');
            $piscina->peso = $request->input('kilos');
            $creado = $piscina->save();

            if ($creado) {
                return redirect()->route('prodpiscina.index')
                    ->with('mensaje', 'El producto fue actualizado exitosamente');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Piscina  $piscina
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Piscina::destroy($id);
        return redirect()->route('prodpiscina.index')->with('mensaje', 'Producto borrado correctamente');
    }

    public function agregar(Request $request,$id){
        $rules=[
            'cantidad' => 'required|numeric|min:1|max:1000'
        ];

        $mensaje=[
            'cantidad.required' => 'La cantidad no puede estar vacío',
            'cantidad.max' => 'La cantidad es muy grande',
            'cantidad.min' => 'La cantidad es muy pequeño',
            'cantidad.numeric' => 'La cantidad debe de ser numerico',
        ];
        $this->validate($request,$rules,$mensaje);
        $piscina = Piscina::FindOrFail($id);
        $piscina->peso += $request->input('cantidad');
        $creado = $piscina->save();

        if ($creado) {
            return redirect()->route('prodpiscina.index')
                ->with('mensaje', 'La cantidad del producto fue actualizado exitosamente');
        }
    }

    public function restar(Request $request,$id){
        $piscina = Piscina::FindOrFail($id);

        $rules=[
            'cantidad' => 'required|numeric|min:1|max:'.$piscina->peso
        ];

        $mensaje=[
            'cantidad.required' => 'La cantidad no puede estar vacío',
            'cantidad.max' => 'La cantidad es mayor a la existente',
            'cantidad.min' => 'La cantidad es muy pequeño',
            'cantidad.numeric' => 'La cantidad debe de ser numerico',
        ];
        $this->validate($request,$rules,$mensaje);
        $piscina->peso -= $request->input('cantidad');
        $creado = $piscina->save();

        if ($creado) {
            return redirect()->route('prodpiscina.index')
                ->with('mensaje', 'La cantidad del producto fue actualizado exitosamente');
        }
    }

    public function show($id){
        $piscina = Piscina::FindOrFail($id);
        return view('Piscina.detalleproducto',compact('piscina'));
    }
}
