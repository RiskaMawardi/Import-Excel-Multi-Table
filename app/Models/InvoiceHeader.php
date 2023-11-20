<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceHeader extends Model
{
    use HasFactory;
    protected $table = "ASSET.Invoice_Header_IBT";
    protected $primarykey = "RecordID";
    protected $fillable = ['POHeaderID','InvoiceNumber','InvoiceDate','TermOfPayment','DONumber','SubTotal','PPN','GrandTotal','FakturPajak'];
}
