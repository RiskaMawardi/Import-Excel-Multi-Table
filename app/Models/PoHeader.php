<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoHeader extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "PO_Headers";
    protected $primaryKey = 'id';
    protected $fillable = ['id','SupplierID','PONumber','PODate','Note','PPN'];
    
}
