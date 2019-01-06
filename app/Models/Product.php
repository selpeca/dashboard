<?php

namespace App\Models;

use App\Models\ProductLot;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nombre',
        'stock_min',
        'descripcion',
        'imagen'
    ];
    public function product_lots(){
        return $this->hasMany(ProductLot::class);
    }
        
}
