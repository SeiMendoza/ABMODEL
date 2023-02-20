<?php

namespace App\Http\Controllers;

use Database\Seeders\PlatillosyBebidasSeeder;
 
use Illuminate\Http\Request;

class PedidoUsuarioController extends Controller
{
    public function create()
    {
        return view("Menu.Cliente.pedido");
    }
}
