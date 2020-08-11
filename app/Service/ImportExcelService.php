<?php 
namespace App\Service;
use App\Imports\ImportServerDetail;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\Importable;
use App\Service\Interfaces\ImportServiceInterface;


/**
 * This service class is dedicated for Importing data from Excel
 */
class ImportExcelService implements ImportServiceInterface
{
    /**
     * Importable trait of Maatwebsite\Excel
     */
    use Importable;

    /**
     * Import with an laravel excel
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import($request)
    {
        try {
            Excel::import(new ImportServerDetail, request()->file('import_file'));

        }catch(\Exception $e){
            throw  $e;
        }
    }
}