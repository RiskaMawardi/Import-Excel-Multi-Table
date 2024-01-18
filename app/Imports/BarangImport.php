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
use Illuminate\Support\Facades\DB;

class BarangImport implements ToCollection, WithHeadingRow, WithCalculatedFormulas
{
    /**
    * @param  $row   */

    

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
          
            $existingSupplier = Supplier::where('SupplierName', $row['sname'])->first();

            $db = DB::table('ASSET.Supplier_IBT')
            ->where('SupplierName', 'like',$row['sname'].'%')
            ->get()
            ->first();

            if ($db === null || $db->RecordID === null) {
  
                if($row['sname'] === null){
                    $supplier = "Unavailable";
                    $supplierid = 113;

                    $newSupplier = null;
                }
                else{
                    $maxSupplierRecordID = Supplier::max('RecordID');
                    $newSupplier = Supplier::create([
                        //'ffe' => $recordid + 1,
                        'SupplierCode' => 'SC' . str_pad($maxSupplierRecordID + 1, 6, '0', STR_PAD_LEFT),
                        'Note' => null,
                        'SupplierName' => $row['sname'],
                        'SupplierAddress' => null,
                        'NPWP' => null,
                        'Website' => null,
                        'PhoneNumber' => null,
                        'SupplierPIC' => null,
                        'BankNumber' => null,
                        'MarkForDelete' => 0
                    ]);

                    $supplier = $newSupplier->SupplierCode;
                    $supplierid = $newSupplier->RecordID;
                }
                

                $db = DB::table('ASSET.Supplier_IBT')
                ->where('SupplierName', 'like',$newSupplier->SupplierName)
                ->get()
                    ->first();

                   //sleep(1);


                $count = POHeader::count();
                $POHeader = POHeader::create([
                    'SupplierCodeFK' => $supplier,
                    'SupplierID' => $db->RecordID,
                    'PONumber' => $count + 1,
                    'PODate' => null,   
                    'Note' => $row['keterangan'] ?? null,   
                    'PPN' => null,
                    'MarkForDelete' => 0
                ]);
                //dd($POHeader);

            } else {
                $count = POHeader::count();
                $POHeader = POHeader::create([
                    //'SupplierCodeFK' => $existingSupplier->SupplierCode,
                    'SupplierID' => $db ->RecordID,
                    'PONumber' => $count + 1,
                    'PODate' => null,
                    'Note' => $row['keterangan'] ?? null,
                    'PPN' => null,
                    'MarkForDelete' => 0
                ]);

                //dd($POHeader);
            }
    
            //dd($supplierRecordID);

            

            $PODetail = PoDetail::create([
                'PONumberFK' => $POHeader->PONumber,
                'ProductID' => Product::where('ModelSpec',$row['spesifikasi'])->first()->RecordID ?? null,
                'Price' =>Product::where('ModelSpec',$row['spesifikasi'])->first()->Price ?? null,
                'Qty' => 1,
                'MarkForDelete' => 0  
            ]);
            //dd($PODetail);

            
            $JJ =Invoice::count();
            $Invoice = Invoice::create([
                'PONumberFK' =>$PODetail->PONumberFK,
                'InvoiceNumber' =>str_pad($JJ + 1, 6, '0', STR_PAD_LEFT),
                'InvoiceDate' =>null,
                'TermOfPayment' =>null,
                'FakturPajak' =>null,
                'DONumber' =>null,
                'MarkForDelete' => 0  
            ]);
            //dd($Invoice); 
            
            // $PODetailRecordID = $PODetail->RecordID;
            // $InvoiceRecordID = $Invoice->RecordID;

            $Asset = Asset::create([
                'InvoiceNumberFK' => $Invoice->InvoiceNumber,
                'PONumberFK' =>$Invoice->PONumberFK,
                'NomorInventaris' =>$row['noinventaris'] ?? null,
                'SerialNumber' =>$row['serialno'] ?? null,
                'MasterAssetSAP' =>$row['masterassetsap'] ?? null,
                'PIC' =>$row['pic'] ?? null,
                'Divisi' =>$row['divisi'] ?? null,
                'Daerah' =>$row['daerah'] ?? null,
                'Note' => '-',
                'Product' => $row['spesifikasi'] ?? null,
                'AkhirGaransi' =>Date::excelToDateTimeObject($row['garansisdtgl'])->format('Y-m-d') ?? null,
                'Keterangan' =>$row['keterangan'] ?? null,
                'RincianMaintenance' =>$row['rincianmaintenence'] ?? null ,
                'MarkForDelete' => 0 
            ]);

            //dd($Asset);
            //dd($AssetRecordID);

            $HistoryPIC = AssetPIC::create([
                'NomorInventarisFK' => $Asset->NomorInventaris,
                'HistoryDivisi' => null,
                'HistoryDaerah' => null,
                'HistoryPIC' => $row['historypic'],

            ]);
            //dd($HistoryPIC);

        }

        
    }

}
