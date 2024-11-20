<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Http\Request;

class inventory extends Model
{
    use SoftDeletes; 
    use HasFactory;
    protected $table = 'inventory';
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'category_id', 'brand_id', 'product_name', 'quantity', 'released_date', 'status', 'notes',
    ];
    const STATUSES = [
        'Available',
        'Low_Stock',
        'Out_Of_Stock',
    ];
    public static function getStatuses()
    {
        return self::STATUSES;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id'); // Foreign key reference
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id'); // Foreign key reference
    }
    public function inventoryItems()
    {
        return $this->hasMany(InventoryItem::class, 'product_id', 'product_id');
    }
}
