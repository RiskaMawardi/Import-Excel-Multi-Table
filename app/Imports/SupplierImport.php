<?php

namespace App\Imports;


use App\Models\Supplier;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class SupplierImport implements ToCollection, WithHeadingRow, WithCalculatedFormulas
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // $dd= $row['suppliercode'];
            // dd($dd);
            $supplier = Supplier::create([
                'SupplierCode' =>$row['suppliercode'] ?? 'null',
                'SupplierName' =>$row['supplier_name'] ?? 'null',
                'SupplierAddress' =>$row['supplier_address'] ?? 'null',
                'NPWP' =>$row['npwp'] ?? 'null',
                'Website' =>$row['website'] ?? 'null',
                'PhoneNumber' =>$row['phone_number'] ??'null',
                'SupplierPIC' =>$row['supplier_pic'] ??'null',
                'BankNumber' =>$row['bank_number'] ?? 'null',  
                'MarkForDelete' => 0,
                'UpdatedBy' => 'Import'
            ]);
            //dd($supplier);

        }
    }
}
