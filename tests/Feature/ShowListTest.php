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
            'id' => 1,
            'model' => 'model1', 
            'ram' => 'ram1',
            'hardisk' => 'hardisk1',
            'location' => 'India1',
            'price'  => '$100', 
            'hardisk_capacity_mb' => 1000000, 
            'ram_capacity_mb' => 100000,
            "created_at" => "2020-08-10T21:35:46.000000Z",
            "updated_at" => "2020-08-10T21:35:46.000000Z"
        ]);

        factory(ServerDetail::class)->create([
            'id' => 2,
            'model' => 'model2', 
            'ram' => 'ram2',
            'hardisk' => 'hardisk2',
            'location' => 'India2',
            'price'  => '$101', 
            'hardisk_capacity_mb' => 2000000, 
            'ram_capacity_mb' => 200000, 
            "created_at" => "2020-08-10T21:35:46.000000Z",
            "updated_at" => "2020-08-10T21:35:46.000000Z"
        ]);

        $response = $this->json('GET', '/api/v1/search')
            ->assertStatus(200)

        //print_r($response->data);  die;  
            ->assertExactJson([ 'data' => 
                [
                    [ 'id' => 1,
                        'model' => 'model1', 
                        'ram' => 'ram1',
                        'hardisk' => 'hardisk1',
                        'location' => 'India1',
                        'price'  => '$100', 
                        'hardisk_capacity_mb' => 1000000, 
                        'ram_capacity_mb' => 100000,
                        "created_at" => "2020-08-10T21:35:46.000000Z",
                        "updated_at" => "2020-08-10T21:35:46.000000Z" 
                    ],
                    [
                        'id' => 2,
                        'model' => 'model2', 
                        'ram' => 'ram2',
                        'hardisk' => 'hardisk2',
                        'location' => 'India2',
                        'price'  => '$101', 
                        'hardisk_capacity_mb' => 2000000, 
                        'ram_capacity_mb' => 200000,
                        "created_at" => "2020-08-10T21:35:46.000000Z",
                        "updated_at" => "2020-08-10T21:35:46.000000Z"
                    ]
                ]
            ])
            ->assertJsonStructure(
            [
                'data' => [
                  '*' => [
                    'model',
                    'ram', 
                    'hardisk', 
                    'location', 
                    'price', 
                    'hardisk_capacity_mb', 
                    'ram_capacity_mb',
                    'created_at',
                    'updated_at'
                  ]
                ]
            ]
        );
    }
}
