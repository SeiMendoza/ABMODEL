<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'Cristiana Ferrera',
            'email'=>'cristiana.ferrera@unah.edu.hn',
            'password' => bcrypt('12345678'),
            'address'=>'1303 San Jacinto Street Houston 77002',
            'telephone'=>'94896083',
            'imagen'=>'balneario.jpg',
        ]);

        DB::table('users')->insert([
            'name'=>'Lester Bogran',
            'email'=>'lester.bogran@unah.edu.hn',
            'password' => bcrypt('12345678'),
            'address'=>'1303 San Jacinto Street Houston 77002 ',
            'telephone'=>'98967485',
            'imagen'=>'apple-icon.png',
        ]);

        DB::table('users')->insert([
            'name'=>'Asly Reyes',
            'email'=>'asly.reyes@unah.hn',
            'password' => bcrypt('12345678'),
            'address'=>'1305 San Jacinto Street Houston 77002',
            'telephone'=>'96324578',
            'imagen'=>'unass.jpg',
        ]);

        DB::table('users')->insert([
            'name'=>'Seily Mendoza',
            'email'=>'seily.mendoza@unah.hn',
            'password' => bcrypt('12345678'),
            'address'=>'1305 San Jacinto Street Houston 77002 ',
            'telephone'=>'97851263',
            'imagen'=>'unass.jpg',
        ]);

        DB::table('users')->insert([
            'name'=>'Juan Pastor',
            'email'=>'juan.pastor@unah.hn',
            'password' => bcrypt('12345678'),
            'address'=>'1305 San Jacinto Street Houston 77002',
            'telephone'=>'99124578',
            'imagen'=>'123.png',
        ]);

        DB::table('users')->insert([
            'name'=>'Edgar Lopez',
            'email'=>'ejlopezl@unah.hn',
            'password' => bcrypt('12345678'),
            'address'=>'1305 San Jacinto Street Houston 77002 ',
            'telephone'=>'92145896',
            'imagen'=>'carousel-1.jpg',
        ]);

        DB::table('users')->insert([
            'name'=>'Rolando Hernández',
            'email'=>'rolandohernndez@unah.hn',
            'password' => bcrypt('12345678'),
            'address'=>'1305 San Jacinto Street Houston 77002 ',
            'telephone'=>'91235896',
            'imagen'=>'carousel-3.jpg',
        ]);
    }
}
