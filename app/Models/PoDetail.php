<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoDetail extends Model
{
    use HasFactory;
    protected $table = "ASSET.PO_Detail_IBT";
    protected $primarykey = "RecordID";
    protected $fillable = ['POHeaderID','ProductID','Price','Qty'];
}
