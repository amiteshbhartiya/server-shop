<?php

namespace App\Http\Controllers\ImportExcel;

use App\Model\ServerDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Interfaces\ImportServiceInterface;

class ImportController extends Controller
{
    
    /**
     * @importService Import service interface
     */
    private $importService;

    public function __construct(ImportServiceInterface $importService) {
        $this->importService = $importService;
    }

    public function index()
    {
        $serverDetail = ServerDetail::orderBy('created_at','DESC')->get();
        return view('import_excel.index',compact('serverDetail'));
    }


    /**
     * Import an excel(We can optimise it further by adding service)
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
      
        $request->validate([
            'import_file' => 'required'
        ]);
        try {
         
            $this->importService->import($request);
    
        } catch( \InvalidArgumentException $ex) {
  
            return back()->withError('Wrong data format in some column'); 
        } catch (\Exception $ex) {

             return back()->withError('Something went wrong, check your file'); 
        } catch (\Error $ex) {

            return back()->withError(['Something went wrong, check your file']); 
        }
        
        return back()->with('success', 'Contacts imported successfully.');
    }
     
}
