<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "ASSET.Invoice_Maintenance_Detail_IBT";
    protected $primarykey = "RecordID";
    protected $fillable = ['HardwareID','MaintenanceHeaderID','ServiceDate','RincianService','Price'];
}
