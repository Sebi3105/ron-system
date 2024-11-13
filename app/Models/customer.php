<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    //
    // protected $table = [
    //     'name',
    //     'address',
    //     'contact_no'
    // ];

    use HasFactory;

    protected $table = 'customer';   
    protected $primaryKey = 'customer_id';
    protected $fillable = [
        'name', 
        'address',
        'contact_no'

    ];
    public $timestamps = false;

    public function customer()
    {
        return $this->hasMany(TechReport::class, 'customer_id'); // Relationship with Inventory
    }
}
