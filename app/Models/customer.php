<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class customer extends Model
{
    //
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

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

//    public function getActivitylogOptions(): LogOptions
//     {
//         return LogOptions::defaults()
//             ->logOnly(['name', 'address', 'contact_no'])
//             ->logOnlyDirty()
//             ->useLogName('customers') 
//             ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} Customer Data");
            
//     }
public function getActivitylogOptions(): LogOptions
{
    return LogOptions::defaults()
        ->logOnly(['name', 'address', 'contact_no'])
        ->logOnlyDirty()
        ->useLogName('customers') 
        ->setDescriptionForEvent(function (string $eventName) {
            switch ($eventName) {
                case 'updated':
                    return "update the customer data of  ";
                case 'created':
                    return "added new customer ";
                case 'deleted':
                    return "Deleted customer ";
                default:
                    return "{$eventName} Customer Data"; 
            }
        });
}

}
