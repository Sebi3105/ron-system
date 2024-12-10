<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class brand extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $table = 'brand'; // Specifies the correct table name
    protected $primaryKey = 'brand_id'; // Primary key name
    protected $fillable = [
        'brand_name', // Add other fields as necessary
    ];

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'brand_id'); // Relationship with Inventory
    }
    public function getActivitylogOptions(): LogOptions
{
    return LogOptions::defaults()
        ->logOnly(['brand_name'])
        ->logOnlyDirty()
        ->useLogName('brands') 
        ->setDescriptionForEvent(function (string $eventName) {
            switch ($eventName) {
                case 'updated':
                    return "updated brand ";
                case 'created':
                    return "added new brand";
                case 'deleted':
                    return "deleted brand ";
                default:
                    return "{$eventName} Brand Data"; 
            }
        });
}

}