<?php

namespace App\Imports;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class DataImport implements WithMultipleSheets 
{
    /**
    * 
    */
    public function sheets(): array
    {   
        return [
            // 'jenis' => new JenisImport(),
            // 'supplier' => new SupplierImport(),
            // 'produk' => new ProductImport(),
            'barang' => new BarangImport(),
        ];
    }
}
