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
            $supplier = Supplier::where('SupplierCode',$row['suppliercode'])->first();
            if ($supplier) {
                $id = $supplier->id;

                $count = POHeader::count();
                $POHeader = POHeader::create([
                    'SupplierID' => $id,
                    'PONumber' => $row['ponumber'] ?? null,
                    'PODate' =>Date::excelToDateTimeObject($row['podate'])->format('Y-m-d') ??null,
                    'Note' => $row['keterangan'] ?? null,
                    'PPN' => null,
                    'MarkForDelete' => 0,
                    'UpdatedBy' => 'Import'
                ]);

                $POHeaderRecordID = $POHeader->id ;
                $matching = Product::where('ProductCode',$row['productcode'])->first();
                if($matching){
                    $PODetail = PoDetail::create([
                        'POHeaderID' => $POHeaderRecordID,
                        'ProductID' =>$matching->id,
                        'Price' => $row['harga'] ?? null,
                        'Qty' => 1,
                        'MarkForDelete' => 0 ,
                        'UpdatedBy' => 'Import'
                    ]);

                    $JJ =Invoice::count();
                    $Invoice = Invoice::create([
                        'POHeaderID' =>$POHeaderRecordID,
                        'InvoiceNumber' =>$row['invoicenumber'] ?? null,
                        'InvoiceDate' =>Date::excelToDateTimeObject($row['invoicedate'])->format('Y-m-d') ?? null,
                        'TermOfPayment' =>null,
                        'FakturPajak' =>null,
                        'DONumber' =>null,
                        'MarkForDelete' => true,
                        'UpdatedBy' => 'Import'
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
                        'Note' => $row['note'] ?? null,
                        'HardwareStatus' =>'Bagus',
                        'Product' => $row['spesifikasi'] ?? null,
                        'AkhirGaransi' =>Date::excelToDateTimeObject($row['garansisdtgl'])->format('Y-m-d') ?? null,
                        'TanggalMutasi' =>Date::excelToDateTimeObject($row['tglmutasi'])->format('Y-m-d') ?? null,
                        'RincianMaintenance' =>$row['rincianmaintenence'] ?? null ,
                        'MarkForDelete' => 0 ,
                        'UpdatedBy' => 'Import'
                    ]);
    
                    $AssetRecordID = $Asset->id;
                    $HistoryPIC = AssetPIC::create([
                        'AssetID' => $AssetRecordID,
                        'HistoryDivisi' => $row['historydivisi'],
                        'HistoryDaerah' => $row['historydaerah'],
                        'HistoryPIC' => $row['historypic'],

    
                    ]);
                }else{
                    $i = Product::count();
                    $Product = Product::create([
                        'ModelSpec' => $row['spesifikasi'] ?? 'null',
                       
                        'ProductCode' =>$i++,
                        'JenisID' =>Jenis::where('jenis',$row['jenis'])->first()->id ?? 0,
                        
                        'MarkForDelete' => 0,
                        'UpdatedBy' => 'Import'
                    ]);

                    $PODetail = PoDetail::create([
                        'POHeaderID' => $POHeaderRecordID,
                        'ProductID' =>$Product->id,
                        'Price' => $row['harga'] ?? null,
                        'Qty' => 1,
                        'MarkForDelete' => 0 ,
                        'UpdatedBy' => 'Import'
                    ]);
                    
                    $JJ =Invoice::count();
                    $Invoice = Invoice::create([
                        'POHeaderID' =>$POHeaderRecordID,
                        // 'InvoiceNumber' =>str_pad($JJ + 1, 6, '0', STR_PAD_LEFT),
                        'InvoiceNumber' =>$row['invoicenumber'] ?? null,
                        'InvoiceDate' =>Date::excelToDateTimeObject($row['invoicedate'])->format('Y-m-d') ?? null,
                        'TermOfPayment' =>null,
                        'FakturPajak' =>null,
                        'DONumber' =>null,
                        'MarkForDelete' => true,
                        'UpdatedBy' => 'Import'
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
                        'Note' => $row['note'] ?? null,
                        'HardwareStatus' =>'Bagus',
                        'Product' => $row['spesifikasi'] ?? null,
                        'AkhirGaransi' =>Date::excelToDateTimeObject($row['garansisdtgl'])->format('Y-m-d') ?? null,
                        'TanggalMutasi' =>Date::excelToDateTimeObject($row['tglmutasi'])->format('Y-m-d') ?? null,
                        'RincianMaintenance' =>$row['rincianmaintenence'] ?? null ,
                        'MarkForDelete' => 0,
                        'UpdatedBy' => 'Import' 
                    ]);

                    $AssetRecordID = $Asset->id;
                    $HistoryPIC = AssetPIC::create([
                        'AssetID' => $AssetRecordID,
                        'HistoryDivisi' => $row['historydivisi'],
                        'HistoryDaerah' => $row['historydaerah'],
                        'HistoryPIC' => $row['historypic'],

                    ]);
                }
                
            } else {
              
                $supplier = Supplier::where('SupplierCode','SC00001')->first();
                if($row['keterangan'] == null){
                    $supplierID = $supplier->id;
                    $count = POHeader::count();
                    $POHeader = POHeader::create([
                        //'SupplierCodeFK' => $supplier,
                        'SupplierID' =>$supplierID,
                        'PONumber' => $row['ponumber'] ?? null,
                        'PODate' =>Date::excelToDateTimeObject($row['podate'])->format('Y-m-d') ??null,
                        'Note' =>  null,   
                        'PPN' => null,
                        'MarkForDelete' => true,
                        'UpdatedBy' => 'Import'
                    ]);
                }

                $supplierID = $supplier->id;
                $count = POHeader::count();
                $POHeader = POHeader::create([
                    'SupplierID' =>$supplierID,
                    'PONumber' => $row['ponumber'] ?? null,
                    'PODate' =>Date::excelToDateTimeObject($row['podate'])->format('Y-m-d') ??null,
                    'Note' => $row['keterangan'],   
                    'PPN' => null,
                    'MarkForDelete' => 0,
                    'UpdatedBy' => 'Import'
                ]);
                //dd($POHeader);
                $POHeaderRecordID = $POHeader->id ;
                $matching = Product::where('ProductCode',$row['productcode'])->first();
                if($matching){
                    $PODetail = PoDetail::create([
                        'POHeaderID' => $POHeaderRecordID,
                        'ProductID' =>$matching->id ?? null,
                        'Price' => $row['harga'] ?? null,
                        'Qty' => '1',
                        'MarkForDelete' =>true,
                        'UpdatedBy' => 'Import'
                    ]);

                     //$JJ =Invoice::count();
                $Invoice = Invoice::create([
                    'POHeaderID' =>$POHeaderRecordID,
                    // 'InvoiceNumber' =>str_pad($JJ + 1, 6, '0', STR_PAD_LEFT),
                    'InvoiceNumber' =>$row['invoicenumber'] ?? null,
                    'InvoiceDate' =>Date::excelToDateTimeObject($row['invoicedate'])->format('Y-m-d') ?? null,
                    'TermOfPayment' =>null,
                    'FakturPajak' =>null,
                    'DONumber' =>null,
                    'MarkForDelete' => true,
                    'UpdatedBy' => 'Import'
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
                    'Note' =>$row['note'] ?? null,
                    'HardwareStatus' =>'Bagus',
                    'Product' => $row['spesifikasi'] ?? null,
                    'AkhirGaransi' =>Date::excelToDateTimeObject($row['garansisdtgl'])->format('Y-m-d') ?? null,
                    'TanggalMutasi' =>Date::excelToDateTimeObject($row['tglmutasi'])->format('Y-m-d') ?? null,
                    'RincianMaintenance' =>$row['rincianmaintenence'] ?? null ,
                    'MarkForDelete' => 0 ,
                    'UpdatedBy' => 'Import'
                ]);
    
                $AssetRecordID = $Asset->id;
                // dd($AssetRecordID);
    
                $HistoryPIC = AssetPIC::create([
                    'AssetID' => $AssetRecordID,
                    'HistoryDivisi' => $row['historydivisi'],
                    'HistoryDaerah' => $row['historydaerah'],
                    'HistoryPIC' => $row['historypic'],
    
                ]);
                //dd($HistoryPIC);

                }else{

                    $i = Product::count();
                    $Product1 = Product::create([
                        'ModelSpec' => $row['spesifikasi'] ?? 'null',
                        
                        'ProductCode' =>$i++,
                        'JenisID' =>Jenis::where('jenis',$row['jenis'])->first()->id ?? 0,
                     
                        'MarkForDelete' => 0,
                        'UpdatedBy' => 'Import'
                    ]);

                    $PODetail = PoDetail::create([
                        'POHeaderID' => $POHeaderRecordID,
                        'ProductID' =>$Product1->id,
                        'Price' => $row['harga'] ?? null,
                        'Qty' => '1',
                        'MarkForDelete' =>true,
                        'UpdatedBy' => 'Import'
                    ]);
                    //dd($PODetail);
        
                    
                    //$JJ =Invoice::count();
                    $Invoice = Invoice::create([
                        'POHeaderID' =>$POHeaderRecordID,
                        // 'InvoiceNumber' =>str_pad($JJ + 1, 6, '0', STR_PAD_LEFT),
                        'InvoiceNumber' =>$row['invoicenumber'] ?? null,
                        'InvoiceDate' =>Date::excelToDateTimeObject($row['invoicedate'])->format('Y-m-d') ?? null,
                        'TermOfPayment' =>null,
                        'FakturPajak' =>null,
                        'DONumber' =>null,
                        'MarkForDelete' => true,
                        'UpdatedBy' => 'Import'
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
                        'Note' =>$row['note'] ?? null,
                        'HardwareStatus' =>'Bagus',
                        'Product' => $row['spesifikasi'] ?? null,
                        'AkhirGaransi' =>Date::excelToDateTimeObject($row['garansisdtgl'])->format('Y-m-d') ?? null,
                        'TanggalMutasi' =>Date::excelToDateTimeObject($row['tglmutasi'])->format('Y-m-d') ?? null,
                        'RincianMaintenance' =>$row['rincianmaintenence'] ?? null ,
                        'MarkForDelete' => 0,
                        'UpdatedBy' => 'Import' 
                    ]);
        
                    $AssetRecordID = $Asset->id;
                    // dd($AssetRecordID);
        
                    $HistoryPIC = AssetPIC::create([
                        'AssetID' => $AssetRecordID,
                        'HistoryDivisi' => $row['historydivisi'],
                        'HistoryDaerah' => $row['historydaerah'],
                        'HistoryPIC' => $row['historypic'],
        
                    ]);
                    //dd($HistoryPIC);
                } 
            }
        }   
    }
}
