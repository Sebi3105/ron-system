<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    protected $table = 'brand'; // Specifies the correct table name
    protected $primaryKey = 'brand_id';
    protected $fillable = [
        'brand_name',
    ];
}
