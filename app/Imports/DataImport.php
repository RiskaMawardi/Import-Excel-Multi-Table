<?php

namespace App\Imports;

use App\Models\InvoiceDetail;
use App\Models\InvoiceHeader;
use App\Models\Jenis;
use App\Models\MaintenanceDetail;
use App\Models\PoDetail;
use App\Models\PoHeader;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class DataImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{
    /**
    * @param  $row   */

    

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Product::create([
                'ModelSpec' => $row['spec'],
                'price' => $row['price'],
                'ProductCode'        => $row['code'] ?? Str::random(10),
                'JenisID' => Jenis::where('Jenis', $row['jenis'])->first()->id ?? Jenis::create(['Jenis' => $row['jenis']])->id ?? null,
                'SupplierID' => Supplier::where('SupplierName', $row['supplier'])->first()->id ?? Supplier::create(['SupplierName' => $row['supplier']])->id ?? null,
                'MarkForDelete' => 0  
            ]);
        }
    }

}
