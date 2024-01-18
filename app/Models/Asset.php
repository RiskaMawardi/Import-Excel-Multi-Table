<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    //public $timestamps = false;
    protected $table = "ASSET.Asset_IBT";
    protected $primaryKey = 'RecordID';
    protected $fillable = ['Product','InvoiceNumberFK','InvoiceID','PODetailID','ProductID','NomorInventaris','SerialNumber','MasterAssetSAP','PIC','Divisi','Daerah','AkhirGaransi','HardwareStatus','Note','Keterangan','RincianMaintenance'];
}
