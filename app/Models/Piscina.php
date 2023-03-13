<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piscina extends Model
{
    use HasFactory;
    public function tipo_producto()
    {
        return $this->belongsTo(PiscinaTipo::class, 'tipo', 'id');
    }

    public function uso_piscina()
    {
        return $this->belongsTo(PiscinaUso::class, 'uso', 'id');
    }
}
