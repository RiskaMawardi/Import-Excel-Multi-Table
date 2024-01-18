<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jenis;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "products";
    protected $primaryKey = 'id';
    protected $fillable = ['id','JenisID','SupplierID','ProductCode','ModelSpec','Price'];

    public function jenis()
    {
        return $this->hasMany(Jenis::class);
    }
}
