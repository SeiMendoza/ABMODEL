<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Componentestemporalcombo extends Model
{
    use HasFactory;

    public function componente(){
        return $this->belongsTo(PlatillosyBebidas::class, 'id_complemento', 'id');
    }
}
