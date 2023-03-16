<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model
{
    use HasFactory;

    public function mesas()
    {
        return $this->belongsTo(Mesa::class, 'mesa_id', 'id');
    }
}
