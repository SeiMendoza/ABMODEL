<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    use HasFactory;
    public function detalle_compra()
    {
        return $this->hasMany(DetallesUsuario::class);
    }
}
