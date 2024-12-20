<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\InventoryItem;
use App\Models\sales;
use App\DataTables\InventoryDataTable;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


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
    $validator = Validator::make($request->all(), [
        'serial_number' => 'required|regex:/^[a-zA-Z0-9]+$/', // Only alphanumeric characters
        'condition' => 'required',
        // Add other validation rules as needed
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

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
    session()->flash('success', 'Serial created successfully!');
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
        $inventory = Inventory::findOrFail($inventoryitem->product_id);
    
        // Check if the quantity is greater than zero before decrementing
        if ($inventory->quantity > 0) {
            // Decrement the quantity
            $inventory->quantity--;
    
            // Update the status based on the new quantity
            if ($inventory->quantity == 0) {
                $inventory->status = 'out_of_stock';
            } elseif ($inventory->quantity <= 3) {
                $inventory->status = 'low_stock';
            } else {
                $inventory->status = 'available'; // Optional: reset to in_stock if above 3
            }
    
            // Save the updated quantity and status
            $inventory->save();
        }
    
        // Delete the inventory item
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
        $inventoryitem = Inventory::with('inventoryItems')->findOrFail($product_id);
    
        if ($request->ajax()) {
            $soldSerialNumbers = Sales::where('product_id', $product_id)
                ->pluck('serial_number')
                ->toArray();
    
            $data = InventoryItem::where('product_id', $product_id)
                ->whereNotIn('sku_id', $soldSerialNumbers)
                ->get();
    
            return DataTables::of($data)
                ->addIndexColumn()
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
    
        return view('inventory.serials', compact('inventoryitem', 'product_id'));
    }
    
    public function softDeletedItems()
{
    $softDeletedItems = InventoryItem::with('inventory')->onlyTrashed()->get();
    return view('admin.inventoryitem.soft_deleted', compact('softDeletedItems'));
}

public function restoreItem($sku_id)
{
    // Retrieve the item including soft-deleted items
    $item = InventoryItem::withTrashed()->findOrFail($sku_id);

    // Find the associated Inventory record
    $inventory = Inventory::findOrFail($item->product_id);

    // Increment the quantity of the associated Inventory record
    $inventory->increment('quantity', 1); // Increment the quantity by 1

    // Get the updated quantity
    $quantity = $inventory->quantity;

    // Determine stock status
    if ($quantity <= 0) {
        $inventory->status = 'out_of_stock';
    } elseif ($quantity <= 3) {
        $inventory->status = 'low_stock';
    } else {
        $inventory->status = 'available'; // Reset to available if above 3
    }

    // Save the updated status
    $inventory->save();

    // Restore the soft-deleted item
    $item->restore();

    // Redirect back with a success message
    return redirect()->route('admin.inventoryitem.softDeleted')->with('success', 'Item restored successfully and quantity incremented!');
}

public function forceDeleteItem($sku_id)
{
    $item = InventoryItem::withTrashed()->findOrFail($sku_id);
    $item->forceDelete();

    return redirect()->route('admin.inventoryitem.softDeleted')->with('success', 'Item deleted permanently!');
}

}
