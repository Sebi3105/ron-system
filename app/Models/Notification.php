<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';
    protected $primaryKey = 'notif_id'; // Primary key name
    protected $fillable = ['product_id'];
    public $timestamps = true; // Assuming you want to use timestamps, or you can set to false

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'product_id', 'product_id');
    }
}



