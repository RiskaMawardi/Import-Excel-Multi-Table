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
            $s = Supplier::count();
            $supplier = Supplier::create([
                'SupplierCode' =>'SC'.str_pad((int)substr($s++,0) + 1, 6, '0', STR_PAD_LEFT),
                'SupplierName' =>$row['supplier_name'] ?? 'null',
                'SupplierAddress' =>$row['supplier_address'] ?? 'null',
                'NPWP' =>$row['npwp'] ?? 'null',
                'Website' =>$row['website'] ?? 'null',
                'PhoneNumber' =>$row['phone_number'] ??'null',
                'SupplierPIC' =>$row['supplier_pic'] ??'null',
                'BankNumber' =>$row['bank_number'] ?? 'null',  
                'MarkForDelete' => 0
            ]);
            //dd($supplier);

        }
    }
}
