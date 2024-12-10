<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class category extends Model
{
    //
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $table = 'category';   
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'category_name', 
    ];
    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'category_id'); // Relationship with Inventory
    }

    public function getActivitylogOptions(): LogOptions
{
    return LogOptions::defaults()
        ->logOnly(['category_name'])
        ->logOnlyDirty()
        ->useLogName('category') 
        ->setDescriptionForEvent(function (string $eventName) {
            switch ($eventName) {
                case 'updated':
                    return "updated category ";
                case 'created':
                    return "added new category";
                case 'deleted':
                    return "deleted category ";
                default:
                    return "{$eventName} Category Data"; 
            }
        });
}

}
