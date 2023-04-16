<?php

namespace Database\Seeders;

use App\Models\reservacion_total;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Reservacion_TotalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       reservacion_total::factory(40)->create();
    }
}
