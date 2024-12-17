<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\CategoryDataTable;
use App\Models\Customer;
use Yajra\DataTables\Facades\DataTables;
class CustomerController extends Controller
{
    //


    public function index(Request $request)
{
    if ($request->ajax()) {
        $data = Customer::select('customer_id', 'name', 'address', 'contact_no', 'created_at', 'updated_at')
            ->get()
            ->map(function($customer) {
                // Format dates
                $customer->created_at = $customer->created_at->format('Y-m-d H:i:s');
                $customer->updated_at = $customer->updated_at->format('Y-m-d H:i:s');
                
                // Format contact_no to include +63 with a space
                $customer->contact_no = str_replace('63', '+63 ', $customer->contact_no);

                return $customer;
            });

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $viewUrl = route('customer.history',$row->customer_id);
                $editUrl = route('customer.edit', $row->customer_id);
                $deleteUrl = route('customer.delete', $row->customer_id);
                
                return '<a href="' . $viewUrl . '" class="btn btn-sm btn-secondary">View History</a><br>
                        <a href="' . $editUrl . '" class="btn btn-sm btn-primary">Edit</a>
                        <button data-url="' . $deleteUrl . '" class="btn btn-sm btn-danger delete-btn">Delete</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    return view("customer.index");
}
    
    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'contact_no' => 'required|string|max:10', // Adjusted max length since we are adding +63
        ]);
    
        // Prepend +63 to the contact_no
        $data['contact_no'] = '+63' . $data['contact_no'];
    
        // Create the new customer record
        Customer::create($data);
    
        return redirect(route('customer.index'))->with('success', 'Customer Created Successfully');
    }
    
    public function edit(Customer $customer)
    {
        return view ('customer.edit',['customer' => $customer]);
    }
    public function update(Customer $customer, Request $request)
{
    $data = $request->validate([
        'name' => 'required',
        'address' => 'required',
        'contact_no' => 'required|string|max:10', // Adjusted max length since we are adding +63
    ]);

    // Prepend +63 to the contact_no
    $data['contact_no'] = '+63' . $data['contact_no'];

    // Update the customer record
    $customer->update($data);

    return redirect(route('customer.index'))->with('success', 'Customer Updated Successfully');
}


    public function delete(Customer $customer)
    {
        $customer->delete();
        return response()->json(['message' => 'Customer Deleted Successfully'],200);
    }
    public function showHistory(Customer $customer)
{
    // Fetch the sales data related to the customer
    $sales = $customer->sales; // Assuming you have defined a relationship in the Customer model

    return view('customer.history', compact('customer', 'sales'));
}
public function softDeleted()
{
    $softDeletedItems = Customer::onlyTrashed()->get();
   // dd($softDeletedItems); // Check the contents of the soft deleted items

    return view('admin.customer.soft_deleted', compact('softDeletedItems'));
}
public function restore($id)
{
    $item = Customer::withTrashed()->findOrFail($id);
    $item->restore();

    return redirect()->route('admin.customer.soft_deleted')->with('success', 'Customer restored successfully!');
}

public function forceDelete($id)
{
    $item = Customer::withTrashed()->findOrFail($id);
    $item->forceDelete();

    return redirect()->route('admin.customer.soft_deleted')->with('success', 'Customer deleted permanently!');
}
}