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
            $i = Product::count();
            $Product = Product::create([
                'ModelSpec' => $row['model_specifications'] ?? 'null',
                'Price' => $row['price'] ?? null,
                'ProductCode' =>Jenis::where('jenis',$row['jenis'])->first()->code.str_pad((int)substr($i++, 0) + 1, 6,'0', STR_PAD_LEFT) ?? '0',
                'JenisID' =>Jenis::where('jenis',$row['jenis'])->first()->id ?? 0,
                'SupplierID' =>Supplier::where('SupplierName',$row['supplier_name'])->first()->id ?? null,
                'MarkForDelete' => 0
            ]);
            //dd($Product);
        }
    }
}
