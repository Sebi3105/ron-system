<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class inventory extends Model
{
    //
    protected $fillable = [
        'category_id',
        'brand_id',
        'product_name',
        'quantity',
        'released_date',
        'status',
        'notes'
    ];
}
