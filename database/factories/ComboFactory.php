<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Combo>
 */
class ComboFactory extends Factory
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
            'imagen'=>$this->faker->imageUrl(200, 200),
            'estado'=>$this->faker->boolean()
        ];
    }
}
