<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kiosko;
use App\Models\Mesa;
use App\Models\Pedido;
use App\Models\Reservacion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KioskoController extends Controller
{
    public function store(Request $request)
    {

        $rules = [
            'codigo' => 'required|unique:kioskos|regex:/^[K][0-9][0-9]$/|min:3|max:3',
            'descripcion' => 'required|max:100|min:5',
            'ubicacion' => 'required|max:100|min:5',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ];

        $messages = [
            'codigo.regex' => 'El código no es válido, un ejemplo válido es: K01',
        ];

        $this->validate($request, $rules, $messages);

        $kiosko = new Kiosko();
        $kiosko->codigo = $request->input('codigo');
        $kiosko->descripcion = $request->input('descripcion');
        $kiosko->ubicacion = $request->input('ubicacion');
        $kiosko->cantidad_de_Mesas = 0;

        //Imagen
        $file = $request->file('imagen');
        $destinationPath = 'images/kioskos/';
        $filename = time() . '.' . $file->getClientOriginalName();
        $uploadSuccess = $request->file('imagen')->move($destinationPath, $filename);
        $kiosko->imagen = 'images/kioskos/' . $filename;

        $create = $kiosko->save();


        if ($create) {
            return to_route('kiosko.index')->with('mensaje', 'Kiosko registrado correctamente');
        }


    }

    public function index(Request $request)
    {

        $kioskos = Kiosko::all();

        if ($request->ajax()) {

            $kioskos = Kiosko::select('id', 'codigo')->get();
            return response()->json($kioskos);
        }

        return view('/Reservaciones/ReserAdmon/Kioskos/indexKioskos')->with(['kioskos' => $kioskos]);
    }

    public function create(Request $request)
    {
        $url = $request->header('referer');
        $url = parse_url($url)['path'];

        return view('/Reservaciones/ReserAdmon/Kioskos/registroKioskos', compact('url'));
    }

    public function edit(Request $request, $id)
    {

        $kiosko = Kiosko::findOrFail($id);

        $url = $request->header('referer');
        $url = parse_url($url)['path'];

        return \view('Reservaciones.ReserAdmon.Kioskos.edicionKioskos', compact('kiosko', 'url'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'descripcion' => 'required|max:100|min:5|regex:/^[\\pL\\s]+$/u',
            'ubicacion' => 'required|max:100|min:5|regex:/^[\\pL\\s]+$/u',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ];
    
        $messages = [
            'codigo.regex' => 'El código no es válido, un ejemplo válido es: K01',
            'descripcion.regex'=>'Solo se permiten letras'
        ];
    
        $this->validate($request, $rules, $messages);
    
        $kioskoUpdate = Kiosko::findOrFail($id);
        $kioskoUpdate->descripcion = $request->input('descripcion');
        $kioskoUpdate->ubicacion = $request->input('ubicacion');
    
        $oldImage = $kioskoUpdate->imagen; // Guarda la ruta de la imagen anterior
    
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $destinationPath = 'images/kioskos/';
            $filename = time() . '.' . $file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPath, $filename);
            $kioskoUpdate->imagen = 'images/kioskos/' . $filename;
    
            if ($oldImage && substr($oldImage, 0, 11) != 'https://via') { // Verifica si existe imagen anterior
                unlink($oldImage); // Elimina la imagen anterior
            }
        }
    
        $kioskoUpdate->save();
    
        $url = $request->header('referer');
        $url = parse_url($url)['path'];
    
        return redirect()->route('kiosko.index')->with('mensaje', 'Kiosko actualizado correctamente');
    }

    public function destroy($id)
    {

        $k = Kiosko::findOrFail($id);
        $k->reservaciones()->delete();
        $m = Mesa::where('kiosko_id', '=', $id);
        $p = Pedido::where('quiosco', '=', $id);
        $p->delete();
        $k->mesas()->delete();
        $k->delete();

        return to_route('kiosko.index')->with('mensaje', 'Kiosko eliminado correctamente');

    }

    public function detalle(Request $request, $id)
    {

        $kiosko = Kiosko::findOrFail($id);
        $mesas = Mesa::whereKiosko_id($id)->get();
        $reservacion = Reservacion::whereKiosko_id($id)->get();
        $now = Carbon::now()->format('Y-m-d');

        $url = $request->header('referer');
        $url = parse_url($url)['path'];

        return view('Reservaciones.ReserAdmon.Kioskos.detalleKiosko', compact('kiosko', 'mesas', 'reservacion', 'now', 'url'));
    }

    public function reservaciones(Request $request, $id)
    {

        $kiosko = Kiosko::findOrFail($id);
        $reservaciones = Reservacion::whereKiosko_id($id)->orderBy('fecha')->get();
        $now = Carbon::now()->format('Y-m-d');

        $todayReservaciones = $reservaciones->where('fecha', '=', $now);
        $pastReservaciones = $reservaciones->where('fecha', '<', $now);
        $futureReservaciones = $reservaciones->where('fecha', '>', $now);

        $url = $request->header('referer');
        $url = parse_url($url)['path'];

        if (!$reservaciones->isEmpty())
            return view('Reservaciones.ReserAdmon.Kioskos.detallesReservacionKiosko', compact('todayReservaciones', 'pastReservaciones', 'futureReservaciones', 'kiosko', 'now', 'url'));
        else
            return back()->with(['mensaje' => 'No hay reservaciones en ' . $kiosko->codigo], ['icon' => 'info']);
    }

    public function reservacionesHistorial(Request $request, $id)
    {

        $kiosko = Kiosko::findOrFail($id);
        $now = Carbon::now()->format('Y-m-d');
        $reservaciones = Reservacion::where('kiosko_id', '=', $id)->where('fecha', '<', $now)->orderBy('fecha', 'desc')->get();

        $url = $request->header('referer');
        $url = parse_url($url)['path'];

        if (!$reservaciones->isEmpty())
            return view('Reservaciones.ReserAdmon.Kioskos.detallesReservacionesAnterioresKiosko', compact('reservaciones', 'kiosko', 'now', 'url'));
        else
            return back()->with(['mensaje' => 'No hay historial de reservaciones'], ['icon' => 'info']);
    }
}