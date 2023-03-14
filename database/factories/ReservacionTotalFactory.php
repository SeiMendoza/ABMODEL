<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReservacionTotalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'Nombre_Cliente'=>$this->faker->name,
            'Apellido_Cliente'=>$this->faker->name,
            'Fecha'=>$this->faker->date(),
            'Hora'=>$this->faker->time(),
            'Contacto'=>$this->faker->randomElement(['3','8','9']).$this->faker->numerify('###-####'),
            'Tipo_Evento'=>$this->faker->randomElement(['Cumpleaños','Boda'])
        ];
    }
}
