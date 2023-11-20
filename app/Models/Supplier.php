<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = "ASSET.Supplier_IBT";
    protected $primarykey = "RecordID";
    protected $fillable = ['SupplierCode','SupplierName','SupplierAddress','NPWP','SupplierPIC','PhoneNumber','BankNumber','Website'];
}
