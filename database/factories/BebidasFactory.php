<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bebida>
 */
class BebidasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "id"=>fake()->numerify('######'),
            'nombre'=>fake()->words(2, true),
            'descripcion'=>fake()->text(40),
            'precio'=>fake()->numberBetween(1, 300),
            'tamanio'=>fake()->randomElement(['Personal', 'Grupal', 'Familiar']),
            'imagen'=>fake()->imageUrl(360, 360, 'animals', true, 'dogs', true),
            'disponible'=>fake()->randomNumber(3),
            'fecha'=>fake()->date(),
            'estado'=>fake()->boolean()
            
        ];
    }
}
