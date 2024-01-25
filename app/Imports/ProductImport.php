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
            $dt = Supplier::where('SupplierName','like','%'.$row['supplier_name'].'%')->first();
            if($dt){
                $i = Product::count();
                $Product = Product::create([
                    'ModelSpec' => $row['model_specifications'] ?? 'null',
                    'Price' => $row['price'] ?? null,
                    'ProductCode' =>Jenis::where('Jenis',$row['jenis'])->first()->Code.str_pad((int)substr($i++, 0) + 1, 6,'0', STR_PAD_LEFT) ?? '0',
                    'JenisID' =>Jenis::where('jenis',$row['jenis'])->first()->id ?? 0,
                    'SupplierID' =>$dt->id,
                    'MarkForDelete' => 0
                ]);
                //dd($Product);
            }else{
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

                $i = Product::count();
                $Product = Product::create([
                    'ModelSpec' => $row['model_specifications'] ?? 'null',
                    'Price' => $row['price'] ?? null,
                    'ProductCode' =>Jenis::where('Jenis',$row['jenis'])->first()->Code.str_pad((int)substr($i++, 0) + 1, 6,'0', STR_PAD_LEFT) ?? '0',
                    'JenisID' =>Jenis::where('jenis',$row['jenis'])->first()->id ?? 0,
                    'SupplierID' =>$supplier->id,
                    'MarkForDelete' => 0
                ]);
            }
           
        }
    }
}
