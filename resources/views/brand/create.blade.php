<x-app-layout>
    <div class="flex flex-col md:flex-row h-screen">
        <!-- Sidebar (Navigation) -->
        <div class="w-full md:w-64 fixed top-0 left-0 z-10 h-screen bg-gray-900 md:block">
            @include('layouts.navigation') 
        </div>

        <!-- Main Content -->
        <div class="flex-1 md:ml-64 mt-16 md:mt-0 bg-gray-100 text-gray-800"> 
            <!-- Fixed Header -->
            <header class="bg-gray-200 py-3 px-3 fixed top-0 md:left-64 right-0 z-20 h-15 flex items-center justify-between text-black shadow-md">
                <h1 class="text-lg font-bold">Insert a Brand</h1>
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

            <!-- Form Container -->
            <div class="form-container">
                <h1 class="text-lg font-bold stitle">NEW BRAND</h1>
                <div class="error_checking">
                    @if($errors->any())
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <form id="brandForm" method="post" action="{{ route('brand.store') }}">
                    @csrf
                    <div class="brand_name">
                        <input type="text" id="brand_name" name="brand_name" placeholder="Brand Name" required />
                    </div>

                    <div class="button-group">
                        <input type="button" id="saveBrandButton" value="Save Brand" class="save-btn">
                        <a href="{{ route('inventory.index') }}" class="exit-btn">Cancel</a>
                    </div>
                </form>
            

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 hidden">
    <div class="bg-white max-w-sm w-full">
        <!-- Modal Header -->
        <h2 class="text-lg font-bold">Confirmation</h2>

        <!-- Modal Message -->
        <p id="confirmationMessage">
            Are you sure you want to save this brand? This action cannot be undone.
        </p>

        <!-- Centered Modal Buttons -->
        <div class="flex">
            <!-- Cancel Button -->
            <button id="confirmCancel">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Cancel
            </button>

            <!-- Confirm Button -->
            <button id="confirmSubmit">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Confirm
            </button>
        </div>
    </div>
</div>



      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">


    <style>
        body {
            font-family: 'Poppins'  ;
            background-color: #f3f3f3;
            margin: 0;
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

        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
            margin: 2rem auto;
        }

        .stitle {
            font-size: 22px;
            color: #4A628A;
            margin-bottom: 20px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            margin-top: 10px;
        }

        .button-group {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 10px;
        }

        .button-group input,
        .button-group .exit-btn {
            padding: 10px;
            width: 48%;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            color: white;
            display: inline-block;
            margin-top: 10px;
        }

        .button-group input{
            background-color: #4A628A;
            border: none;
        }

        .button-group input:hover {
            background-color: #3B4D6C;
        }

        .button-group .exit-btn {
            background-color: #e74c3c;
            border: none;
        }

        .button-group .exit-btn:hover {
            background-color: #c0392b;
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

    </style>

    <script>
        function confirmAction(message) {
            return confirm(message);
        }
           // Automatically refresh layout adjustments on window resize
           window.addEventListener('resize', function() {
    location.reload(); // Automatic na magre-refresh ang page
});

document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('confirmationModal');
    const modalMessage = document.getElementById('confirmationMessage');
    const confirmSubmitButton = document.getElementById('confirmSubmit');
    const confirmCancelButton = document.getElementById('confirmCancel');
    const form = document.getElementById('brandForm');
    const saveBrandButton = document.getElementById('saveBrandButton');

    // Open modal when clicking the save button
    saveBrandButton.addEventListener('click', function () {
        modalMessage.textContent = 'Are you sure you want to save this brand?';
        modal.classList.remove('hidden');
    });

    // Cancel button in modal
    confirmCancelButton.addEventListener('click', function () {
        modal.classList.add('hidden');
    });

    // Confirm button in modal
    confirmSubmitButton.addEventListener('click', function () {
        modal.classList.add('hidden');
        form.submit(); // Submit the form
    });
});


    </script>
</head>
<body>
    <div class="form-container">
        <h1>Insert a Brand</h1>
        <div class="error_checking">
            @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <form method="post" action="{{ route('brand.store') }}" onsubmit="return confirmAction('Are you sure you want to save this product?')">
            @csrf
            <div class="brand_name">
                <input type="text" id="brand_name" name="brand_name" placeholder="Brand Name" required />
            </div>

            <div class="button-group">
                <input type="submit" value="Save Brand">
                <a href="{{ route('inventory.index') }}" class="exit-btn" onclick="return confirmAction('Are you sure you want to cancel this?')">Cancel</a>
            </div>
        </form>
    </div>
    
</body>
</html>