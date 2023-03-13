<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PiscinaUso;

class PiscinaUsoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uso = [
            'Diario',
            'Semanal',
            'Mensual',
        ];
        foreach($uso as $item){
                PiscinaUso::create([
                   'descripcion'=> $item
               ]);               
        }
    }
}
