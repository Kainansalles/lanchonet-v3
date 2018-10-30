<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    protected $fillable = [
        'client_id',
        'store_id',
        'hour_recall'
    ];

    /**
     * Get the phone record associated with the user.
     */
    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    /**
     * Get the phone record associated with the user.
     */
    public function status_demand()
    {
        return $this->belongsTo('App\Models\StatusDemand');
    }

    /**
     * Get the phone record associated with the user.
     */
    public function demand_x_product()
    {
        return $this->hasMany('App\Models\DemandxProduct');
    }


}
