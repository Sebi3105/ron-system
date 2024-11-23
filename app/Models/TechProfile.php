<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TechProfile extends Model
{
    //
    
    use HasFactory;
    use SoftDeletes;

    protected $table = 'technician'; // Specifies the correct table name
    protected $primaryKey = 'technician_id'; // Primary key name
    protected $fillable = [
        'name', // Add other fields as necessary
        'contact_no'
    ];

    public $timestamps = false;
    
    public function TechProfile()
    {
        return $this->hasMany(TechProfile::class, 'technician_id'); // Relationship with Inventory
    }
}
