<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "ASSET.Invoice_IBT";
    protected $primaryKey = 'RecordID';
    protected $fillable = ['POHeaderID','InvoiceNumber','InvoiceDate','TermOfPayment','DONumber','SubTotal','PPN','GrandTotal','FakturPajak'];
}
