<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TechReport extends Model
{
    use HasFactory;
    use SoftDeletes;
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


}
