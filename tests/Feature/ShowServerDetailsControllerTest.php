<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Model\ServerDetail;

class ShowServerDetailsControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    /**
     * fetch Data
     **/
    public function testshowData()
    {
        
        factory(ServerDetail::class)->create([
            'model' => 'model1', 
            'ram' => 'ram1',
            'hardisk' => 'hardisk1',
            'location' => 'India1',
            'price'  => '$100', 
            'hardisk_capacity_mb' => 1000000, 
            'ram_capacity_mb' => 100000 
        ]);

        factory(ServerDetail::class)->create([
            'model' => 'model2', 
            'ram' => 'ram2',
            'hardisk' => 'hardisk2',
            'location' => 'India2',
            'price'  => '$101', 
            'hardisk_capacity_mb' => 2000000, 
            'ram_capacity_mb' => 200000 
        ]);

        $response = $this->json('GET', '/api/v1/search')
            ->assertStatus(200)
            ->assertJson([ 'data' => [
                    'model' => 'model1', 
                    'ram' => 'ram1',
                    'hardisk' => 'hardisk1',
                    'location' => 'India1',
                    'price'  => '$100', 
                    'hardisk_capacity_mb' => 1000000, 
                    'ram_capacity_mb' => 100000 
                ],
                [
                    'model' => 'model2', 
                    'ram' => 'ram2',
                    'hardisk' => 'hardisk2',
                    'location' => 'India2',
                    'price'  => '$101', 
                    'hardisk_capacity_mb' => 2000000, 
                    'ram_capacity_mb' => 200000 
                ]])
            ->assertJsonStructure([
                '*' => ['model', 'ram', 'hardisk', 'location', 'price', 'hardisk_capacity_mb', 'ram_capacity_mb'],
            ]);

    }
}
