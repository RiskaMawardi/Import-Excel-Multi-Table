<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Jenis extends Model
{
    use HasFactory;
    //public $timestamps = false;
    protected $table = 'Jenis_IBT';
    protected $primaryKey = 'id';
    protected $fillable = ['UpdatedBy','id','Jenis','Code','Klasifikasi'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
