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
                    $customer->created_at = $customer->created_at->format('Y-m-d H:i:s'); // Corrected format
                    $customer->updated_at = $customer->updated_at->format('Y-m-d H:i:s'); // Corrected format
                    return $customer; // Ensure the modified customer object is returned
                });
    
            return DataTables::of($data)
                ->addIndexColumn() // Add index column
                ->addColumn('action', function($row) {
                    // Correct URL generation for edit and delete
                    $editUrl = route('customer.edit', $row->customer_id);
                    $deleteUrl = route('customer.delete', $row->customer_id); // Pass customer_id, not the whole $row
                    
                    return '<a href="' . $editUrl . '" class="btn btn-sm btn-primary">Edit</a>
                            <button data-url="' . $deleteUrl . '" class="btn btn-sm btn-danger delete-btn">Delete</button>';
                })
                ->rawColumns(['action']) // Make the action buttons clickable
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
            'contact_no' => 'required',

        ]);
        Customer::create($data);

        return redirect(route('customer.index'));
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
            'contact_no' => 'required',

        ]);
        $customer->update($data);

        return redirect(route('category.index'))->with('success', 'Customer Updated Successfully');
    }

    public function delete(Customer $customer)
    {
        $customer->delete();
        return response()->json(['message' => 'Customer Deleted Successfully'],200);
    }
}