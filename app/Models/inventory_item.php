<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class inventory_item extends Model
{
    //
    protected $table = [
        'product_id',
        'serial_number',
        'condition'
    ];
}
