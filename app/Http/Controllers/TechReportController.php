<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TechReport;
use App\Models\TechProfile;
use App\Models\Services;
use App\Models\Inventoryitem;
use App\Models\customer;

use App\DataTables\TechReportDataTable;
use Yajra\DataTables\Facades\DataTables;

//nabago
class TechReportController extends Controller
{
    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         try {

                
    //             $data = TechReport::with(['TechProfile', 'customer', 'Inventoryitem', 'Services'])
    //                 ->select('report_id', 'technician_id', 'customer_id', 'sku_id', 'service_id', 'date_of_completion', 'payment_type', 'payment_method', 'status', 'remarks', 'cost', 'created_at', 'updated_at')
                   
    //                 if ($request->has('paymenttype') && !empty($request->paymenttype)) {
    //                     $data->where('payment_type', $request->paymenttype);
    //                 }
        
    //                 if ($request->has('service') && !empty($request->service)) {
    //                     $data->where('service_id', $request->service);
    //                 }
        
    //                 if ($request->has('status') && !empty($request->status)) {
    //                     $data->where('status', $request->status);
    //                 }
                    
                    
    //                 ->get()
    //                 ->map(function ($techreport) {
    //                     $techreport->remarks = $techreport->remarks ?? 'No remarks available';
    //                     $techreport->created_at = $techreport->created_at ? $techreport->created_at->format('yy-m-d H:i:s') : 'N/A';
    //                     $techreport->updated_at = $techreport->updated_at ? $techreport->updated_at->format('yy-m-d H:i:s') : 'N/A';
    
    //                     // Use unique property names
    //                     $techreport->technician_name = $techreport->TechProfile ? $techreport->TechProfile->name : 'N/A';
    //                     $techreport->customer_name = $techreport->customer ? $techreport->customer->name : 'N/A';
    //                     $techreport->serial_number = $techreport->Inventoryitem ? $techreport->Inventoryitem->serial_number : 'N/A';
    //                     $techreport->product_id = $techreport->Inventoryitem ? $techreport->Inventoryitem->product_id : 'N/A';
    //                     $techreport->service_name = $techreport->Services ? $techreport->Services->service_name : 'N/A';
                        
    //                     $techreport->product_name = $techreport->Inventoryitem && $techreport->Inventoryitem->inventory
    //                     ? $techreport->Inventoryitem->inventory->product_name
    //                     : 'N/A';
                    
    
    //                     return $techreport;
    //                 });
    
    //             return DataTables::of($data)
    //                 ->addIndexColumn()
    //                 ->addColumn('action', function ($row) {
    //                     $viewUrl = route('techreport.view', $row->report_id);
    //                     $editUrl = route('techreport.edit', $row->report_id);
    //                     $deleteUrl = route('techreport.delete', $row->report_id);
    
    //                     return '
    //                             <a href="' . $viewUrl . '" class="btn btn-sm btn-primary">View</a>
    //                             <a href="' . $editUrl . '" class="btn btn-sm btn-primary">Edit</a>
    //                             <button data-url="' . $deleteUrl . '" class="btn btn-sm btn-danger delete-btn">Delete</button>';
    //                 })
    //                 ->rawColumns(['action'])
    //                 ->make(true);
    //         } catch (\Exception $e) {
    //             Log::error('Error fetching techreport data: ' . $e->getMessage(), [
    //                 'request_data' => $request->all(),
    //             ]);
    //             return response()->json(['error' => 'An error occurred while fetching techreport data.'], 500);
    //         }   
    //     }

    //     $techprofile =TechProfile::all();
    //     $service =Services::all();
    //     $paymenttype =TechReport::getPaymenttype(); //

    //     return view("techreport.index", compact('techprofile','service','paymenttype'));
    
        
    // }
    
    public function index(Request $request)
{
    if ($request->ajax()) {
        try {
            // Build the query for TechReport with relationships
            $data = TechReport::with(['TechProfile', 'customer', 'Inventoryitem', 'Services'])
                ->select('report_id', 'technician_id', 'customer_id', 'sku_id', 'service_id', 'date_of_completion', 'payment_type', 'payment_method', 'status', 'remarks', 'cost', 'created_at', 'updated_at');
            
            // Apply filters based on request data
            if ($request->has('paymenttype') && !empty($request->paymenttype)) {
                $data->where('payment_type', $request->paymenttype);
            }

            if ($request->has('service') && !empty($request->service)) {
                $data->where('service_id', $request->service);
            }
            
            if ($request->has('status') && !empty($request->status)) {
                $data->where('status', $request->status);
            }
            if ($request->has('paymentmethod') && !empty($request->paymentmethod)) {
                $data->where('payment_method', $request->paymentmethod);
            }
            
            // Fetch the data and map additional fields
            $data = $data->get()->map(function ($techreport) {
                // Set default values for missing fields
                $techreport->remarks = $techreport->remarks ?? 'No remarks available';
                $techreport->created_at = $techreport->created_at ? $techreport->created_at->format('yy-m-d H:i:s') : 'N/A';
                $techreport->updated_at = $techreport->updated_at ? $techreport->updated_at->format('yy-m-d H:i:s') : 'N/A';
                
                // Adding related fields (make sure they exist)
                $techreport->technician_name = $techreport->TechProfile ? $techreport->TechProfile->name : 'N/A';
                $techreport->customer_name = $techreport->customer ? $techreport->customer->name : 'N/A';
                $techreport->serial_number = $techreport->Inventoryitem ? $techreport->Inventoryitem->serial_number : 'N/A';
                $techreport->product_id = $techreport->Inventoryitem ? $techreport->Inventoryitem->product_id : 'N/A';
                $techreport->service_name = $techreport->Services ? $techreport->Services->service_name : 'N/A';
                
                // Add inventory product name if available
                $techreport->product_name = $techreport->Inventoryitem && $techreport->Inventoryitem->inventory
                    ? $techreport->Inventoryitem->inventory->product_name
                    : 'N/A';

                return $techreport;
            });

            // Return the data as a DataTables response
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $viewUrl = route('techreport.view', $row->report_id);
                    $editUrl = route('techreport.edit', $row->report_id);
                    $deleteUrl = route('techreport.delete', $row->report_id);

                    // Return the action buttons
                    return '
                        <a href="' . $viewUrl . '" class="btn btn-sm btn-primary">View</a>
                        <a href="' . $editUrl . '" class="btn btn-sm btn-primary">Edit</a>
                        <button data-url="' . $deleteUrl . '" class="btn btn-sm btn-danger delete-btn">Delete</button>';
                })
                ->rawColumns(['action'])  // Make action buttons render as HTML
                ->make(true);
        } catch (\Exception $e) {
            // Log the error and return a generic error message
            Log::error('Error fetching techreport data: ' . $e->getMessage(), [
                'request_data' => $request->all(),
            ]);
            return response()->json(['error' => 'An error occurred while fetching techreport data.'], 500);
        }
    }

    // For non-AJAX requests (e.g., page load)
    $techprofile = TechProfile::all();
    $service = Services::all();
    $paymenttype = TechReport::getPaymenttype(); // Get payment types
    $paymentmethod =TechReport::getPaymentmethod(); 

    return view("techreport.index", compact('techprofile', 'service', 'paymenttype','paymentmethod'));
}



  public function create()
  {
      $techprofile = TechProfile::all(); // Retrieve all technician
      $customer = customer::all(); // Retrieve all customer
      $inventoryitem = Inventoryitem::all(); // Retrieve all inventoryitem
      $service = Services::all(); // Retrieve all service

      $paymenttype =TechReport::getPaymenttype(); //
      $paymentmethod =TechReport::getPaymentmethod(); 
      $statuses =TechReport::getStatuses(); // 
  
      return view('techreport.create', compact('techprofile', 'customer', 'inventoryitem','service','paymenttype','paymentmethod','statuses'));
  }
  public function store(Request $request)
  {
      $data = $request->validate([
          'technician_id' => 'required|exists:technician,technician_id',
          'customer_id' => 'required|exists:customer,customer_id',
          'sku_id' => 'nullable|exists:inventory_item,sku_id',
          'service_id' => 'required|exists:service,service_id',
          'date_of_completion' => 'required|date|date_format:Y-m-d',
          'payment_type' => 'required|string', // Assuming a 'payment_type' field as per your comment
          'payment_method' => 'required|string', // Assuming a 'payment_method' field as per your comment
          'status' => 'required|string', // Assuming a 'status' field as per your comment
          'remarks' => 'nullable|string',
          'cost' => 'required|numeric|regex:/^\d{2,8}(\.\d{1,2})?$/',
     
    ]);
  
      TechReport::create($data); // Make sure TechnicianReport is the correct model name
      session()->flash('success', ' created successfully!');

      
      return redirect(route('techreport.index'));
  }

        
  public function view(TechReport $techreport)
  {
      // Fetch related data for the TechReport edit form
      $techprofile = TechProfile::all(); // Retrieve all technician profiles
      $customer = Customer::all(); // Retrieve all customers
      $inventoryitem = Inventoryitem::all(); // Retrieve all inventory items
      $service = Services::all(); // Retrieve all services
      $paymenttype = TechReport::getPaymenttype();
      $paymentmethod = TechReport::getPaymentmethod();
       $statuses = TechReport::getStatuses();
       

      return view('techreport.view', [
          'techreport' => $techreport,
          'techprofile' => $techprofile,
          'customer' => $customer,
          'inventoryitem' => $inventoryitem,
          'service' => $service,
          'paymenttype' => $paymenttype,
          'paymentmethod' => $paymentmethod,
          'statuses' => $statuses,
          
          

      

      ]);
  }

    

            public function edit(TechReport $techreport)
        {
            // Fetch related data for the TechReport edit form
            $techprofile = TechProfile::all(); // Retrieve all technician profiles
            $customer = Customer::all(); // Retrieve all customers
            $inventoryitem = Inventoryitem::all(); // Retrieve all inventory items
            $service = Services::all(); // Retrieve all services
            $paymenttype = TechReport::getPaymenttype();
            $paymentmethod = TechReport::getPaymentmethod();
             $statuses = TechReport::getStatuses();
             

            return view('techreport.edit', [
                'techreport' => $techreport,
                'techprofile' => $techprofile,
                'customer' => $customer,
                'inventoryitem' => $inventoryitem,
                'service' => $service,
                'paymenttype' => $paymenttype,
                'paymentmethod' => $paymentmethod,
                'statuses' => $statuses,
                
                
   
            
     
            ]);
        }

        public function update(TechReport $techreport, Request $request)
        {
            // Validate the request data for updating TechReport
            $data = $request->validate([
            'technician_id' => 'required|exists:technician,technician_id',
          'customer_id' => 'required|exists:customer,customer_id',
          'sku_id' => 'nullable|exists:inventory_item,sku_id',
          'service_id' => 'required|exists:service,service_id',
          'date_of_completion' => 'required|date|date_format:Y-m-d',
          'payment_type' => 'required|string', // Assuming a 'payment_type' field as per your comment
          'payment_method' => 'required|string', // Assuming a 'payment_method' field as per your comment
          'status' => 'required|string', // Assuming a 'status' field as per your comment
          'remarks' => 'nullable|string',
          'cost' => 'required|numeric|regex:/^\d{2,8}(\.\d{1,2})?$/',
            ]);

            // Update the TechReport item with validated data
            $techreport->update($data);

            // Redirect to techreport index with success message
            return redirect(route('techreport.index'))->with('success', 'Report Updated Successfully');
        }

        public function delete(TechReport $techreport)
        {
            $techreport->delete();
            return response()->json(['message' => 'TechReport Deleted Successfully'], 200); // Successful deletion response
        }

        public function softDeleted()
        {
            // Eager load the relationships: customer, inventory, and inventoryItem
            $softDeletedItems =  TechReport::with(['TechProfile', 'customer', 'Inventoryitem', 'Services','inventory'])->onlyTrashed()->get();
        
            return view('admin.techreport.soft_deleted', compact('softDeletedItems'));
        }
        
        public function restore($report_id)
        {
            $item = TechReport::withTrashed()->findOrFail($report_id);
            $item->restore();
        
            return redirect()->route('admin.techreport.soft_deleted')->with('success', 'Report restored successfully!');
        }
        
        public function forceDelete($report_id)
        {
            $item = TechReport::withTrashed()->findOrFail($report_id);
            $item->forceDelete();
        
            return redirect()->route('admin.services.soft_deleted')->with('success', 'Report deleted permanently!');
        }
        
            



           }





