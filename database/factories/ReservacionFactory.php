<?php

namespace Database\Factories;

use App\Models\Kiosko;
use App\Models\Mesa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservacion>
 */
class ReservacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre'=>$this->faker->name,
            'celular'=>$this->faker->phoneNumber(),
            'fecha'=>$this->faker->date(),
            'horaI'=>$this->faker->time(),
            'horaF'=>$this->faker->time(),
            'tipo'=>$this->faker->word,
            'alimentos'=>$this->faker->randomElement([0,1]),
            'cantidad'=>$this->faker->numberBetween(1,20),
            'precio'=>$this->faker->randomElement([80,100]),
            'total'=>$this->faker->randomFloat(2,100,1000),
            'anticipo'=>$this->faker->randomFloat(2,100,500),
            'pendiente'=>$this->faker->randomFloat(2,100,500),
            'formaPago'=>$this->faker->randomElement(['Efectivo','Transferencia']),
            'estado'=>$this->faker->randomElement([0,1]),
        ];
    }
}
