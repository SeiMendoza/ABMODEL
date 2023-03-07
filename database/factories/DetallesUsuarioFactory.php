<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetallesUsuario>
 */
class DetallesUsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'pedido_id'=>$this->faker->numberBetween(0, 100),
            'platillo_id'=>$this->faker->numberBetween(0, 100),
            'cantidad'=>$this->faker->numberBetween(1, 100),
            'precio'=>$this->faker->numberBetween(1,100)
        ];
    }
}
