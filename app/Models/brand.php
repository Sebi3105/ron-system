<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class brand extends Model
{
    use HasFactory;
    use SoftDeletes;

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
