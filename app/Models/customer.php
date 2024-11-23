<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class customer extends Model
{
    //
    use HasFactory;
    use SoftDeletes;
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
    public function sales()
{
    return $this->hasMany(Sales::class, 'customer_id', 'customer_id');
}

        //public function customers(){
       // return $this->hasMany      for connecting tech report
   // }

}
