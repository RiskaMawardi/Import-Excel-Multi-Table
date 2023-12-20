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


class DataImport implements ToCollection, WithHeadingRow
{
    /**
    * @param  $row   */

    

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $i = Product::count();
            $s = Supplier::count();
            //dd($s);
            $sup = Supplier::create([
                'SupplierCode' =>'SC'.str_pad((int)substr($s++, 0) + 1, 6, '0', STR_PAD_LEFT),
                'Note' => $row['keterangan'] ?? null,
                'SupplierName' =>'yyy',
                'SupplierAddress' => 'tokyo',
                'NPWP' => 898889,
                'Website' => 'wwww.com',
                'PhoneNumber' => '02122768937',
                'SupplierPIC' => 'Riska',
                'BankNumber' => 'BNI',  
                'MarkForDelete' => 0
            ]);

            $p = Product::create([
                'ModelSpec' => $row['spesifikasi'],
                'Price' => $row['harga'],
                'ProductCode'=> Jenis::where('Jenis',$row['jenis'])->first()->Code . str_pad((int)substr($i++, 1) + 1, 6, '0', STR_PAD_LEFT) ?? Jenis::create(['Jenis' => $row['jenis']])->Jenis ?? null,
                'JenisID' => Jenis::where('Jenis', $row['jenis'])->first()->RecordID ?? Jenis::create(['Jenis' => $row['jenis']])->RecordID ?? null,
                //'SupplierID' => Supplier::where('SupplierName', $row['supplier'])->first()->RecordID ?? Supplier::create(['SupplierName' => $row['supplier']])->RecordID ?? null,
                'MarkForDelete' => 0  
            ]);

           

            $f = PoHeader::create([
                'SupplierID' => $sup->first()->RecordID,
                'PONumber' => 0,
                'PODate' =>Carbon::now(),
                'Note' => 'test',
                'PPN' => 11,
                'MarkForDelete' => 0  
            ]);

            PoDetail::create([
                'POHeaderID' => $f->first()->RecordID,
                'ProductID' => $p->first()->RecordID,
                'Price' =>$p->Price,
                'Qty' => 1,
                'MarkForDelete' => 0  
            ]);
            
            InvoiceHeader::create([
                'POHeaderID' =>$f->first()->RecordID,
                'InvoiceNumber' => 0000,
                'InvoiceDate' => Carbon::now(),
                'TermOfPayment' =>Carbon::tomorrow(),
                'FakturPajak' =>121267,
                'DONumber' =>97787,
                'MarkForDelete' => 0  
            ]);


            $r = InvoiceDetail::create([
                'NomorInventaris' =>$row['noinventaris'] ?? null,
                'SerialNumber' =>$row['serialno'] ?? null,
                'MasterAssetSAP' =>$row['masterassetsap'] ?? null,
                'PIC' =>$row['pic'] ?? null,
                'Divisi' =>$row['divisi'] ?? null,
                'Daerah' =>$row['daerah'] ?? null,
                'AkhirGaransi' =>$row['garansisdtgl'] ?? null,
                //'Note' => $row['HISTORY DIVISI'].$row['HISTORY DAERAH'].$row['HISTORY PIC'] ?? null,
                'MarkForDelete' => 0 
            ]);

            
            InvoicePIC::create([
                'HistoryDivisi' =>$row['historydivisi'] ?? null,
                'HistoryDaerah' =>$row['historydaerah'] ?? null,
                'HistoryPIC' => $row['historypic'] ?? null,
                'InvoiceDetailID' => $r->first()->RecordID

            ]);

           

         
        }

        
    }

}
