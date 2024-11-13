<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    use HasFactory;

    protected $table = 'brand'; // Specifies the correct table name
    protected $primaryKey = 'brand_id'; // Primary key name
    protected $fillable = [
        'brand_name', // Add other fields as necessary
    ];

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'brand_id'); // Relationship with Inventory
    }
}
