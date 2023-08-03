<?php

namespace App\Http\Controllers;

use App\Models\Bebida;
use App\Models\Combo;
use App\Models\Platillo;
use App\Models\Piscina;
use App\Models\PiscinaTipo;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;


class HomeController extends Controller
{
    public function index()
    {
        $datosalerta = Piscina::select('piscinas.id', 'piscina_tipos.descripcion', DB::raw('COUNT(*) AS total'), DB::raw('SUM(piscinas.peso) AS peso'))
            ->join('piscina_tipos', 'piscinas.tipo', '=', 'piscina_tipos.id')->groupby('piscinas.id', 'piscina_tipos.descripcion')->get();

        return view("index", compact('datosalerta'));
    }

    public function b()
    {
        return view("pages.billing");
    }

    public function t()
    {
        return view("pages.tables");
    }

    public function indexAdmon(Request $request)
    {
        $productos = Producto::all();

        if ($request->ajax()) {

            return datatables()->of($productos)->toJson();
        }
        return view("/Menu/Admon/indexComplementos")->with(['productos' => $productos]);
    }
    public function indexPlatillos(Request $request)
    {
        $productos = Producto::whereTipo(2);

        if ($request->ajax()) {

            $estado = intval($request->input('estado')); //recuperar y convertir el valor enviado por AJAX (data: { estado: 0 o 1})            

            if ($estado)
                $productos = $productos->whereEstado(1)->get();
            else
                $productos = $productos->whereEstado(0)->get();

            return datatables()->of($productos)->toJson();
        }

        return view("/Menu/Admon/indexPlatillos");
    }
    public function indexBebidas(Request $request)
    {
        $productos = Producto::whereTipo(1);

        if ($request->ajax()) {

            $estado = intval($request->input('estado')); //recuperar y convertir el valor enviado por AJAX (data: { estado: 0 o 1})            

            if ($estado)
                $productos = $productos->whereEstado(1)->get();
            else
                $productos = $productos->whereEstado(0)->get();

            return datatables()->of($productos)->toJson();
        }

        return view("/Menu/Admon/indexBebidas")->with(['productos' => $productos]);
    }

    public function indexComplementos(Request $request)
    {

        $productos = Producto::whereTipo(0);

        if ($request->ajax()) {

            $estado = intval($request->input('estado')); //recuperar y convertir el valor enviado por AJAX (data: { estado: 0 o 1})            

            if ($estado)
                $productos = $productos->whereEstado(1)->get();
            else
                $productos = $productos->whereEstado(0)->get();

            return datatables()->of($productos)->toJson();
        }

        return view("/Menu/Admon/indexComplementos");
    }


    public function pruebaAdmon(Request $request)
    {

        $productos = Producto::all();

        if ($request->ajax()) {

            return datatables()->of($productos)->toJson();
        }

        return view("/Menu/Admon/pruebaAdmon", compact('productos'))->with('mensaje', 'Kiosko actualizado correctamente');
    }


    public function p()
    {
        return view('pages.profile');
    }

    public function s()
    {
        return view("pages.sign-in");
    }

    public function r()
    {
        return view("pages.rtl");
    }
    public function d()
    {
        return view("pages.dashboard");
    }
    public function registro()
    {
        return view("pages.registro");
    }
    public function u()
    {
        return view("pages.sign-up");
    }
}