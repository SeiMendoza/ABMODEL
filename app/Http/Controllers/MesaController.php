<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kiosko;
use App\Models\Mesa;
use PDF;
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
        $mesa = Mesa::findOrFail($id);
        $Qr = asset($mesa->mesa_qr); // ruta para mostrar el qr
        return view('Reservaciones.ReserAdmon.Mesas.mesa_qr', compact('mesa', 'Qr'));
    }
    // descargar qr en pdf para cada mesa
    public function Qr_pdf($id)
    {
        $mesa = Mesa::findOrFail($id);
        $datos = [
            'Titulo' => 'Código QR: ' .$mesa->nombre,
            'Qr' => $mesa->mesa_qr, // Pasa la ruta de la imagen a la vista
        ];
        $pdf = PDF::loadView('Reservaciones.ReserAdmon.Mesas.mesa_qr_pdf', $datos);//Muestra la vista que contiene el Qr

        return $pdf->download('Qr_'.$mesa->nombre .'.pdf');
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
            'cantidad' => 'required|min:6|max:8|numeric',
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

        $nuevo = new Mesa;
        $nuevo->codigo = $request->input('codigo');
        $nuevo->nombre = $request->input('name');
        $nuevo->cantidad = $request->input('cantidad');
        $nuevo->kiosko_id = $request->input('kiosko');
        // Generar el código QR
        $qrCode = QrCode::format('svg')->size(250)->generate('https://www.facebook.com/villacrisol/' . $nuevo->nombre);

        // Generar un nombre para la imagen
        $filename = 'Qr_' . $nuevo->nombre . '.svg';

        // Guardar la imagen en la carpeta public/imagenes
        $storagePath = public_path('imagenes/' . $filename);
        file_put_contents($storagePath, $qrCode);

        // Guardar la ruta relativa de la imagen en mesa_qr de la mesa
        $nuevo->mesa_qr = 'imagenes/' . $filename;

        // Guardar la nueva mesa en la base de datos
        $creado = $nuevo->save();

        if ($creado) {
            // Sumar mesa al kiosko 
            $kiosko = Kiosko::findOrFail($request->input('kiosko'));
            $kiosko->cantidad_de_Mesas = $kiosko->cantidad_de_Mesas + 1;
            $kiosko->save();

            return redirect()->route('mesas_reg.index')->with('mensaje', "" . $nuevo->nombre . " creada correctamente");
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
            'cantidad' => 'required|min:6|max:8|numeric',
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

        // Generar el código QR
        $qrCode = QrCode::format('svg')->size(250)->generate('https://www.facebook.com/villacrisol/' . $actualizacion->nombre);

        // Generar un nombre para la imagen
        $filename = 'Qr_' . $actualizacion->nombre . '.svg';

        // Guardar la imagen en la carpeta public/imagenes
        $storagePath = public_path('imagenes/' . $filename);
        file_put_contents($storagePath, $qrCode);
        // Actualizar el campo mesa_qr con la nueva ruta de la imagen
        $actualizacion->mesa_qr = 'imagenes/' . $filename;
        //guarda la actualización
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
