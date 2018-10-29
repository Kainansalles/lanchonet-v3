<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'url_image',
        'price_cost',
        'price_sale',
        'quantity',
        'validade',
        'status',
    ];
}
