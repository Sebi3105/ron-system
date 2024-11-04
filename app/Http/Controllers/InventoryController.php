<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Category;
use App\Models\Brand;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        // Fetch inventory items with optional search functionality
        $inventory = Inventory::with(['category', 'brand'])
            ->when($search, function ($query) use ($search) {
                return $query->where('product_name', 'like', "%{$search}%");
            })
            ->get();
    
        return view('inventory.index', [
            'inventory' => $inventory,
            'search' => $search // Pass the search value to the view for preserving input
        ]);
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

public function delete(Inventory $inventory)
    {
        $inventory->delete();
        return redirect(route('inventory.index'))->with('success', 'Product Deleted Successfully');
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




