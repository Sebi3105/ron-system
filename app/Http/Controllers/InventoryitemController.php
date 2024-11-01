<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\InventoryItem;

class InventoryitemController extends Controller
{
    public function index()
    {
        $products = InventoryItem::with(['inventory'])->get();
        return view('inventoryitem.index', ['products' => $products]);
    }

    public function create()
    {
        $inventories = Inventory::all();
        $conditions = InventoryItem::getCONDITIONS(); // Ensure this method exists in InventoryItem
        return view('inventoryitem.create', compact('inventories', 'conditions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:inventory,product_id',
            'serial_number' => 'required|string|max:255|unique:inventory_item,serial_number', // Ensure uniqueness
            'condition' => 'required|in:working,defective',
        ]);

        $inventoryItem = InventoryItem::create([
            'product_id' => $data['product_id'],
            'serial_number' => $data['serial_number'],
            'condition' => $data['condition'],
        ]);

        // Redirect to the serials page for the product associated with the newly created inventory item
        return redirect()->route('inventoryitem.serials', ['product_id' => $inventoryItem->product_id])
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
        return redirect()->route('inventory.index')->with('success', 'Product Deleted');
    }

    public function showSerials(Request $request, $product_id)
{
    // Get the inventory with the given product ID, including serial numbers
    $inventoryitem = Inventory::with('inventoryItems')->findOrFail($product_id);

    // Handle search functionality
    $search = $request->input('search');
    if ($search) {
        $inventoryitem->inventoryItems = $inventoryitem->inventoryItems->filter(function($item) use ($search) {
            return str_contains($item->serial_number, $search);
        });
    }

    // Pass the inventory item and its serials to the view
    return view('inventory.serials', compact('inventoryitem', 'search'));
}

    
}
