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
            'cantidad' => $this->faker->numberBetween(20,1500),
            'Tipo_Reservacion'=>$this->faker->randomElement(['De Día (Menor Costo)','De Noche (Mayor Costo)']),
            'Tipo_Evento'=>$this->faker->name,
            'Fecha'=>$this->faker->date(),
            'Hora'=>$this->faker->time($format = 'h:i'),
            'Total'=>$this->faker->numberBetween(1600, 10000),
            'PrecioEntrada'=>$this->faker->randomElement(['L.100 con Alimentos','L.80 sin Alimentos']),
            'FormaPago'=>$this->faker->randomElement(['Efectivo','Transferencia']),
            'estado'=>$this->faker->numberBetween(0,1),
            'Anticipo'=>$this->faker->numberBetween(100, 10000),
            'Pendiente'=>$this->faker->name,
        ];
    }
}
