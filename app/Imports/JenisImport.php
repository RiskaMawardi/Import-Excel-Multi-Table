<?php

namespace App\Imports;

use App\Models\Jenis;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class JenisImport implements ToCollection, WithHeadingRow, WithCalculatedFormulas
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $i = Jenis::count();
            $Jenis = Jenis::create([
                'jenis' => $row['jenis'],
                'klasifikasi' => $row['klasifikasi'],
                'code' =>$row['code']
    
            ]);
            //dd($Product);
        }
    }
}
