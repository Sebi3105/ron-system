<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\InventoryItem;
use App\Models\sales;
use App\DataTables\InventoryDataTable;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;


class InventoryitemController extends Controller
{
    public function index()
    {
        $products = InventoryItem::with(['inventory'])->get();
        return view('inventoryitem.index', ['products' => $products]);
    }

    public function create($product_id)
{
    $inventories = Inventory::all();
    $conditions = InventoryItem::getCONDITIONS(); // Ensure this method exists in InventoryItem
    $selectedInventory = Inventory::findOrFail($product_id); // Fetch the specific inventory item

    // Get the amount of the selected product
    $amount = $selectedInventory->quantity; // Assuming 'quantity' is the field name

    return view('inventoryitem.create', compact('inventories', 'conditions', 'selectedInventory', 'amount'));
}

    

public function store(Request $request)
{
    $data = $request->validate([
        'product_id' => 'required|exists:inventory,product_id',
        'serial_number' => 'required|string|max:255|unique:inventory_item,serial_number',
        'condition' => 'required|in:working,defective',
    ]);

    // Find the inventory item to get the total quantity
    $inventory = Inventory::findOrFail($data['product_id']);
    
    // Check how many serial numbers already exist for this product
    $existingCount = InventoryItem::where('product_id', $data['product_id'])->count();
    
    // Check how many serial numbers have been sold (hidden)
    $soldCount = Sales::where('product_id', $data['product_id'])->count();

    // Calculate the available quantity
    $availableQuantity = $inventory->quantity + $soldCount;

    // Check against the available quantity
    if ($existingCount >= $availableQuantity) {
        $remaining = $availableQuantity - $existingCount; // Calculate remaining serials
        // Adjust the message to handle the case where remaining is negative
        if ($remaining < 0) {
            $remaining = 0; // Ensure we don't show negative numbers
        }
        return redirect()->back()->withErrors(['message' => "You cannot create more serial numbers than the available amount. You can create $remaining more serial numbers."]);
    }
    
    // Create the new inventory item
    InventoryItem::create([
        'product_id' => $data['product_id'],
        'serial_number' => $data['serial_number'],
        'condition' => $data['condition'],
    ]);

    return redirect()->route('inventoryitem.serials', ['product_id' => $data['product_id']])
                     ->with('success', 'Inventory item saved successfully!');
}



    public function edit(InventoryItem $inventoryitem)
    {
        $inventories = Inventory::all();
        $conditions = InventoryItem::getCONDITIONS(); // Ensure this method exists in InventoryItem

        return view('inventoryitem.edit', [
            'inventories' => $inventories,
            'inventoryitem' => $inventoryitem,
            'conditions' => $conditions,
        ]);
    }

    public function update(InventoryItem $inventoryitem, Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:inventory,product_id',
            'serial_number' => 'required|string|max:255',
            'condition' => 'required|in:working,defective',
        ]);

        $inventoryitem->update($data);

        // Redirect to the serials page for the product associated with the inventory item
        return redirect()->route('inventoryitem.serials', ['product_id' => $inventoryitem->product_id])
                         ->with('success', 'Details Updated Successfully');
    }

    public function delete(InventoryItem $inventoryitem)
    {
        $inventoryitem->delete();
        return response()->json(['message' => 'Product Deleted Successfully'], 200); // Successful deletion response
    }

    // public function showSerials(Request $request, $product_id)
    // {
    //     $inventoryitem = Inventory::with('inventoryItems')->findOrFail($product_id);
    
    //     // Pass inventory item to the view
    //     return view('inventory.serials', compact('inventoryitem'));
    // }
    
    public function showSerials(Request $request, $product_id)
    {
        // Fetch the inventory item with its associated inventoryItems
        $inventoryitem = Inventory::with('inventoryItems')->findOrFail($product_id);
    
        if ($request->ajax()) {
            // Get sold serial numbers for the specific product, including soft-deleted ones
            $soldSerialNumbers = Sales::where('product_id', $product_id)
                ->whereNotNull('deleted_at') // Get only soft-deleted items
                ->pluck('serial_number')
                ->toArray();
    
            // Log the sold serial numbers for debugging
            Log::info('Soft-Deleted Serial Numbers:', $soldSerialNumbers);
    
            // Fetch available inventory items that are either sold (soft-deleted) or not sold
            $data = InventoryItem::where('product_id', $product_id)
                ->whereIn('sku_id', $soldSerialNumbers) // Include sold items (soft-deleted)
                ->orWhere(function($query) use ($product_id) {
                    $query->where('product_id', $product_id)
                          ->whereNotIn('sku_id', function($subQuery) use ($product_id) {
                              $subQuery->select('serial_number')
                                        ->from('sales')
                                        ->where('product_id', $product_id)
                                        ->whereNotNull('deleted_at'); // Exclude sold items
                          });
                })
                ->get();
    
            // Log the available serial numbers for debugging
            Log::info('Available Serial Numbers:', $data->pluck('serial_number')->toArray());
    
            return DataTables::of($data)
                ->addIndexColumn()  // Add an index column
                ->addColumn('action', function ($row) {
                    $deleteUrl = route('inventoryitem.delete', $row);  
                    $editUrl = route('inventoryitem.edit', $row);
    
                    return '
                        <a href="'.$editUrl.'" class="btn btn-sm btn-primary">Edit</a>
                        <button data-url="'.$deleteUrl.'" class="btn btn-sm btn-danger delete-btn">Delete</button>';
                })
                ->rawColumns(['action'])  
                ->make(true);  
        }
    
        // If it's not an AJAX request, simply return the view with the inventory item data
        return view('inventory.serials', compact('inventoryitem', 'product_id'));
    }
    
    public function softDeletedItems()
{
    $softDeletedItems = InventoryItem::with('inventory')->onlyTrashed()->get();
    return view('admin.inventoryitem.soft_deleted', compact('softDeletedItems'));
}

public function restoreItem($sku_id)
{
    $item = InventoryItem::withTrashed()->findOrFail($sku_id);
    $item->restore();

    return redirect()->route('admin.inventoryitem.softDeleted')->with('success', 'Item restored successfully!');
}

public function forceDeleteItem($sku_id)
{
    $item = InventoryItem::withTrashed()->findOrFail($sku_id);
    $item->forceDelete();

    return redirect()->route('admin.inventoryitem.softDeleted')->with('success', 'Item deleted permanently!');
}

}
