<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;
use App\Model\ServerDetail;
use App\Repositories\ServerDetailRepository;


class ServerDetailRepositoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
     * Test Hardisk conversion to mb from string.
     *
     * @return void
     */

    public function testCapacityHardiskMB(){

        $repository = new \App\Repositories\ServerDetailRepository();
        $response = $repository->capacityHardiskMB('2x500GBSATA2');

        $this->assertEquals('1000000', $response);

    } 

    /**
     * Test RAM conversion to mb from string input.
     *
     * @return void
     */
    public function testCapacityRamMB()
    {
        $repository = new \App\Repositories\ServerDetailRepository();
        $response = $repository->capacityRamMB('16GBDDR3');
        $this->assertEquals('16000', $response);

    } 
}
