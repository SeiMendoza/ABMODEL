<?php

namespace Database\Factories;

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
            'cantidad'=>$this->faker->numberBetween(1,20),
            'fecha'=>$this->faker->date(),
            'hora'=>$this->faker->time(),
            'pago'=>$this->faker->randomFloat(2,100,10000),
            'formaPago'=>$this->faker->randomElement(['Efectivo','Transferencia']),
            'mesa_id' => Mesa::get('id')->random()
        ];
    }
}
