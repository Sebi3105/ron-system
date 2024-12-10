<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Services extends Model
{

    use HasFactory;
    use SoftDeletes;
    use LogsActivity;
    protected $table = 'service'; // Specifies the correct table name
    protected $primaryKey = 'service_id'; // Primary key name
    protected $fillable = [
        'service_name', // Add other fields as necessary
    ];
    public $timestamps = false;
    //
  
    public function Services() {
        return $this->belongsTo(Services::class, 'service_id');
    }
    public function getActivitylogOptions(): LogOptions
{
    return LogOptions::defaults()
        ->logOnly(['service_name'])
        ->logOnlyDirty()
        ->useLogName('service') 
        ->setDescriptionForEvent(function (string $eventName) {
            switch ($eventName) {
                case 'updated':
                    return "updated service ";
                case 'created':
                    return "added new service";
                case 'deleted':
                    return "deleted service ";
                default:
                    return "{$eventName} Service Data"; 
            }
        });
}
}


