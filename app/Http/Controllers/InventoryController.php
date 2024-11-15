<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Category;
use App\Models\Brand;
<<<<<<< Updated upstream

use App\DataTables\InventoryDataTable;
=======
use Illuminate\Support\Facades\Log;
>>>>>>> Stashed changes
use Yajra\DataTables\Facades\DataTables;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            try {
                $query = Inventory::with(['category', 'brand'])
                    ->select('product_id', 'category_id', 'brand_id', 'product_name', 'quantity', 'released_date', 'status', 'notes', 'created_at', 'updated_at');

<<<<<<< Updated upstream

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
    
                            return '<a href="' . $viewUrl . '" class="btn btn-sm btn-primary">View Serials</a>
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
=======
                // Apply filters if they are present
                if ($request->has('category') && !empty($request->category)) {
                    $query->where('category_id', $request->category);
>>>>>>> Stashed changes
                }

                if ($request->has('brand') && !empty($request->brand)) {
                    $query->where('brand_id', $request->brand);
                }

                if ($request->has('status') && !empty($request->status)) {
                    $query->where('status', $request->status);
                }

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

                        return '<a href="' . $viewUrl . '" class="btn btn-sm btn-secondary">View Serials</a>
                                <a href="' . $editUrl . '" class="btn btn-sm btn-primary">Update</a>
                                <button data-url="' . $deleteUrl . '" class="btn btn-sm btn-danger delete-btn">Delete</button>';
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
            'category_id' => 'required|exists:category,category_id ',
            'brand_id' => 'required|exists:brand,brand_id',
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