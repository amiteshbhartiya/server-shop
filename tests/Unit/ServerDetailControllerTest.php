<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;


class ServerDetailControllerTest extends TestCase
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

    public function testImport()
    {// storage/devons.xls
        $file = UploadedFile::fake()->create('data/myexcel.xlsx');

        Excel::fake($file);

        $response = $this->json('POST', '/import-excel', [
            'fileToUpload' => $file,
        ]);


        Excel::assertImported(storage_path('myexcel.xlsx'));
    }
}
