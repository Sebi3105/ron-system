<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class TechReport extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;
    protected $table = 'technician_report';
    protected $primaryKey = 'report_id';
    protected $fillable = [
        'technician_id', 'customer_id', 'sku_id', 'service_id', 'date_of_completion', 'payment_type', 
        'payment_method','status','remarks','cost',
    ];
   

    
    //payment type
    const PAYMENTTYPE = [
        'installment',
        'full_payment',
       
    ];
    public static function getPaymenttype()
    {
        return self::PAYMENTTYPE;
    }
    
    //payment method
    const PAYMENTMETHOD = [
        'credit_card',
        'cash',
        'gcash',
        'paymaya',
       
    ];
    public static function getPaymentmethod()
    {
        return self::PAYMENTMETHOD;
    }
    

    //status
    const STATUSES = [
        'in progress', 
        'done', 
        'backjob',
    ];
    public static function getStatuses()
    {
        return self::STATUSES;
    }





    public function TechProfile() {
        return $this->belongsTo(TechProfile::class, 'technician_id');
    }
    
    public function customer() {
        return $this->belongsTo(customer::class, 'customer_id');
    }
    
    public function Inventoryitem() {
        return $this->belongsTo(Inventoryitem::class, 'sku_id');
    }
    
    public function Services() {
        return $this->belongsTo(Services::class, 'service_id');
    }
    
    public function service()
{
    return $this->belongsTo(Services::class, 'service_id');
}
// app/Models/TechReport.php
public function sale()
{
    return $this->belongsTo(Sales::class, 'sku_id', 'sku_id');
}


public function getActivitylogOptions(): LogOptions
{
    return LogOptions::defaults()
        ->logOnly(['technician_id', 'customer_id', 'sku_id', 'service_id', 'date_of_completion', 'payment_type', 
        'payment_method','status','remarks','cost'])
        ->logOnlyDirty()
        ->useLogName('techreport') 
        ->setDescriptionForEvent(function (string $eventName) {
            switch ($eventName) {
                case 'updated':
                    return "updated technician report of  ";
                case 'created':
                    return "added new technician report ";
                case 'deleted':
                    return "deleted technician report of ";
                default:
                    return "{$eventName} Technician Data"; 
            }
        });
}public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'product_id', 'product_id');
    }


}
