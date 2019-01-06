<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;


class ProductLot extends Model
{
    protected $fillable = [
        'product_id',
        'precio_lote',
        'precio_unitario',
        'cantidad'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
        
}
