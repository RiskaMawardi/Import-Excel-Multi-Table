<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jenis;

class Product extends Model
{
    use HasFactory;
    //public $timestamps = false;
    protected $table = "Product_IBT";
    protected $primaryKey = 'id';
    protected $fillable = ['ProductCode','UpdatedBy','JenisID','SupplierID','ModelSpec','Price'];

   
}
