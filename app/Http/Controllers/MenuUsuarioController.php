<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlatillosyBebidas;

class MenuUsuarioController extends Controller
{
    /*Visualizar el menu por usuario*/
    public function index(Request $request)
    {
        $menu = PlatillosyBebidas::all();
        $text = trim($request->get('/'));
        $menu = PlatillosyBebidas::where('nombre', 'like', '%' . $text . '%')
            ->orWhere('tamanio', 'like', '%' . $text . '%')
            ->orWhere('tipo', 'like', '%' . $text . '%')->paginate(10);
        return view('Menu/Cliente/Menu', compact('menu', 'text'));
    }
}
