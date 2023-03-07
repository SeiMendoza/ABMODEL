<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallesUsuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'pedido_id',
        'platillo_id',
        'cantidad',
        'precio',
        'created_at',
        'updated_at'
    ];

    public function pedido()
    {
    
       return $this->belongsTo(Pedido::class);
    }

    public function combos()
    {
        return $this->belongsTo(Combo::class);
    }

    public function bebidas()
    {
        return $this->belongsTo(Bebida::class);
    }
    public function platillos()
    {
        return $this->belongsTo(Platillo::class,'platillo:id');
    }
}
