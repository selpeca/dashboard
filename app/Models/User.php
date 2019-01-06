<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'nombre',
        'stock_min',
        'descripcion',
        'imagen'
    ];
        
}
