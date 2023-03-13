<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PiscinaTipo extends Model
{
    use HasFactory;

    public function piscina(){
        return $this->hasMany(Piscina::class);
    }
}
