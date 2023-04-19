<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Reservacion_TotalFactory extends Factory
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
            'cantidad' => $this->faker->numberBetween(20,1500),
            'Tipo_Reservacion'=>$this->faker->randomElement(['De Día (Menor Costo)','De Noche (Mayor Costo)']),
            'Tipo_Evento'=>$this->faker->name,
            'Fecha'=>$this->faker->date(),
            'HoraEntrada'=>$this->faker->time(),
            'HoraSalida'=>$this->faker->time(),
            'Total'=>$this->faker->numberBetween(1500, 15000),
            'FormaPago'=>$this->faker->randomElement(['Efectivo','Transferencia']),
            'estado'=>$this->faker->numberBetween(0,1),
            'Anticipo'=>$this->faker->numberBetween(500, 15000),
            'Pendiente'=>$this->faker->numberBetween(300, 15000),
        ];
    }
}
