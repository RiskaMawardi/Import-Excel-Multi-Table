<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Jenis;
use Exception;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class ProductImport implements ToCollection, WithHeadingRow, WithCalculatedFormulas
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
    
            $Product = Product::create([
                'ProductCode' =>$row['productcode'],
                'ModelSpec' => $row['model_specifications'] ?? 'null',
                'JenisID' =>Jenis::where('jenis',$row['jenis'])->first()->id ?? 0,
                'MarkForDelete' => 0,
                'UpdatedBy' => 'Import'
            ]);
        
                
           
           //dd($Product);
        }
    }
}
