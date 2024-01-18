<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetPIC extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "ASSET.Asset_PIC_History_IBT";
    protected $primaryKey = 'RecordID';
    protected $fillable = ['HistoryDivisi','HistoryDaerah','HistoryPIC','StartDate','ChangedDate','AssetID','NomorInventarisFK'];
}
