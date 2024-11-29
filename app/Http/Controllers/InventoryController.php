<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class InventoryController extends Controller
{
    public function index(Request $request)
{
    if ($request->ajax()) {
        try {
            $query = Inventory::with(['category', 'brand'])
                ->select('product_id', 'category_id', 'brand_id', 'product_name', 'quantity', 'released_date', 'status', 'notes', 'created_at', 'updated_at');

            // Apply filters if they are present
            if ($request->has('category') && !empty($request->category)) {
                $query->where('category_id', $request->category);
            }

            if ($request->has('brand') && !empty($request->brand)) {
                $query->where('brand_id', $request->brand);
            }

            if ($request->has('status') && !empty($request->status)) {
                $query->where('status', $request->status);
            }

            // Optional: Include soft-deleted items
            // $query->withTrashed();

            $data = $query->get()->map(function ($inventory) {
                $inventory->notes = $inventory->notes ?? 'No notes available';
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
                    $editUrl = route('inventory.edit', $row->product_id);
                    $deleteUrl = route('inventory.delete', $row);

                    return '<div class="flex space-x-2 items-center justify-center">
                            <a href="' . $viewUrl . '" class="bg-navy-blue text-blue py-1 px-2 rounded">View Serials</a>
                            <a href="' . $editUrl . '" class="btn btn-sm btn-primary">Update</a>
                            <button data-url="' . $deleteUrl . '" class="btn btn-sm btn-danger delete-btn">Delete</button>
                            </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (\Exception $e) {
            Log::error('Error fetching inventory data: ' . $e->getMessage(), [
                'request_data' => $request->all(),
            ]);
            return response()->json(['error' => 'An error occurred while fetching inventory data.'], 500);
        }
    }

    $categories = Category::all();
    $brands = Brand::all();

    return view("inventory.index", compact('categories', 'brands'));
}

    public function create()
    {
        $categories = Category::all(); // Retrieve all categories
        $brands = Brand::all(); // Retrieve all brands
        $statuses = Inventory::getStatuses(); // Get statuses from the model

        return view('inventory.create', compact('categories', 'brands', 'statuses'));
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
        $categories = Category::all(); // Fetch categories
        $brands = Brand::all(); // Fetch brands

        return view('inventory.edit', [
            'inventory' => $inventory,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    public function update(Inventory $inventory, Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:category,category_id', // Ensure no trailing space
            'brand_id' => 'required|exists:brand,brand_id', // Ensure no trailing space
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'released_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);
    
        $data['status'] = $this->getStatusBasedOnQuantity($data['quantity']);
        $inventory->update($data);
    
        return redirect(route('inventory.index'))->with('success', 'Product Updated Successfully');
    }
    public function delete(Inventory $inventory)
{
    // Soft delete the inventory item
    $inventory->delete();
    return response()->json(['message' => 'Product Deleted Successfully'], 200);
}


    private function getStatusBasedOnQuantity($quantity)
    {
        if ($quantity <= 0) {
            return 'out_of_stock';
        } elseif ($quantity <= 4) {
            return 'low_stock';
        }
        return 'available';
    }
}