<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallesPedido extends Model
{
    use HasFactory;

    public function pedido()
    {
       return $this->belongsTo(Pedido::class,'pedido_id');
    }

    public function producto()
    {
       return $this->belongsTo(Producto::class,'producto_id');
    }
}
