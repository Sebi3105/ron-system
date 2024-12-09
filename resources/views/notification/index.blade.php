<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <header class="bg-gray-200 py-4 px-8 fixed top-0 left-64 right-0 z-20 h-20 flex items-center justify-between shadow-md">
        <h1 class="text-2xl font-semibold text-gray-800">Notifications</h1>
    </header>

    <div class="flex flex-col md:flex-row h-screen">

        <div class="flex-1 ml-64 mt-20 flex justify-center items-center">
            <div class="notification-container">
                <h1 class="title"><strong>{{ count($product->where('quantity', '<=', 4)) }} Notifications:</strong></h1>

                @foreach($product as $products)
                    @if($products->quantity <= 0)
                        <div class="notification out-of-stock">
                            The <strong class="uppercase">{{ $products->product_name }}</strong> is out of stock. Please consider restocking soon to avoid disruptions in sales. You can update stock levels or reorder directly from the inventory system.
                        </div>
                    @elseif($products->quantity >= 1 && $products->quantity <= 4)
                        <div class="notification low-stock">
                            The stock for <strong>{{ $products->product_name }}</strong> is running low. Please consider restocking soon to avoid running out. You can update stock levels or reorder directly from the inventory system.
                        </div>
                    @endif
                @endforeach

                <!-- Pagination Controls -->
                <div class="mt-4">
                    {{ $product->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    body{
        background: #000;
    }
    .notification-container {
        background-color: #fff;
        color: #000;
        border-radius: 10px;
        padding: 20px;
        width: 500px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .title {
        font-size: 24px;
        margin-bottom: 20px;
        text-align: center;
    }

    .notification {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
        font-size: 14px;
        line-height: 1.5;
        width: 100%;
    }

    .out-of-stock {
        background-color: #ffdddd;
        border: 1px solid #ff0000;
    }

    .low-stock {
        background-color: #fff8dc;
        border: 1px solid #ffd700;
    }
</style>
