<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class sales extends Model // Keeping the model name as 'sales'
{
    use SoftDeletes; 
    use HasFactory;
    use LogsActivity;

    protected $table = 'sales';
    protected $primaryKey = 'sales_id';
    protected $fillable = [
        'customer_id',
        'product_id',
        'serial_number',
        'state',
        'sale_date',
        'amount',
        'payment_method',
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

    // app/Models/Sales.php
public function techreport  ()
{
    return $this->hasMany(TechReport::class, 'sku_id', 'sku_id');
}

    public function getActivitylogOptions(): LogOptions
{
    return LogOptions::defaults()
        ->logOnly(['customer_id','product_id','serial_number','state', 'sale_date', 'amount', 'payment_method', 'payment_type'])
        ->logOnlyDirty()
        ->useLogName('sales') 
        ->setDescriptionForEvent(function (string $eventName) {
            switch ($eventName) {
                case 'updated':
                    return "updated the sales information of  ";
                case 'created':
                    return "added new sales";
                case 'deleted':
                    return "deleted sales ";
                default:
                    return "{$eventName} Category Data"; 
            }
        });
}
}