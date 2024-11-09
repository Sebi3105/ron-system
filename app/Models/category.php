<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    //
    use HasFactory;
    protected $table = 'category';   
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'category_name', 
    ];
    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'category_id'); // Relationship with Inventory
    }
}
