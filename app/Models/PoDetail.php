<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "ASSET.PO_Detail_IBT";
    protected $primaryKey = 'RecordID';
    protected $fillable = ['PONumberFK','ProductID','Price','Qty'];
}
