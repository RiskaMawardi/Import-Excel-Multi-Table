<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    //public $timestamps = false;
    protected $table = "ASSET.Supplier_IBT";
    protected $primaryKey = 'RecordID';
    protected $fillable = ['RecordID','SupplierCode','SupplierName','SupplierAddress','NPWP','SupplierPIC','PhoneNumber','BankNumber','Website','Note'];
}
