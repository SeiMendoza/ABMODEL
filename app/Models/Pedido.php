<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $table = 'pedidos';
    public function detalles()
    {
        return $this->hasMany(DetallesUsuario::class,'cantidad');
    }
    public function mesa_nombre()
{
    return $this->belongsTo(Mesa::class,'mesa_id','id');
}

}
