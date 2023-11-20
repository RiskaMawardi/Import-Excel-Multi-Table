<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceCenter extends Model
{
    use HasFactory;
    
    protected $table = "ASSET.Maintenance_Center_IBT";
    protected $primarykey = "RecordID";
    protected $fillable = ['CenterCode','CenterName','CenterAddress','NPWP','CenterPIC','PhoneNumber','BankNumber','Website'];
}

