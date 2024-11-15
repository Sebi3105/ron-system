<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    //
<<<<<<< Updated upstream
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
=======
    use HasFactory;
    protected $table = 'customer';
    protected $primaryKey = 'customer_id';
    protected $fillable = [
        'name',
>>>>>>> Stashed changes
        'address',
        'contact_no'

    ];
<<<<<<< Updated upstream
    public $timestamps = false;

    public function customer()
    {
        return $this->hasMany(TechReport::class, 'customer_id'); // Relationship with Inventory
    }
=======
        //public function customers(){
       // return $this->hasMany      for connecting tech report
   // }

>>>>>>> Stashed changes
}
