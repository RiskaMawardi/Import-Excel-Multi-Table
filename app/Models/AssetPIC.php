<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetPIC extends Model
{
    use HasFactory;
    //public $timestamps = false;
    protected $table = "Asset_PIC_History_IBT";
    protected $primaryKey = 'id';
    protected $fillable = ['id','RecordID','HardwareID','HistoryDivisi','HistoryDaerah','HistoryPIC','StartDate','ChangedDate','AssetID'];
}
