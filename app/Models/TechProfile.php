<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class TechProfile extends Model
{
    //
    
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name','contact_no'])
            ->logOnlyDirty()
            ->useLogName('technician') 
            ->setDescriptionForEvent(function (string $eventName) {
                switch ($eventName) {
                    case 'updated':
                        return "updated data of technician named  ";
                    case 'created':
                        return "added new technician ";
                    case 'deleted':
                        return "deleted technician  ";
                    default:
                        return "{$eventName} Technician Data"; 
                }
            });
    }
}
