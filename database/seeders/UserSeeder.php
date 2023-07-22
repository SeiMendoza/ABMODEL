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
            'imagen'=>'img/Perfil/balneario.jpg',
            'is_default' => 'Administrador', 
        ]);

        DB::table('users')->insert([
            'name'=>'Lester Bogran',
            'email'=>'lester.bogran@unah.edu.hn',
            'password' => bcrypt('12345678'),
            'address'=>'1303 San Jacinto Street Houston 77002 ',
            'telephone'=>'98967485',
            'imagen'=>'img/Perfil/apple-icon.png',
            'is_default' => 'Usuario', 
        ]);

        DB::table('users')->insert([
            'name'=>'Asly Reyes',
            'email'=>'asly.reyes@unah.hn',
            'password' => bcrypt('12345678'),
            'address'=>'1305 San Jacinto Street Houston 77002',
            'telephone'=>'96324578',
            'imagen'=>'img/Perfil/unass.jpg',
            'is_default' => 'Usuario', 
        ]);

        DB::table('users')->insert([
            'name'=>'Seily Mendoza',
            'email'=>'seily.mendoza@unah.hn',
            'password' => bcrypt('12345678'),
            'address'=>'1305 San Jacinto Street Houston 77002 ',
            'telephone'=>'97851263',
            'imagen'=>'img/Perfil/unass.jpg',
            'is_default' => 'Usuario', 
        ]);

        DB::table('users')->insert([
            'name'=>'Juan Pastor',
            'email'=>'juan.pastor@unah.hn',
            'password' => bcrypt('12345678'),
            'address'=>'1305 San Jacinto Street Houston 77002',
            'telephone'=>'99124578',
            'imagen'=>'img/Perfil/123.png',
            'is_default' => 'Usuario', 
        ]);

        DB::table('users')->insert([
            'name'=>'Edgar Lopez',
            'email'=>'ejlopezl@unah.hn',
            'password' => bcrypt('12345678'),
            'address'=>'1305 San Jacinto Street Houston 77002 ',
            'telephone'=>'92145896',
            'imagen'=>'img/Perfil/carousel-1.jpg',
            'is_default' => 'Usuario', 
        ]);

        DB::table('users')->insert([
            'name'=>'Rolando Hernández',
            'email'=>'rolandohernndez@unah.hn',
            'password' => bcrypt('12345678'),
            'address'=>'1305 San Jacinto Street Houston 77002 ',
            'telephone'=>'91235896',
            'imagen'=>'img/Perfil/carousel-3.jpg',
            'is_default' => 'Usuario', 
        ]);
    }
}
