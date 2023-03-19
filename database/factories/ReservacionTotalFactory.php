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
            'Contacto'=>$this->faker->randomElement(['3','8','9']).$this->faker->numerify('####-####'),
            'cantidad' => $this->faker->numberBetween(50,1500),
            'Tipo_Reservacion'=>$this->faker->randomElement(['De Día (Menor Costo)','De Noche (Mayor Costo)']),
            'Tipo_Evento'=>$this->faker->randomElement(['Cumpleaños','Boda']),
            'Fecha'=>$this->faker->date(),
            'Hora'=>$this->faker->time(),
            'Precio'=>$this->faker->numberBetween(2000, 7000),
            'FormaPago'=>$this->faker->randomElement(['Efectivo','Tigo Money'])
        ];
    }
}
