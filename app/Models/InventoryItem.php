<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryItem extends Model
{
    use HasFactory;
    use SoftDeletes;
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



}
