<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetallesPedidoController extends Controller
{
    public function index() {
        return view('Menu.Cliente.menuCaja');
    }

}
