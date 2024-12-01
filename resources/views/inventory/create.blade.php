<x-app-layout>
    <div class="flex flex-col md:flex-row h-screen">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <!-- Sidebar (Navigation) -->
        <div class="w-full md:w-48 lg:w-64 fixed top-0 left-0 z-10 h-screen bg-gray-900">
            @include('layouts.navigation')
        </div>

        <!-- Main Content -->
        <div class="flex-1 md:ml-48 lg:ml-64 mt-16 md:mt-0 bg-gray-100 text-gray-800">
            <!-- Fixed Header -->
            <header class="bg-gray-200 py-3 px-3 md:px-6 fixed top-0 md:left-48 lg:left-64 right-0 z-15 h-15 flex items-center justify-between text-black shadow-md">
                <h1 class="text-lg font-bold">Add Product Information</h1>
            </header>

            <!-- Back to Inventory Button -->
            <div class="flex justify-start mt-24 md:mt-28 px-4">
                <a href="{{ route('inventory.index') }}" class="back-btn flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l-7-7 7-7" />
                    </svg>
                    Back to Inventory
                </a>
            </div>
            <div class="form-container">
                <!-- Success Notification -->
                <div class="success_pop mb-4">
                    @if(session()->has('success'))
                        <div class="bg-green-500 text-white p-2 rounded">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>

            <!-- Form Container -->
            <div class="form-container">
                <form method="post" action="{{ route('inventory.store') }}" onsubmit="return confirmAction('Are you sure you want to save this product?')">
                    @csrf

                    <div class="form-row">
                        <div class="form-group">
                            <label for="product_name">Product Name</label>
                            <input type="text" name="product_name" id="product_name" placeholder="Product Name" required>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="category_id" required>
                                <option value="" selected>Select a Category</option>
                                @foreach($categories as $categories)
                                    <option value="{{ $categories->category_id }}">{{ $categories->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                <div class="form-group">
                    <label for="brand_id">Brand</label>
                    <select name="brand_id" id="brand_id" required>
                        <option value="" selected>Select a Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                        @endforeach
                    </select>
                </div>
                <br>

                <div class="form-group">
                <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" placeholder="Quantity" required min="0">
                </div>

                    <div class="form-group">
                        <label for="released_date">Date of Release</label>
                        <input type="date" name="released_date" id="released_date" required>
                    </div>

                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <input type="text" name="notes" id="notes" placeholder="Notes">
                    </div>

                    <div class="button-group">
                        <button type="submit">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        body {
            font-family: 'Poppins';
            background-color: #f3f3f3;
            margin: 0;
        }

        .form-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 26px;
            width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: 10px;
            margin-left: auto;
            margin-right: auto;
            width: 90%;
            max-width: 700px;
        }

        .stitle {
            font-size: 22px;
            color: #4A628A;
            margin-bottom: 20px;
            font-weight: bold;
        }

        label {
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }

        .form-row {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .form-group {
            flex: 1;
            margin-bottom: 15px;
            min-width: 200px;
        }

        input[type="text"], input[type="number"], input[type="date"], select {
            width: 100%;
            padding: 9px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            margin-top: 5px;
        }   

        .button-group {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .button-group button {
            padding: 10px;
            width: 100%;
            max-width: 250px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            color: white;
            display: inline-block;
        }

        .button-group button {
            background-color: #4A628A;
            border: none;
        }

        .button-group button:hover {
            background-color: #3B4D6C;
        }

        .back-btn {
    color: #3C3D37;
    padding: 0.3rem 1.2rem;
    font-size: 1rem;
    font-weight: bold;
    border-radius: 0.375rem;
    transition: transform 0.3s ease;
    text-decoration: none;
    margin-left: 2rem;
    margin-top: -4rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.back-btn:hover {
    transform: translateX(-5px);
}

.back-btn svg {
    transition: transform 0.3s ease;
}

.back-btn:hover svg {
    transform: translateX(-8px);
}
  #confirmationModal {
        z-index: 50;
        backdrop-filter: blur(5px);
        animation: fadeInBackdrop 0.4s ease-out;
    }

    @keyframes fadeInBackdrop {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Modal Style */
    #confirmationModal .bg-white {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        animation: modalEntry 0.4s ease-out;
    }

    @keyframes modalEntry {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    /* Header with Green Gradient */
    #confirmationModal h2 {
        font-size: 22px;
        font-weight: bold;
        background: linear-gradient(90deg, #4CAF50, #2E7D32);
        color: #fff;
        text-align: center;
        padding: 12px;
        margin: 0;
    }

    /* Modal Text */
    #confirmationModal p {
        font-size: 17px;
        color: #4B5563;
        text-align: center;
        margin: 20px 0 27px;
        line-height: 1.6;
    }

   
#confirmationModal .flex {
    justify-content: center;
    gap: 16px; 
    padding: 12px 0; 
}

#confirmationModal button {
    border: none;
    padding: 10px 20px; 
    font-size: 14px; 
    font-weight: bold;
    border-radius: 8px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px; 
    transition: all 0.3s ease;
}


    #confirmationModal button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    #confirmCancel {
        background-color: #E5E7EB;
        color: #374151;
    }

    #confirmCancel:hover {
        background-color: #D1D5DB;
    }

    #confirmSubmit {
        background: linear-gradient(90deg, #4CAF50, #2E7D32);
        color: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    #confirmSubmit:hover {
        background: linear-gradient(90deg, #2E7D32, #1B5E20);
    }
    </style>

javascript

Verify

Open In Editor
Edit
Copy code
<script>
    function confirmAction(message) {
        if (confirm(message)) {
            return true; // User confirmed, proceed with the form submission
        } else {
            window.location.href = "{{ route('inventory.index') }}"; // Redirect to inventory.index
            return false; // Prevent form submission
        }
    }

    // Automatically refresh layout adjustments on window resize
    window.addEventListener('resize', function() {
        location.reload(); // Automatic refresh of the page
    });
</script>



    </script>
</x-app-layout>