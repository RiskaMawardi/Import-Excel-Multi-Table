<?php

namespace App\Imports;

use App\Models\Asset;
use App\Models\Invoice;
use App\Models\AssetPIC;
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


class BarangImport implements ToCollection, WithHeadingRow, WithCalculatedFormulas
{
    /**
    * @param  $row   */

    

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $existingSupplier = Supplier::where('SupplierName', $row['sname'])->get()->first();
            //dd($existingSupplier);// isi ini udah pasti null soalnya di tbl blm ada supplier ini
            //kalau null otomatis create new dong
            if (!$existingSupplier) {
                $s = Supplier::all()->count();
                $newSupplier = Supplier::create([
                    'SupplierCode' => 'SC' . str_pad($s + 1, 6, '0', STR_PAD_LEFT),
                    'Note' => null,
                    'SupplierName' => $row['sname'] ?? 'unavailable',
                    'SupplierAddress' => null,
                    'NPWP' => null,
                    'Website' => null,
                    'PhoneNumber' => null,
                    'SupplierPIC' => null,
                    'BankNumber' => null,
                    'MarkForDelete' => 0
                ]);
        
                //dd($newSupplier); // harusnya recordid +1 dari $s(ngitung jumlah data di tbl supplier)

                $supplierID = $newSupplier->RecordID;

                $count = POHeader::count();
                $POHeader = POHeader::create([
                    'SupplierID' => $supplierID,
                    'PONumber' => $count + 1,
                    'PODate' => null,
                    'Note' => $row['keterangan'] ?? null,   
                    'PPN' => null,
                    'MarkForDelete' => 0
                ]);
    
    
                //dd($POHeader);
                //dd($supplierRecordID);
            } else {
                $supplierRecordID = $existingSupplier->RecordID;
                $count = POHeader::count();
                $POHeader = POHeader::create([
                    'SupplierID' => $supplierRecordID,
                    'PONumber' => $count + 1,
                    'PODate' => null,
                    'Note' => $row['keterangan'] ?? null,
                    'PPN' => null,
                    'MarkForDelete' => 0
                ]);
    
    
                //dd($POHeader);
            }

            //dd($supplierRecordID);

            $POHeaderRecordID = $POHeader->RecordID;

            $PODetail = PoDetail::create([
                'POHeaderID' => $POHeaderRecordID,
                'ProductID' => Product::where('ModelSpec',$row['spesifikasi'])->first()->RecordID ?? null,
                'Price' =>Product::where('ModelSpec',$row['spesifikasi'])->first()->Price ?? null,
                'Qty' => 1,
                'MarkForDelete' => 0  
            ]);
            //dd($PODetail);

            
            $JJ =Invoice::count();
            $Invoice = Invoice::create([
                'POHeaderID' =>$POHeaderRecordID,
                'InvoiceNumber' =>str_pad($JJ + 1, 6, '0', STR_PAD_LEFT),
                'InvoiceDate' =>null,
                'TermOfPayment' =>null,
                'FakturPajak' =>null,
                'DONumber' =>null,
                'MarkForDelete' => 0  
            ]);
            //dd($Invoice); 
            
            $PODetailRecordID = $PODetail->RecordID;
            $InvoiceRecordID = $Invoice->RecordID;

            $Asset = Asset::create([
                'InvoiceID' => $InvoiceRecordID,
                'PODetailID' =>$PODetailRecordID,
                'NomorInventaris' =>$row['noinventaris'] ?? null,
                'SerialNumber' =>$row['serialno'] ?? null,
                'MasterAssetSAP' =>$row['masterassetsap'] ?? null,
                'PIC' =>$row['pic'] ?? null,
                'Divisi' =>$row['divisi'] ?? null,
                'Daerah' =>$row['daerah'] ?? null,
                'Note' => '-',
                'AkhirGaransi' =>Date::excelToDateTimeObject($row['garansisdtgl'])->format('Y-m-d') ?? null,
                'Keterangan' =>$row['keterangan'] ?? null,
                'RincianMaintenance' =>$row['rincianmaintenence'] ?? null ,
                'MarkForDelete' => 0 
            ]);
            //dd($Asset);

            $AssetRecordID = $Asset->RecordID;
            dd($AssetRecordID);

            $HistoryPIC = AssetPIC::create([
                'AssetID' => $AssetRecordID,
                'HistoryDivisi' => null,
                'HistoryDaerah' => null,
                'HistoryPIC' => $row['historypic'],

            ]);
            //dd($HistoryPIC);

        }

        
    }

}
