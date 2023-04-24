<?php

namespace Database\Seeders;

use App\Models\DetallesUsuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetallesUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DetallesUsuario::factory(80)->create();
    }
}
