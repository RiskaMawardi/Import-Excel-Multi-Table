<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoDetail extends Model
{
    use HasFactory;
    //public $timestamps = false;
    protected $table = "PO_Detail_IBT";
    protected $primaryKey = 'id';
    protected $fillable = ['id','POHeaderID','ProductID','Price','Qty','Spesifikasi'];
}
