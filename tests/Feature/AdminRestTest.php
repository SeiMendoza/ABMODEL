<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminRestTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMenuAdmonBebidas_1()
    {
        $response = $this->post(route('menuAdmon.bebidas'));
        $response->assertStatus(302); 
    }


    public function testMenuAdmonComplementos_2()
    {
        $response = $this->post(route('menuAdmon.complementos'));
        $response->assertStatus(302); 
    }


    public function testMenuAdmonComplementos_3()
    {
        $response = $this->get(route('menuAdmon.complementos'));
        $response->assertStatus(302); 
    }

    public function testMenuAdmonIndex_4()
    {
        $response = $this->get(route('menuAdmon.index'));
         $response->assertStatus(302); 
    }

 
    public function testMenuAdmonPrueba_5()
    {
        $response = $this->get(route('menuAdmon.prueba'));
        $response->assertStatus(302); 
    }

    


}
