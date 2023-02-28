<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bebida>
 */
class BebidaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre'=>$this->faker->word,
            'descripcion'=>$this->faker->words(10, true),
            'precio'=>$this->faker->numberBetween(0, 100),
            'tamanio'=>$this->faker->randomElement(['Pequeño','Mediano','Grande']),
            'imagen'=>$this->faker->imageUrl(150, 150),
            'disponible'=>$this->faker->randomElement([1,2]),
            'fecha'=>$this->faker->date(),
            'estado'=>$this->faker->boolean()
            
        ];
    }
}
