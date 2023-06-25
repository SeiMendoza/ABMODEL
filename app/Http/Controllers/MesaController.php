<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kiosko;
use App\Models\Mesa;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class MesaController extends Controller
{
    //Registro
    public function index()
    {
        $registros = Mesa::get();
        return view('Reservaciones.ReserAdmon.Mesas.mesasRegistro',  compact('registros'));
    }
    public function Codigo_Qr($id)
    {
        $reg = Mesa::findOrfail($id);
        
 // Convertir el blob en una cadena base64
$base64 = base64_encode($reg->mesa_qr);

// Convertir la cadena base64 en una cadena de datos URI en formato SVG
$qr = 'data:image/svg+xml;base64,' . $base64;
       // $qr = QrCode::Color(255, 0, 0)->size(250)->generate('https://registro.unah.edu.hn/');
        return view('Reservaciones.ReserAdmon.Mesas.mesa_qr',  compact('reg','qr'));
    }
    public function search(Request $request)
    {
        $text = trim($request->get('busqueda'));
        $registros = Mesa::where('nombre', 'like', '%' . $text . '%')
            ->orWhere('cantidad', 'like', '%' . $text . '%')->paginate(12);
        return view("Reservaciones.ReserAdmon.Mesas.mesasRegistro", compact('registros', 'text'));
    }
    public function create()
    {
        $kiosko = Kiosko::all();
        return view('Reservaciones.ReserAdmon.Mesas.formularioRegistro', compact('kiosko'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'codigo' => 'required|regex:/^[K][0-9][0-9][-][M][0-9][0-9]$/|min:7|max:7',
            'name' => 'required|regex:/^[a-zA-Z]{4}+[-][0-9][0-9]$/|max:7|min:7',
            'cantidad' => 'required|min:1|max:20|numeric',
            'kiosko' => 'required' 
        ], [
            'codigo.required' => 'El código no puede estar vacío',
            'codigo.regex' => 'El código no es válido, un ejemplo válido es: K01-M01',
            'codigo.max' => 'El código es muy extenso',
            'codigo.min' => 'El código es muy corto',
            'name.required' => 'El nombre no puede estar vacío',
            'name.regex' => 'El nombre no es válido, uno válido es: Mesa-00',
            'name.max' => 'El nombre es muy extenso',
            'name.min' => 'El nombre es muy corto',
            'cantidad.required' => 'La cantidad no puede estar vacío',
            'cantidad.max' => 'la cantidad es muy alta',
            'cantidad.min' => 'La cantidad es muy baja',
            'cantidad.numeric' => 'La cantidad debe se dde tipo numérico',
            'kiosko.required' => 'Kiosko no puede estar vacío',
        ]);


        $nuevo = new Mesa; 
        $nuevo->codigo = $request->input('codigo');
        $nuevo->nombre = $request->input('name');
        $nuevo->cantidad = $request->input('cantidad');
        $nuevo->kiosko_id = $request->input('kiosko');;
        $qr = QrCode::size(250)->generate('https://www.facebook.com/villacrisol/');

        //Sumar mesa al kiosko 
        $kiosko = Kiosko::findOrFail($request->input('kiosko'));
        $kiosko->cantidad_de_Mesas = $kiosko->cantidad_de_Mesas + 1;
        $kiosko->save();

 // Guardar el QR en la carpeta 'public'
//Storage::putFileAs('public', new \Illuminate\Http\File(storage_path('app/mesa_qr.png')), 'mesa_qr.png');

// Asignar la ruta del archivo a la propiedad de la mesa
//$nuevo->mesa_qr = 'storage/mesa_qr.png';

        $nuevo->mesa_qr = $qr;
        $creado = $nuevo->save();

        if ($creado) {
            return redirect()->route('mesas_reg.index')
                ->with('mensaje', "" . $nuevo->nombre . " creada correctamente");
        }
    }

    public function edit($id)
    {
        $registro = Mesa::findOrFail($id);
        $kiosko = Kiosko::all();
        return view('Reservaciones.ReserAdmon.Mesas.editarRegistro',  compact('registro', 'kiosko'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'codigo' => 'required|regex:/^[K][0-9][0-9][-][M][0-9][0-9]$/|min:7|max:7',
            'name' => 'required|regex:/^[M][e][s][a][-][0-9][0-9]$/|max:7|min:7',
            'cantidad' => 'required|min:1|max:20|numeric',
            'kiosko' => 'required'
        ], [
            'codigo.required' => 'El código no puede estar vacío',
            'codigo.regex' => 'El código no es válido, un ejemplo válido es: K01-M01',
            'codigo.max' => 'El código es muy extenso',
            'codigo.min' => 'El código es muy corto',
            'name.required' => 'El nombre no puede estar vacío',
            'name.regex' => 'El nombre no es válido, uno válido es: Mesa-00',
            'name.max' => 'El nombre es muy extenso',
            'name.min' => 'El nombre es muy corto',
            'cantidad.required' => 'La cantidad no puede estar vacío',
            'cantidad.max' => 'la cantidad es muy alta',
            'cantidad.min' => 'La cantidad es muy baja',
            'cantidad.numeric' => 'La cantidad debe ser de tipo numérico',
            'kiosko.required' => 'Kiosko no puede estar vacío',
        ]);

        $actualizacion = Mesa::findOrFail($id);

        $actualizacion->codigo = $request->input('codigo');
        $actualizacion->nombre = $request->input('name');
        $actualizacion->cantidad = $request->input('cantidad');
        $actualizacion->kiosko_id = $request->input('kiosko');
        $creado = $actualizacion->save();

        if ($creado) {
            return redirect()->route('mesas_reg.index')
                ->with('mensaje', "" . $actualizacion->nombre . " actualizada correctamente");
        }
    }

    public function destroy($id)
    {
        $mesa = Mesa::findOrFail($id);
        $mesa->pedidos()->delete();
        
        Mesa::destroy($id);
        return redirect()->route('mesas_reg.index')->with('mensaje', 'Mesa borrada correctamente');
    }

    //Reservaciones

    public function indexR()
    {
        $reservaciones = Mesa::all();
        return view('Reservaciones.ReserAdmon.Mesas.mesasReservaciones',  compact('reservaciones'));
    }

    public function show()
    {

        return view('Reservaciones.ReserAdmon.Mesas.mesasDetalles');
    }
}
