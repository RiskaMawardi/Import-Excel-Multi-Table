<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "ASSET.Product_IBT";
    protected $primarykey = "RecordID";
    protected $fillable = ['JenisID','SupplierID','ProductCode','ModelSpec','Price'];
}
