<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataImport;
class ImportController extends Controller
{
    public function import(Request $request){
        $this->validate($request, ['select_file'  => 'required|mimes:xls,xlsx']);$path = $request->file('select_file')->getRealPath();
        // $data = Excel::load($path, function($reader) {})->get();
        $data = Excel::import(new DataImport, $path);
        return back()->with('success', 'Excel Data Imported successfully.');
    }
  
}
