<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Services extends Model
{

    use HasFactory;

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
}


