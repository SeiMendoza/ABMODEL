<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kiosko extends Model
{
    use HasFactory;
    protected $fillable = ['codigo'];

    public function mesas()
    {
        return $this->hasMany(Mesa::class);
    }

    public function reservaciones()
    {
        return $this->HasMany(Reservacion::class);
    }
}
