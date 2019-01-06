<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceProductLot extends Model
{
    protected $fillable = [
        'cantidad',
        'invoices_id',
        'precio_venta',
        'product_lots_id'
    ];
}
