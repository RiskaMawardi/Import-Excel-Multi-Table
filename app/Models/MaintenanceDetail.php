<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceDetail extends Model
{
    use HasFactory;
    protected $table = "ASSET.Invoice_Maintenance_Detail_IBT";
    protected $primarykey = "RecordID";
    protected $fillable = ['HardwareID','MaintenanceHeaderID','ServiceDate','RincianService','Price'];
}
