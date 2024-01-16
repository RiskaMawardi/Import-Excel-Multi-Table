<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataImport;
use App\Imports\SupplierImport;
use App\Imports\ProductImport;
class ImportController extends Controller
{
    public function import(request $request){

        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx'
        ]);
        $path = $request->file('select_file')->getRealPath();
        Excel::import(new DataImport, $path);
        return back()->with('success', 'Excel Data Imported successfully.');
            
    }
}
