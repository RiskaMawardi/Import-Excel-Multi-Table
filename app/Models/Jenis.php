<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Jenis extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'jenis';
    protected $primaryKey = 'id';
    protected $fillable = ['id','jenis','code','klasifikasi'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
