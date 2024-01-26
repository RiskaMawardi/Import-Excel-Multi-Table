<?php

namespace App\Imports;

use App\Models\Asset;
use App\Models\Invoice;
use App\Models\AssetPIC;
use App\Models\PoDetail;
use App\Models\PoHeader;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Jenis;
use Illuminate\Support\Collection;
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
        
            //$productid = 
            $supplier = Supplier::where('SupplierName','like','%'. $row['sname'].'%')->first();
            if ($supplier) {
                $id = $supplier->id;

                $count = POHeader::count();
                $POHeader = POHeader::create([
                    'SupplierID' => $id,
                    'PONumber' => $count + 1,
                    'PODate' => null,
                    'Note' => $row['keterangan'] ?? null,
                    'PPN' => null,
                    'MarkForDelete' => 0
                ]);

                $POHeaderRecordID = $POHeader->id ;
                $matching = Product::where('ModelSpec', 'like', '%' .$row['spesifikasi'].'%')->first();
                if($matching){
                    $PODetail = PoDetail::create([
                        'POHeaderID' => $POHeaderRecordID,
                        'ProductID' =>$matching->id,
                        'Price' => $row['harga'] ?? null,
                        'Spesifikasi' => $row['spesifikasi'] ?? null,
                        'Qty' => 1,
                        'MarkForDelete' => 0  
                    ]);

                    $JJ =Invoice::count();
                    $Invoice = Invoice::create([
                        'POHeaderID' =>$POHeaderRecordID,
                        // 'InvoiceNumber' =>str_pad($JJ + 1, 6, '0', STR_PAD_LEFT),
                        'InvoiceNumber' =>"-",
                        'InvoiceDate' =>null,
                        'TermOfPayment' =>null,
                        'FakturPajak' =>null,
                        'DONumber' =>null,
                        'MarkForDelete' => true
                    ]);
    
                    $PODetailRecordID = $PODetail->id;
                    $InvoiceRecordID = $Invoice->id;
    
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
                        'HardwareStatus' =>'Bagus',
                        'Product' => $row['spesifikasi'] ?? null,
                        'AkhirGaransi' =>Date::excelToDateTimeObject($row['garansisdtgl'])->format('Y-m-d') ?? null,
                        'Keterangan' =>$row['keterangan'] ?? null,
                        'RincianMaintenance' =>$row['rincianmaintenence'] ?? null ,
                        'MarkForDelete' => 0 
                    ]);
    
                    $AssetRecordID = $Asset->id;
                    $HistoryPIC = AssetPIC::create([
                        'AssetID' => $AssetRecordID,
                        'HistoryDivisi' => null,
                        'HistoryDaerah' => null,
                        'HistoryPIC' => $row['historypic'],
    
                    ]);
                }else{
                    $i = Product::count();
                    $Product = Product::create([
                        'ModelSpec' => $row['spesifikasi'] ?? 'null',
                        'Price' => $row['harga'] ?? null,
                        'ProductCode' =>Jenis::where('Jenis',$row['jenis'])->first()->Code.str_pad((int)substr($i++, 0) + 1, 6,'0', STR_PAD_LEFT) ?? '0',
                        'JenisID' =>Jenis::where('jenis',$row['jenis'])->first()->id ?? 0,
                        'SupplierID' =>$id,
                        'MarkForDelete' => 0
                    ]);

                    $PODetail = PoDetail::create([
                        'POHeaderID' => $POHeaderRecordID,
                        'ProductID' =>$Product->id,
                        'Price' => $row['harga'] ?? null,
                        'Spesifikasi' => $row['spesifikasi'] ?? null,
                        'Qty' => 1,
                        'MarkForDelete' => 0  
                    ]);
                    
                    $JJ =Invoice::count();
                    $Invoice = Invoice::create([
                        'POHeaderID' =>$POHeaderRecordID,
                        // 'InvoiceNumber' =>str_pad($JJ + 1, 6, '0', STR_PAD_LEFT),
                        'InvoiceNumber' =>"-",
                        'InvoiceDate' =>null,
                        'TermOfPayment' =>null,
                        'FakturPajak' =>null,
                        'DONumber' =>null,
                        'MarkForDelete' => true
                    ]);

                    $PODetailRecordID = $PODetail->id;
                    $InvoiceRecordID = $Invoice->id;

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
                        'HardwareStatus' =>'Bagus',
                        'Product' => $row['spesifikasi'] ?? null,
                        'AkhirGaransi' =>Date::excelToDateTimeObject($row['garansisdtgl'])->format('Y-m-d') ?? null,
                        'Keterangan' =>$row['keterangan'] ?? null,
                        'RincianMaintenance' =>$row['rincianmaintenence'] ?? null ,
                        'MarkForDelete' => 0 
                    ]);

                    $AssetRecordID = $Asset->id;
                    $HistoryPIC = AssetPIC::create([
                        'AssetID' => $AssetRecordID,
                        'HistoryDivisi' => null,
                        'HistoryDaerah' => null,
                        'HistoryPIC' => $row['historypic'],

                    ]);
                }

                

            } else {
                if($row['sname']){
                    $s = Supplier::all()->count();
                    $newSupplier = Supplier::create([
                        
                        'SupplierCode' => 'SC' . str_pad($s + 1, 6, '0', STR_PAD_LEFT),
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
                }
                else{
                    $s = Supplier::all()->count();
                    $newSupplier = Supplier::create([
                        
                        'SupplierCode' => 'SC' . str_pad($s + 1, 6, '0', STR_PAD_LEFT),
                        'Note' => null,
                        'SupplierName' => '-',
                        'SupplierAddress' => null,
                        'NPWP' => null,
                        'Website' => null,
                        'PhoneNumber' => null,
                        'SupplierPIC' => null,
                        'BankNumber' => null,
                        'MarkForDelete' => true
                    ]);
                }
                
                if($row['keterangan'] == null){
                    $supplierID = $newSupplier->id;
                    $count = POHeader::count();
                    $POHeader = POHeader::create([
                        //'SupplierCodeFK' => $supplier,
                        'SupplierID' =>$supplierID,
                        'PONumber' => $count + 1,
                        'PODate' => null,   
                        'Note' =>  null,   
                        'PPN' => null,
                        'MarkForDelete' => true
                    ]);
                }

                $supplierID = $newSupplier->id;
                $count = POHeader::count();
                $POHeader = POHeader::create([
                    'SupplierID' =>$supplierID,
                    'PONumber' => $count + 1,
                    'PODate' => null,   
                    'Note' => $row['keterangan'],   
                    'PPN' => null,
                    'MarkForDelete' => 0
                ]);
                //dd($POHeader);
                $POHeaderRecordID = $POHeader->id ;
                $matching = Product::where('ModelSpec', 'like','%'. $row['spesifikasi'].'%')->first();
                if($matching){
                    $PODetail = PoDetail::create([
                        'POHeaderID' => $POHeaderRecordID,
                        'ProductID' =>$matching->id ?? null,
                        'Price' => $row['harga'] ?? null,
                        'Spesifikasi' => $row['spesifikasi'] ?? null,
                        'Qty' => '-',
                        'MarkForDelete' =>true
                    ]);

                     //$JJ =Invoice::count();
                $Invoice = Invoice::create([
                    'POHeaderID' =>$POHeaderRecordID,
                    // 'InvoiceNumber' =>str_pad($JJ + 1, 6, '0', STR_PAD_LEFT),
                    'InvoiceNumber' =>null,
                    'InvoiceDate' =>null,
                    'TermOfPayment' =>null,
                    'FakturPajak' =>null,
                    'DONumber' =>null,
                    'MarkForDelete' => true
                ]);
                //dd($Invoice); 
                
                $PODetailRecordID = $PODetail->id;
                $InvoiceRecordID = $Invoice->id;
    
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
                    'HardwareStatus' =>'Bagus',
                    'Product' => $row['spesifikasi'] ?? null,
                    'AkhirGaransi' =>Date::excelToDateTimeObject($row['garansisdtgl'])->format('Y-m-d') ?? null,
                    'Keterangan' =>$row['keterangan'] ?? null,
                    'RincianMaintenance' =>$row['rincianmaintenence'] ?? null ,
                    'MarkForDelete' => 0 
                ]);
    
                $AssetRecordID = $Asset->id;
                // dd($AssetRecordID);
    
                $HistoryPIC = AssetPIC::create([
                    'AssetID' => $AssetRecordID,
                    'HistoryDivisi' => null,
                    'HistoryDaerah' => null,
                    'HistoryPIC' => $row['historypic'],
    
                ]);
                //dd($HistoryPIC);

                }else{

                    $i = Product::count();
                    $Product1 = Product::create([
                        'ModelSpec' => $row['spesifikasi'] ?? 'null',
                        'Price' => $row['harga'] ?? null,
                        'ProductCode' =>Jenis::where('Jenis',$row['jenis'])->first()->Code.str_pad((int)substr($i++, 0) + 1, 6,'0', STR_PAD_LEFT) ?? '0',
                        'JenisID' =>Jenis::where('jenis',$row['jenis'])->first()->id ?? 0,
                        'SupplierID' =>$id,
                        'MarkForDelete' => 0
                    ]);

                    $PODetail = PoDetail::create([
                        'POHeaderID' => $POHeaderRecordID,
                        'ProductID' =>$Product1->id,
                        'Price' => $row['harga'] ?? null,
                        'Spesifikasi' => $row['spesifikasi'] ?? null,
                        'Qty' => '-',
                        'MarkForDelete' =>true
                    ]);
                    //dd($PODetail);
        
                    
                    //$JJ =Invoice::count();
                    $Invoice = Invoice::create([
                        'POHeaderID' =>$POHeaderRecordID,
                        // 'InvoiceNumber' =>str_pad($JJ + 1, 6, '0', STR_PAD_LEFT),
                        'InvoiceNumber' =>null,
                        'InvoiceDate' =>null,
                        'TermOfPayment' =>null,
                        'FakturPajak' =>null,
                        'DONumber' =>null,
                        'MarkForDelete' => true
                    ]);
                    //dd($Invoice); 
                    
                    $PODetailRecordID = $PODetail->id;
                    $InvoiceRecordID = $Invoice->id;
        
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
                        'HardwareStatus' =>'Bagus',
                        'Product' => $row['spesifikasi'] ?? null,
                        'AkhirGaransi' =>Date::excelToDateTimeObject($row['garansisdtgl'])->format('Y-m-d') ?? null,
                        'Keterangan' =>$row['keterangan'] ?? null,
                        'RincianMaintenance' =>$row['rincianmaintenence'] ?? null ,
                        'MarkForDelete' => 0 
                    ]);
        
                    $AssetRecordID = $Asset->id;
                    // dd($AssetRecordID);
        
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

        
    }

}
