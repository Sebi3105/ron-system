<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Sales; // Keeping the model name as Sales
    use App\Models\Customer;
    use App\Models\InventoryItem;
    use App\Models\Inventory;

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
            // Fetch serials based on the inventory item id
            $serials = InventoryItem::where('product_id', $id)->get();
            
            return response()->json($serials);
        }
    }