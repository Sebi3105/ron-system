<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sales extends Model // Keeping the model name as 'sales'
{
    use SoftDeletes; 
    use HasFactory;

    protected $table = 'sales';
    protected $primaryKey = 'sales_id';
    protected $fillable = [
        'customer_id',
        'product_id',
        'serial_number',
        'state',
        'sale_date',
        'amount',
        'payment_type'
    ];

    protected $casts = [
        'sale_date' => 'datetime', // This will ensure sale_date is a Carbon instance
    ];

    // Define the relationship with the Customer model
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    // Define the relationship with the Inventory model
    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'product_id', 'product_id');
    }

    // Define the relationship with InventoryItem
    public function inventoryItem()
    {
        return $this->belongsTo(InventoryItem::class, 'serial_number', 'sku_id');
    }
}