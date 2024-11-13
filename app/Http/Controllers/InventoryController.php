<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\Log;

use App\DataTables\InventoryDataTable;
use Yajra\DataTables\Facades\DataTables;

class InventoryController extends Controller
{
    // public function index(Request $request)
    // {
    //     $search = $request->input('search');
    
    //     // Fetch inventory items with optional search functionality
    //     $inventory = Inventory::with(['category', 'brand'])
    //         ->when($search, function ($query) use ($search) {
    //             return $query->where('product_name', 'like', "%{$search}%");
    //         })
    //         ->get();
    
    //     return view('inventory.index', [
    //         'inventory' => $inventory,
    //         'search' => $search // Pass the search value to the view for preserving input
    //     ]);
    // }


        public function index(Request $request)
        {
            if ($request->ajax()) {
                try {
                    $data = Inventory::with(['category', 'brand'])
                        ->select('product_id', 'category_id', 'brand_id', 'product_name', 'quantity', 'released_date', 'status', 'notes', 'created_at', 'updated_at')
                        ->get()
                        ->map(function ($inventory) {
                            $inventory->notes = $inventory->notes ?? 'No notes available'; // Use a default message if notes is null
                            $inventory->created_at = $inventory->created_at ? $inventory->created_at->format('Y-m-d H:i:s') : 'N/A';
                            $inventory->updated_at = $inventory->updated_at ? $inventory->updated_at->format('Y-m-d H:i:s') : 'N/A';

                            $inventory->category_name = $inventory->category ? $inventory->category->category_name : 'N/A';
                            $inventory->brand_name = $inventory->brand ? $inventory->brand->brand_name : 'N/A'; 
                            return $inventory;
                        });
    
                    return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {
                            $viewUrl = route('inventoryitem.serials', $row->product_id);
                            $editUrl = route('inventory.edit', $row->product_id); // Route for edit
                            $deleteUrl = route('inventory.delete', $row); // Route for delete
    
                            return '<a href="' . $viewUrl . '" class="btn btn-sm btn-secondary">View Serials</a>
                                    <a href="' . $editUrl . '" class="btn btn-sm btn-primary">Update</a>
                                    <button data-url="' . $deleteUrl . '" class="btn btn-sm btn-danger delete-btn">Delete</button>';
                        })
                        ->rawColumns(['action']) // Mark action column as raw HTML
                        ->make(true);
                } catch (\Exception $e) {
                    Log::error('Error fetching inventory data: ' . $e->getMessage(), [
                        'request_data' => $request->all(),
                    ]);
                    return response()->json(['error' => 'An error occurred while fetching inventory data.'], 500);
                }
            }
    
            return view("inventory.index");
        }
    
    

    public function create()
    {
        $category = Category::all(); // Retrieve all categories
        $brands = Brand::all(); // Retrieve all brands
        $statuses = Inventory::getStatuses(); // Get statuses from the model
    
        return view('inventory.create', compact('category', 'brands', 'statuses'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:category,category_id',
            'brand_id' => 'required|exists:brand,brand_id',
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'released_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);
        
        $data['status'] = $this->getStatusBasedOnQuantity($data['quantity']);
        Inventory::create($data);

        return redirect(route('inventory.index'));
    }

    public function edit(Inventory $inventory)
    {
    // Fetch categories and brands from the database
    $category = Category::all(); // Adjust this if you have any filtering or specific queries
    $brands = Brand::all(); // Adjust this if you have any filtering or specific queries

    return view('inventory.edit', [
        'inventory' => $inventory,
        'categories' => $category, // Pass categories to the view
        'brands' => $brands, // Pass brands to the view
    ]);
    }

    public function update(Inventory $inventory, Request $request)
{
    // Validate the request data
    $data = $request->validate([
        'category_id' => 'required|exists:category,category_id',
        'brand_id' => 'required|exists:brand,brand_id',
        'product_name' => 'required|string|max:255',
        'quantity' => 'required|integer|min:1',
        'released_date' => 'required|date',
        'notes' => 'nullable|string',
    ]);

    $data['status'] = $this->getStatusBasedOnQuantity($data['quantity']);
    // Update the inventory item with validated data
    $inventory->update($data);

    // Redirect to index with success message
    return redirect(route('inventory.index'))->with('success', 'Product Updated Successfully');
    }

    public function delete(Inventory $inventory){
        $inventory->delete();
        return response()->json(['message' => 'Product Deleted Successfully'], 200); // Successful deletion response
    }
    
    private function getStatusBasedOnQuantity($quantity)
        {
            if($quantity <= 4) {
                return 'low_stock';
            } elseif($quantity = 0){
                return 'out_of_stock';
            }
            return 'available';
        }
    




    }