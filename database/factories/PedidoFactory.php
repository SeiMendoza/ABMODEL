<?php

namespace Database\Factories;

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
            'mesa'=>$this->faker->numberBetween(1, 20),
            'quiosco'=>$this->faker->numberBetween(1, 10),
            'nombreCliente'=>$this->faker->name,
            'imp'=>$this->faker->numberBetween(10, 100),
            'total'=>$this->faker->numberBetween(10,100),
            'estado'=>$this->faker->numberBetween(0,1),
            'estado_cocina'=>$this->faker->numberBetween(0,1),
        ];
    }
}
