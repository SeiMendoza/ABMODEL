<?php

namespace Database\Seeders;

use App\Models\Kiosko;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KioskoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kiosko::factory(5)->create();
    }
}
