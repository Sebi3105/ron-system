<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;
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
    public $incrementing = true;
}
