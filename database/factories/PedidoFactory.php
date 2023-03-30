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
            'mesa'=> Mesa::get('id')->random(),
            'quiosco'=> Kiosko::get('id')->random(),
            'nombreCliente'=>$this->faker->name,
            'imp'=>$this->faker->numberBetween(10, 100),
            'total'=>$this->faker->numberBetween(10,100),
            'estado'=>$this->faker->numberBetween(0,1),
            'estado_cocina'=>$this->faker->numberBetween(0,1),
            
        ];
    }
}
