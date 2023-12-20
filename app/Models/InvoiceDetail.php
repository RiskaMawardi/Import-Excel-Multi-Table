<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "ASSET.Invoice_Detail_IBT";
    protected $primarykey = "RecordID";
    protected $fillable = ['RecordID','InvoiceHeaderID','ProductID','NomorInventaris','SerialNumber','MasterAssetSAP','PIC','Divisi','Daerah','AkhirGaransi','HardwareStatus'];
}
