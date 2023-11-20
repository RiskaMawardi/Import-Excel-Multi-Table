<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "ASSET.Product_IBT";
    protected $primarykey = "RecordID";
    protected $fillable = ['JenisID','SupplierID','ProductCode','ModelSpec'];
}
