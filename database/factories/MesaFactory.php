<?php

namespace Database\Factories;

use App\Models\Kiosko;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mesa>
 */
class MesaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'codigo'=>$this->faker->numerify('######-######-#'),
            'nombre'=>$this->faker->numerify('Mesa-').$this->faker->numberBetween(1,25),
            'cantidad'=>$this->faker->numberBetween(1,20),
            'kiosko_id'=> Kiosko::get('id')->random()
        ];
    }
}