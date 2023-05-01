<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kiosko>
 */
class KioskoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'codigo'=>$this->faker->numerify('K##'),
            'descripcion'=>$this->faker->words(10, true),
            'cantidad_de_Mesas'=>$this->faker->numberBetween(0, 10),
            'ubicacion'=>$this->faker->randomElement(['Cerca','Media Distancia','Lejano']),
            'imagen'=>$this->faker->imageUrl(150, 150)
        ];
    }
}
