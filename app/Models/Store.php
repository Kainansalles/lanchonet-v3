<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'cnpj',
        'company_name',
        'nickname',
        'cep',
        'pais',
        'uf',
        'neighborhood',
        'street',
        'numero',
        'telephone',
        'bank_account',
        'bank_agency',
        'open_hours',
        'close_hours',
        'works_days'
    ];
}
