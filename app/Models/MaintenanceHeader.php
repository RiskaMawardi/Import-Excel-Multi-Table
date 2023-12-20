<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceHeader extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "ASSET.Invoice_Maintenance_Header_IBT";
    protected $primarykey = "RecordID";
    protected $fillable = ['CenterID','InvoiceNumber','InvoiceDate','TermOfPayment','DONumber','SubTotal','PPN','GrandTotal'];
}
