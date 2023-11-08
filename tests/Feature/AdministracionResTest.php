<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class AdministracionResTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_1_index()
    {
        $response = $this->get(route('index'));

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function test_2_index_platillos()
    {
        $response = $this->get(route('menuAdmon.platillos'));
        

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
        
    }

    public function test_3_index_platillos()
    {
        $response = $this->post(route('menuAdmon.platillos'));

        $response->assertStatus(302);
    }

    public function test_4_index_bebidas()
    {
        $response = $this->get(route('menuAdmon.bebidas'));

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function test_5_index_bebidas()
    {
        $response = $this->post(route('menuAdmon.bebidas'));

        $response->assertStatus(302);
    }



    
    

}

