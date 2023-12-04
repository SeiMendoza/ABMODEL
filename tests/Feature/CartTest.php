<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CartTest extends TestCase
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

    public function test_1_cart()
    {
        $response = $this->get('/cart');
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }
    public function test_2_cart()
    {
        $response = $this->post('/cart');
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }
    public function test_3_cart()
    {
        $response = $this->put('/cart');
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }
  
    public function test_4_usuariologueado()
    {
        $user = User::find(1);
    
        $response = $this->actingAs($user)->get('/cart');
        
        $response->assertStatus(200);
    }

    public function test_5_cart()
    {
        $response = $this->post('/create');
        $response->assertStatus(302);
        $response->assertRedirect(route('cart.create'));
    }
    public function test_6_cart()
    {
        $response = $this->post('/create');
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }
    public function test_7_cart()
    {
        $response = $this->post('/clear');
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

   
}
