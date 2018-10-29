<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemandxProduct extends Model
{
    protected $table = 'demand_x_products';
    protected $fillable = [
        "product_id",
        "demand_id",
        "quantity",
        "price_registred"
    ];

    /**
     * Get the phone record associated with the user.
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
