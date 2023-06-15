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
            'nombreCliente'=>$this->faker->name,
            'celular'=>$this->faker->randomElement(['8','2','9']).$this->faker->numerify('###-####'),
            'fecha'=>$this->faker->date(),
            'horaI'=>$this->faker->time(),
            'horaF'=>$this->faker->time(),
            'kiosko_id'=> Kiosko::get('id')->random(),
            'tipo'=>$this->faker->randomElement(['Reunión','Cumpleaños','Otro']),
            'cantidadAdultos'=>$this->faker->numberBetween(1,20),
            'cantidadNinios'=>$this->faker->numberBetween(1,20),
            'precioAdultos'=>$this->faker->randomElement([80,100]),
            'precioNinios'=>$this->faker->randomElement([80,100]),
            'anticipo'=>$this->faker->randomFloat(2,100,500),
            'formaPago'=>$this->faker->randomElement([0,1]),
            'estado'=>$this->faker->randomElement([0,1]),
        ];
    }
}
