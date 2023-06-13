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
            'username'=>'Cristiana',
            'email'=>'cristiana.ferrera@unah.edu.hn',
            'password' => bcrypt('12345678'),
            'address'=>'1303 San Jacinto Street Houston TX 77002 USA',
            'telephone'=>'94896083',
            'imagen'=>'balneario.jpg',
        ]);

        DB::table('users')->insert([
            'name'=>'Lester Bogran',
            'username'=>'Lester',
            'email'=>'lester.bogran@unah.edu.hn',
            'password' => bcrypt('12345678'),
            'address'=>'1303 San Jacinto Street Houston TX 77002 USA',
            'telephone'=>'98967485',
            'imagen'=>'apple-icon.png',
        ]);

        DB::table('users')->insert([
            'name'=>'Asly Reyes',
            'username'=>'Asly24',
            'email'=>'asly.reyes@unah.hn',
            'password' => bcrypt('12345678'),
            'address'=>'1305 San Jacinto Street Houston TX 77002 USA',
            'telephone'=>'96324578',
            'imagen'=>'unass.jpg',
        ]);

        DB::table('users')->insert([
            'name'=>'Seily Mendoza',
            'username'=>'Ale25',
            'email'=>'seily.mendoza@unah.hn',
            'password' => bcrypt('12345678'),
            'address'=>'1305 San Jacinto Street Houston TX 77002 USA',
            'telephone'=>'97851263',
            'imagen'=>'unass.jpg',
        ]);

        DB::table('users')->insert([
            'name'=>'Juan Pastor',
            'username'=>'Juan26',
            'email'=>'juan.pastor@unah.hn',
            'password' => bcrypt('12345678'),
            'address'=>'1305 San Jacinto Street Houston TX 77002 USA',
            'telephone'=>'99124578',
            'imagen'=>'123.png',
        ]);

        DB::table('users')->insert([
            'name'=>'Edgar Lopez',
            'username'=>'Edgar27',
            'email'=>'ejlopezl@unah.hn',
            'password' => bcrypt('12345678'),
            'address'=>'1305 San Jacinto Street Houston TX 77002 USA',
            'telephone'=>'92145896',
            'imagen'=>'carousel-1.jpg',
        ]);

        DB::table('users')->insert([
            'name'=>'Rolando Hernández',
            'username'=>'Rolando28',
            'email'=>'rolandohernndez@unah.hn',
            'password' => bcrypt('12345678'),
            'address'=>'1305 San Jacinto Street Houston TX 77002 USA',
            'telephone'=>'91235896',
            'imagen'=>'carousel-3.jpg',
        ]);
    }
}
