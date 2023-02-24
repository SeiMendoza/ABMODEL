<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallesUsuario extends Model
{
    use HasFactory;
    public function pedido()
    {
    
       return $this->belongsTo(Pedido::class);
    }

    public function combo()
    {
        return $this->belongsTo(Combo::class);
    }

    public function bebidas_platillos()
    {
        return $this->belongsTo(PlatillosyBebidas::class);
    }
    public function platillo()
    {
        return $this->belongsTo(Platillo::class);
    }
}
