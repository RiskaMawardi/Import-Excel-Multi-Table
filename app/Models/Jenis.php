<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Jenis extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'ASSET.Jenis_IBT';
    protected $primarykey = 'RecordID';
    protected $fillable = ['Jenis','Code'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
