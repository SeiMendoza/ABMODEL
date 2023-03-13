<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PiscinaUso extends Model
{
    use HasFactory;

    public function piscina(){
        return $this->hasMany(Piscina::class);
    }
}
