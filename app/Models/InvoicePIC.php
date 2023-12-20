<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicePIC extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "ASSET.Invoice_Detail_PIC_History_IBT";
    protected $primarykey = "RecordID";
    protected $fillable = ['RecordID','HardwareID','HistoryDivisi','HistoryDaerah','HistoryPIC','StartDate','ChangedDate','InvoiceDetailID'];
}
