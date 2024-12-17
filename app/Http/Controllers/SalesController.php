<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Sales; // Keeping the model name as Sales
    use App\Models\Customer;
    use App\Models\InventoryItem;
    use App\Models\Inventory;
    use App\Models\TechReport;

    class SalesController extends Controller
    {
        public function index(Request $request)
        {
            // Fetch sales data with related customer and inventory information
            $sales = Sales::with(['customer', 'inventory', 'inventoryItem'])->get(); // Use 'inventoryItem'
        
            return view("sales.index", compact('sales'));
        }

        public function create()
        {
            $customers = Customer::all();
            $inventories = Inventory::all();
        
            return view('sales.create', compact('customers', 'inventories'));
        }
        
        public function edit($id)
        {
            $sale = Sales::findOrFail($id); // Fetch the sale by ID
            $customers = Customer::all(); // Fetch customers
            $inventories = Inventory::all(); // Fetch inventories
            $serials = InventoryItem::all(); // Fetch serials
        
            return view('sales.edit', compact('sale', 'customers', 'inventories', 'serials'));
        }
                
        public function update(Request $request, Sales $sale)
        {
            $validatedData = $request->validate([
                'customer_id' => 'required|exists:customer,customer_id',
                'inventory_id' => 'required|exists:inventory,product_id',
                'serials' => 'required|exists:inventory_item,sku_id',
                'state' => 'required|in:reserved,for_pickup,for_delivery',
                'sale_date' => 'required|date',
                'amount' => 'required|numeric|min:0',
                'payment_method' => 'required|in:installment,full_payment',
                'payment_type' => 'required|in:credit_card,cash,gcash,paymaya',
            ]);
        
            // Update the sale record
            $sale->update([
                'customer_id' => $validatedData['customer_id'],
                'product_id' => $validatedData['inventory_id'],
                'serial_number' => $validatedData['serials'],
                'state' => $validatedData['state'],
                'sale_date' => $validatedData['sale_date'],
                'amount' => $validatedData['amount'],
                'payment_method' => $validatedData['payment_method'],
                'payment_type' => $validatedData['payment_type'],
            ]);
        
            // Redirect to the sales index with a success message
            return redirect()->route('sales.index')->with('success', 'Sale updated successfully.');
        }
        

    
    public function destroy(Request $request, Sales $sale)
    {
        // Check if the request wants a hard delete
        if ($request->input('delete_type') === 'hard') {
            // Perform hard delete
            $sale->forceDelete();
            return redirect()->route('sales.index')->with('success', 'Sale permanently deleted.');
        }
    
        // Soft delete
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customer,customer_id',
            'inventory_id' => 'required|exists:inventory,product_id',
            'serials' => 'required|exists:inventory_item,sku_id',
            'state' => 'required|in:reserved,for_pickup,for_delivery',
            'sale_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:installment,full_payment',
            'payment_type' => 'required|in:credit_card,cash,gcash,paymaya',
        ]);

        // Create a new sale record
        $sale = Sales::create([
            'customer_id' => $validatedData['customer_id'],
            'product_id' => $validatedData['inventory_id'],
            'serial_number' => $validatedData['serials'], // Store sku_id as serial_number
            'state' => $validatedData['state'],
            'sale_date' => $validatedData['sale_date'],
            'amount' => $validatedData['amount'],
            'payment_method' => $validatedData['payment_method'],
            'payment_type' => $validatedData['payment_type'],
        ]);

        // Decrease the quantity of the inventory item
        $inventoryItem = InventoryItem::where('sku_id', $validatedData['serials'])->first();
        if ($inventoryItem) {
            $inventory = Inventory::find($validatedData['inventory_id']);
            if ($inventory) {
                $inventory->decrement('quantity'); // Decrease the quantity by 1
            }
        }

        // Redirect to the sales index with a success message
        return redirect()->route('sales.index')->with('success', 'Sale created successfully.');
    }

    public function getSerials($id)
    {
        // Fetch serials based on the inventory item id, excluding those in sales
        $serials = InventoryItem::where('product_id', $id)
            ->whereDoesntHave('sales')
            ->get();

        return response()->json($serials);
    }


    public function show($id)
    {
        // Fetch related technician reports
        // \Log::info('Fetched Technician Reports:', $techreport->toArray());
        $sale = Sales::with(['customer', 'inventory', 'inventoryItem'])->findOrFail($id);
        $skuId = $sale->sku_id;
        $techreport = TechReport::where('sku_id', $sale->inventoryItem->sku_id)->get();
        return view('sales.show', compact('sale','techreport'));
    }


    public function softDeleted()
    {
        // Eager load the relationships: customer, inventory, and inventoryItem
        $softDeletedItems = Sales::with(['inventory', 'customer', 'inventoryitem'])->onlyTrashed()->get();

        return view('admin.sales.soft_deleted', compact('softDeletedItems'));
    }

    public function restore($sales_id)
    {
        $item = Sales::withTrashed()->findOrFail($sales_id);
        $item->restore();

        return redirect()->route('admin.sales.soft_deleted')->with('success', 'Sales restored successfully!');
    }

    public function forceDelete($sales_id)
    {
        $item = Sales::withTrashed()->findOrFail($sales_id);
        $item->forceDelete();

        return redirect()->route('admin.sales.soft_deleted')->with('success', 'Sales deleted permanently!');
    }
}