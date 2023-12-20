<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataImport;
class ImportController extends Controller
{
    public function imp(request $request){

        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx'
        ]);
        $path = $request->file('select_file')->getRealPath();
        $data = Excel::import(new DataImport, $path);
        //dd($data);
        return back()->with('success', 'Excel Data Imported successfully.');
            
    }

    public function getjenis(){
        $data = Jenis::all();
        dd($data);
    }
  
}
