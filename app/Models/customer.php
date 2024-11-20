<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    //
    use HasFactory;
    protected $casts = [
        'contact_no' => 'string',
    ];
    
    protected $table = 'customer';
    protected $primaryKey = 'customer_id';
    protected $fillable = [
        'name',
        'address',
        'contact_no'

    ];
        //public function customers(){
       // return $this->hasMany      for connecting tech report
   // }

}
