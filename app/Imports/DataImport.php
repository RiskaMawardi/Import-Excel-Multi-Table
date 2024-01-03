<?php

namespace App\Imports;

use App\Models\InvoiceDetail;
use App\Models\InvoiceHeader;
use App\Models\InvoicePIC;
use App\Models\Jenis;
use App\Models\MaintenanceDetail;
use App\Models\PoDetail;
use App\Models\PoHeader;
use App\Models\Product;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DataImport implements ToCollection, WithHeadingRow, WithCalculatedFormulas
{
    /**
    * @param  $row   */

    

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
           
            // $s = Supplier::get()->count();
            // //dd($s);
            // if(Supplier::where('SupplierName',$row['sname'])->get() === null){
            //     Supplier::create([
            //         'SupplierCode' =>Supplier::where('SupplierName',$row['sname'])->first()->SupplierCode ?? 'SC'.str_pad((int)substr($s++, 0) + 1, 6, '0', STR_PAD_LEFT),
            //         'Note' => Supplier::where('SupplierName',$row['sname'])->first()->keterangan ?? $row['keterangan'],
            //         'SupplierName' =>Supplier::where('SupplierName',$row['sname'])->first()->SupplierName ?? $row['sname'],
            //         'SupplierAddress' => Supplier::where('SupplierName',$row['sname'])->first()->SupplierAddress ??'null',
            //         'NPWP' =>Supplier::where('SupplierName',$row['sname'])->first()->NPWP ?? 'null',
            //         'Website' =>Supplier::where('SupplierName',$row['sname'])->first()->Website ?? 'wwww.com',
            //         'PhoneNumber' => Supplier::where('SupplierName',$row['sname'])->first()->PhoneNumber ??'null',
            //         'SupplierPIC' =>Supplier::where('SupplierName',$row['sname'])->first()->SupplierPIC ?? 'null',
            //         'BankNumber' => Supplier::where('SupplierName',$row['sname'])->first()->BankNumber ??'null',  
            //         'MarkForDelete' => 0
            //     ]);
            // }
            
            // $code = Jenis::firstOrCreate([
            //     'Jenis' => Jenis::where('Jenis',$row['jenis'])->first()->Jenis ?? $row['jenis'],
            //     'Klasifikasi' => Jenis::where('Jenis',$row['jenis'])->first()->Klasifikasi ?? 'Hardware',
            //     'Code' =>Jenis::where('Jenis',$row['jenis'])->first()->Code ?? 'FLS'
            // ]);

            // //dd($code);
          
            // $i = Product::count();
            // //dd($i);
            // $p = Product::create([
            //     'ModelSpec' => $row['spesifikasi'],
            //     'Price' => $row['harga'] ?? null,
            //     'ProductCode' =>Jenis::where('Jenis',$row['jenis'])->first()->Code.str_pad((int)substr($i++, 0) + 1, 6,'0', STR_PAD_LEFT) ?? '0',
            //     'JenisID' =>Jenis::where('Jenis',$row['jenis'])->first()->RecordID ?? 0,
            //     'SupplierID' => Supplier::where('SupplierName',$row['sname'])->first()->RecordID ?? null,
            //     'MarkForDelete' => 0
            // ]);
            //dd($p);

            // $count = POHeader::count();
            // $f = PoHeader::create([
            //     'SupplierID' => Supplier::where('SupplierName',$row['sname'])->first()->RecordID ?? null,
            //     'PONumber' =>$count++,
            //     'PODate' =>Carbon::now(),
            //     'Note' => $row['keterangan'],
            //     'PPN' => 11,
            //     'MarkForDelete' => 0  
            // ]);
            // //dd($f);

            // $x = PoDetail::create([
            //     'POHeaderID' => $f->first()->RecordID,
            //     'ProductID' => $p->first()->RecordID,
            //     'Price' =>$p->Price,
            //     'Qty' => 1,
            //     'MarkForDelete' => 0  
            // ]);
            //dd($x);
            
            // $JJ =InvoiceHeader::count();
            // $t = InvoiceHeader::create([
            //     'POHeaderID' =>$f->first()->RecordID,
            //     'InvoiceNumber' =>str_pad((int)substr($JJ++, 0) + 1, 3,'0'),
            //     'InvoiceDate' =>Carbon::now(),
            //     'TermOfPayment' =>Carbon::tomorrow(),
            //     'FakturPajak' =>121267,
            //     'DONumber' =>97787,
            //     'MarkForDelete' => 0  
            // ]);
            //dd($t); 
           
            $jenis = isset($row['jenis']) ? $row['jenis'] : '-';
            $tglmutasi = isset($row['tglmutasi']) ? $row['tglmutasi'] : '-';
            $spesifikasi = isset($row['spesifikasi']) ? $row['spesifikasi'] : '-';
            $osproductkey = isset($row['osproductkey']) ? $row['osproductkey'] : '-';
            $harga = isset($row['harga']) ? $row['harga'] : '-';
            $historypic = isset($row['historypic']) ? $row['historypic'] : '-';

            $r = InvoiceDetail::create([
                'NomorInventaris' =>$row['noinventaris'] ?? null,
                'SerialNumber' =>$row['serialno'] ?? null,
                'MasterAssetSAP' =>$row['masterassetsap'] ?? null,
                'PIC' =>$row['pic'] ?? null,
                'Divisi' =>$row['divisi'] ?? null,
                'Daerah' =>$row['daerah'] ?? null,
                'AkhirGaransi' =>$row['garansisdtgl'] ?? null,
                'Note' => 'Jenis : ' . $jenis . ', Tgl Mutasi : ' .Date::excelToDateTimeObject($tglmutasi)
                ->format('y-m-d') . ', Spesifikasi : ' . $spesifikasi . ', OS Productkey : ' . $osproductkey . ', Harga : ' . $harga . ', History PIC : ' . $historypic ?? null,
                'Keterangan' =>$row['keterangan'] ?? null,
                'RincianMaintenance' =>$row['rincianmaintenence'] ?? null ,
                'MarkForDelete' => 0 
            ]);
            //dd($r);

        }

        
    }

}
