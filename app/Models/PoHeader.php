<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoHeader extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "ASSET.PO_Header_IBT";
    protected $primarykey = "RecordID";
    protected $fillable = ['SupplierID','PONumber','PODate','Note','PPN'];
}
