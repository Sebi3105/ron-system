<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class sales extends Model
{
    use SoftDeletes; 
    use HasFactory;
    protected $table = 'sales';
    protected $primaryKey = 'sales_id';
    protected $fillable = [
        'customer_id',
        'serial_number',
        'state',
        'sale_date',
        'amount',
        'payment_type'
    ];
}
