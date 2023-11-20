<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;
    protected $table = "ASSET.Invoice_Detail_IBT";
    protected $primarykey = "RecordID";
    protected $fillable = ['InvoiceHeaderID','ProductID','NomorInventaris','SerialNumber','MasterAssetSAP','PIC','Divisi','Daerah','AkhirGaransi','HardwareStatus'];
}
