<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PiscinaTipo;

class PiscinaTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo = [
            'Polvo',
            'Liquido',
        ];
        foreach($tipo as $item){
                PiscinaTipo::create([
                   'descripcion'=> $item
               ]);               
        }
    }
}
