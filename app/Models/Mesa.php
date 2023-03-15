<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    use HasFactory;

    public function kiosko()
    {
        return $this->belongsTo(Kiosko::class, 'kiosko_id', 'id');
    }
    public function reservacion()
    {
        return $this->belongsTo(Reservacion::class);
    }

}
