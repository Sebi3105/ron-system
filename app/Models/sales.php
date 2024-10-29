<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sales extends Model
{
    //
    protected $table = [
        'customer_id',
        'serial_number',
        'state',
        'sale_date',
        'amount',
        'payment_type'
    ];
}
