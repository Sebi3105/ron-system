<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class InventoryItem extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $table = 'inventory_item';
    protected $primaryKey = 'sku_id';
    
    protected $fillable = [
        'product_id',
        'serial_number',
        'condition'
    ];
    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'product_id', 'product_id'); // Define the relationship
    }

    
    public function Inventoryitem() {
        return $this->belongsTo(Inventoryitem::class, 'sku_id');
    }
    const CONDITION = [
        'working',
        'defective',
    ];
    public static function getConditions(){
        return self::CONDITION;
    }
    public function serials()
{
    return $this->belongsTo(Inventory::class);
}

    public $incrementing = true;

    public static function getAvailableInventoryItems($productId)
    {
        // Get sold serial numbers for the specific product
        $soldSerials = Sales::where('product_id', $productId)->pluck('serial_number')->toArray();

        // Fetch available inventory items that are not sold
        return self::where('product_id', $productId)
            ->whereNotIn('sku_id', $soldSerials) // Use sku_id here
            ->get();
    }
    public function sales()
    {
        return $this->hasMany(Sales::class, 'serial_number', 'sku_id');
    }

 public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['product_id','serial_number','condition'])
            ->logOnlyDirty()
            ->useLogName('serial') 
            ->setDescriptionForEvent(function (string $eventName) {
                switch ($eventName) {
                    case 'updated':
                        return "updated data under Serial Number   ";
                    case 'created':
                        return "added new Product Serial ";
                    case 'deleted':
                        return "deleted serial  ";
                    default:
                        return "{$eventName} Serial Data"; 
                }
            });
    }

}
