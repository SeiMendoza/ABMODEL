<?php

namespace Database\Factories;

use App\Models\Pedido;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetallesUsuario>
 */
class DetallesUsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $e = 1;
        return [
            'pedido_id'=>Pedido::get('id')->random(),
            'producto'=>$this->faker->numberBetween(0, 100),
            'nombre'=>$this->faker->randomElement(['Pescado Frito','Refresco','Pollo con Tajadas', 'Juguito de Naranja']),
            'cantidad'=>$this->faker->numberBetween(1, 100),
            'precio'=>$this->faker->randomFloat($nbMaxDecimals = 2, $min = 50, $max = 550),
            'estado'=>$e,
        ];
    }
}
