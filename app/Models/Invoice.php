<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'clients_id',
        'date',
        'precio_total',
        'user_id'
    ];
}
