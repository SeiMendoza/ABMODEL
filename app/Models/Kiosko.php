<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kiosko extends Model
{
    use HasFactory;

    public function mesas(){
        return $this->hasMany(Mesa::class);
    }

    public function reservaciones()
    {
        return $this->belongsToMany(Reservacion::class, 'kiosko_reservacion');
    }
}
