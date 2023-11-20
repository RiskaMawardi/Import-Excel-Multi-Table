<?php

namespace App\Imports;

use App\Models\InvoiceDetail;
use App\Models\InvoiceHeader;
use App\Models\Jenis;
use App\Models\MaintenanceDetail;
use App\Models\PoDetail;
use App\Models\PoHeader;
use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class DataImport implements ToCollection
{
    /**
    * @param Collection $collection
    */

    

    public function collection(Collection $collection)
    {
        foreach ($collection as $item) {
            $product = Product::create([
                'ModelSpec' => $item[11] ?? null,
            ]);
            $jenis = Jenis::create([
                'jenis'=> $item[6]
            ]);
            $maintenanceDetail = MaintenanceDetail::create([
                'RincianService' => $item[17]
            ]);
            $PODetail = PoDetail::create([
                'Price' => $item[15]
            ]);
            $keterangan = PoHeader::create([
                'Note'=> $item[16]
            ]);
            $tglmutasi = InvoiceHeader::create([
                'InvoiceDate' => $item[8]
            ]);
            $detail = InvoiceDetail::create([
                'Divisi' => $item[4],
                'Daerah' => $item[5],
                'PIC' => $item[7],
            ]);

        }
        
    }

    public function headingRow(): int
    {
        return 0;
    }
}
