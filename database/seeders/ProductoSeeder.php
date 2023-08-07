<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Producto::factory(50)->create();

        //BEBIDAS

        DB::table('productos')->insert([
            'nombre' => 'Tamarindo',
            'descripcion' => 'Refresco de Tamarindo',
            'precio' => '25',
            'tamanio' => 'Pequeño',
            'imagen' => 'img/ProductosMenú/Tamarindo.jpg',
            'disponible' => '10',
            'estado' => 1,
            'tipo' => '1', 
        ]);


        //COMIDA

        DB::table('productos')->insert([
            'nombre' => 'Pescado Frito',
            'descripcion' => 'Rico pescado frito con tajaditas de platano y ensalada de lechuga.',
            'precio' => '80',
            'tamanio' => 'Mediano',
            'imagen' => 'img/ProductosMenú/Pescado.jpg',
            'disponible' => '10',
            'estado' => 1,
            'tipo' => '2', 
        ]);

        DB::table('productos')->insert([
            'nombre' => 'Enchiladas',
            'descripcion' => 'Ricas enchiladas de pollo o carne molida.',
            'precio' => '40',
            'tamanio' => 'Pequeño',
            'imagen' => 'img/ProductosMenú/Enchiladas.jpg',
            'disponible' => '10',
            'estado' => 1,
            'tipo' => '2', 
        ]);

        DB::table('productos')->insert([
            'nombre' => 'Alitas',
            'descripcion' => 'Deliciosas alitas de pollo acompañado de vegetales.',
            'precio' => '100',
            'tamanio' => 'Mediano',
            'imagen' => 'img/ProductosMenú/Alitas.jpg',
            'disponible' => '10',
            'estado' => 1,
            'tipo' => '2', 
        ]);

        DB::table('productos')->insert([
            'nombre' => 'Tajaditas',
            'descripcion' => 'Ricas tajaditas de pollo o carne',
            'precio' => '65',
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Tajaditas.jpg',
            'disponible' => '10',
            'estado' => 1,
            'tipo' => '2', 
        ]);

        DB::table('productos')->insert([
            'nombre' => 'Carne Asada',
            'descripcion' => 'incluye queso, frijoles fritos, platano, chismol y tortillas.',
            'precio' => '85',
            'tamanio' => 'Pequeño',
            'imagen' => 'img/ProductosMenú/Carne Asada.jpg',
            'disponible' => '10',
            'estado' => 1,
            'tipo' => '2', 
        ]);

        DB::table('productos')->insert([
            'nombre' => 'Pescado Frito',
            'descripcion' => 'Rico pescado frito con tajaditas de mínimo, casamiento y ensalada de lechuga.',
            'precio' => '120',
            'tamanio' => 'Mediano',
            'imagen' => 'img/ProductosMenú/Pescado2.jpg',
            'disponible' => '10',
            'estado' => 1,
            'tipo' => '2', 
        ]);


        //COMPLEMENTOS

        DB::table('productos')->insert([
            'nombre' => 'Tortillas',
            'descripcion' => 'Paquete incluye 6 tortillas',
            'precio' => '10',
            'tamanio' => 'Grande',
            'imagen' => 'img/ProductosMenú/Tortillas.jpg',
            'disponible' => '10',
            'estado' => 1,
            'tipo' => '0', 
        ]);
    }
}
