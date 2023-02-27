<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platillo extends Model
{
    use HasFactory;
    public function detalle_compras()
    {
        return $this->hasMany(DetallesUsuario::class);
    }
}
