<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Jenis;
use App\Models\Supplier;
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
            $dt = Supplier::where('SupplierCode',$row['suppliercode'])->first();
            if($dt){
                $i = Product::count();
                $Product = Product::create([
                    'ModelSpec' => $row['model_specifications'] ?? 'null',
                    'Price' => $row['price'] ?? null,
                    'ProductCode' =>$row['productcode'],
                    'JenisID' =>Jenis::where('jenis',$row['jenis'])->first()->id ?? 0,
                    'SupplierID' =>$dt->id,
                    'MarkForDelete' => 0,
                    'UpdatedBy' => 'Import'
                ]);
                //dd($Product);
            }else{
                $supplier = Supplier::where('SupplierCode','SC00001')->first();
                $i = Product::count();
                $Product = Product::create([
                    'ModelSpec' => $row['model_specifications'] ?? 'null',
                    'Price' => $row['price'] ?? null,
                    'ProductCode' =>$row['productcode'],
                    'JenisID' =>Jenis::where('jenis',$row['jenis'])->first()->id ?? 0,
                    'SupplierID' =>$supplier->id,
                    'MarkForDelete' => 0,
                    'UpdatedBy' => 'Import'
                ]);
            }
           
        }
    }
}
