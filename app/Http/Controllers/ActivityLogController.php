<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Models\Customer;
 use App\Models\Sales; // Keeping the model name as Sales
use App\Models\InventoryItem;
use App\Models\Inventory;
use App\Models\TechReport;
use App\Models\TechProfile;
use App\Models\Services;

class ActivityLogController extends Controller
{
   
    public function index(Request $request)
{

    return view("acitivitylogs.index");
}
public function showLogs()
{
    // $logs = Activity::all();
    $logs = Activity::with('causer') 
    ->get();
   
    // For each log, get the relevant customer data
    foreach ($logs as $log) {
    // Initialize default values
    $customerName = '';
    $technicianName = '';
    $productName = '';
    $techNamefound = '';
    $customer = '';

    // Fetch customer data
    $newCustomerId = $log->properties['attributes']['customer_id'] ?? null;
    $oldCustomerId = $log->properties['old']['customer_id'] ?? null;
    if ($newCustomerId || $oldCustomerId) {
        $customerIdToUse = $newCustomerId ?? $oldCustomerId;
        $customer = Customer::find($customerIdToUse);
        if ($customer) {
            $customerName = $customer->name;
        }
    }

    // Fetch technician data
    $newTechnicianId = $log->properties['attributes']['technician_id'] ?? null;
    $oldTechnicianId = $log->properties['old']['technician_id'] ?? null;
    if ($newTechnicianId || $oldTechnicianId) {
        $technicianIdToUse = $newTechnicianId ?? $oldTechnicianId;
        $technician = TechProfile::find($technicianIdToUse);
        if ($technician) {
            $technicianName = $technician->name;
        }
    }

    // Fetch product data
    $subjectId = $log->subject_id;
    $logname = $log->log_name;
    
    // if ($subjectId && $logname == "sales") {
    //     $sales = Sales::find($subjectId); // Assume subject_id could be sales_id
    //     if ($sales) { 
    //         $salesCustomerId = $sales->customer_id;
    //         $salesCustomer = Customer::find($salesCustomerId);
    //         if ($salesCustomer) {
    //             $customer = $salesCustomer->name; // Overwrite customer name from sales
    //         }
    //     }
    // }

    if ($subjectId) {
        $inventory = Inventory::find($subjectId);
        if ($inventory) {
            $productName = $inventory->product_name ?? 'N/A';
        }
    }

    // Fetch tech report and associated technician
    if ($subjectId) {
        $techReport = TechReport::find($subjectId);
        if ($techReport) {
            $technicianId = $techReport->technician_id;
            if ($technicianId) {
                $techProfile = TechProfile::find($technicianId);
                if ($techProfile) {
                    $techNamefound = $techProfile->name;
                }
            }
        }
    }
    $customer = ''; // Default value
$salesCustomer = optional(Sales::find($subjectId))->customer;
$customer = optional($salesCustomer)->name ?? $customer; // Assign the customer name or keep default

   
    // Attach processed data to the log
    $log->customerName = $customerName;
    $log->technicianName = $technicianName;
    $log->techNamefound = $techNamefound;
    $log->productName = $productName;
    $log->customer = $customer;

    }
    return view('activitylogs.index', compact('logs'));
}


}
// {{ $sale->customer->name }}