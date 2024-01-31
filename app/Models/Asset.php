<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    //public $timestamps = false;
    protected $table = "Asset_IBT";
    protected $primaryKey = 'id';
    protected $fillable = ['UpdatedBy','id','InvoiceID','PODetailID','ProductID','NomorInventaris','SerialNumber','MasterAssetSAP','PIC','Divisi','Daerah','AkhirGaransi','HardwareStatus','Note','Keterangan','RincianMaintenance'];
}
