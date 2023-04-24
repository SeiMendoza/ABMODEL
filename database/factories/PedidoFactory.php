<?php

namespace Database\Factories;

use App\Models\Kiosko;
use App\Models\Mesa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pedido>
 */
class PedidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [ 
            'quiosco'=> Kiosko::get('id')->random(),
            'nombreCliente'=>$this->faker->name,
            'imp'=>$this->faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 250),
            'total'=>$this->faker->randomFloat($nbMaxDecimals = 2, $min = 50, $max = 550),
            'estado'=>$this->faker->numberBetween(0,1),
            'estado_cocina'=>$this->faker->numberBetween(0,1),
            'mesa_id'=> Mesa::get('id')->random(),
            
        ];
    }
}
