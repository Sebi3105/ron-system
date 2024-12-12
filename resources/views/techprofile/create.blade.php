<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <div class="flex flex-col md:flex-row h-screen">
        <!-- Sidebar (Navigation) -->
        <div class="w-full md:w-64 fixed top-0 left-0 z-10 h-screen bg-gray-900 md:block">
            @include('layouts.navigation') 
        </div>

        <!-- Main Content -->
        <div class="flex-1 md:ml-64 mt-16 md:mt-0 bg-gray-100 text-gray-800"> 
            <!-- Fixed Header -->
            <header class="bg-gray-200 py-3 px-3 fixed top-0 md:left-64 right-0 z-20 h-15 flex items-center justify-between text-black shadow-md">
                <h1 class="text-lg font-bold">Add Technician</h1>
            </header>
             
            <!-- Back to Button -->
            <div class="flex justify-start mt-24 md:mt-28 px-4">
                <a href="{{ route('techreport.index') }}" class="back-btn flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l-7-7 7-7" />
                    </svg>
                    Back to Technician
                </a>
            </div>

            <!-- Form Container -->
            <div class="form-container">
                <h1 class="text-lg font-bold stitle">NEW TECHNICIAN</h1>
                <div class="error_checking">
                    @if($errors->any())
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <form id="TechProfileForm" method="post" action="{{ route('techprofile.store') }}">
                    @csrf
                    <div class="name">
                        <input type="text" id="name" name="name" placeholder="Technician Name" pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed" required />
                        <span id="nameError" class="text-red-500 text-sm hidden">Only letters and spaces are allowed.</span>
                    </div>
                    <div class="contact_no relative">
                        <small style="font-size: 12px;">Note: Enter only the last 10 digits (e.g., 9123424321)</small>
                        <span class="absolute top-1/2 left-3 transform -translate-y-1/2 text-gray-700 text-sm pointer-events-none" aria-hidden="true">+63</span>
                        <input type="text" id="contact_no" name="contact_no" maxlength="10" inputmode="numeric" pattern="[0-9]{10}" placeholder="e.g., 9123424321" title="Enter a valid 10-digit phone number" style="padding-left: 40px;" required />
                    </div>

                    <div class="button-group">
                        <input type="button" id="saveTechnicianButton" value="Save Technician" class="save-btn">
                        <a href="{{ route('techreport.index') }}" class="exit-btn">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="confirmationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 hidden">
        <div class="bg-white max-w-sm w-full">
            <h2 class="text-lg font-bold">Confirmation</h2>
            <p id="confirmationMessage">Are you sure you want to save this Technician?</p>
            <div class="flex">     
                <button id="confirmCancel">Cancel</button>
                <button id="confirmSubmit">Confirm</button>
            </div>
        </div>
    </div>

    <div id="cancelModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white max-w-sm w-full rounded-md shadow-lg">
            <h2 class="text-lg font-bold mb-4 text-white bg-gradient-to-r from-yellow-500 to-yellow-700 p-4 rounded-t-lg">
                Confirmation
            </h2>
            <p class="text-gray-700 text-center mb-6">Are you sure you want to cancel?</p>
            <div class="flex justify-center gap-4">
                <button id="cancelModalClose" class="px-6 py-3 bg-gray-200 text-black rounded-md hover:bg-gray-200 transition">Cancel</button>
                <a href="{{ route('techreport.index') }}" id="saveconfirmCancel" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-700 text-white rounded-md hover:from-red-600 hover:to-red-800 transition">Confirm</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('TechProfileForm');
            const saveTechnicianButton = document.getElementById('saveTechnicianButton');
            const nameInput = document.getElementById('name');
            const nameError = document.getElementById('nameError');
            
            // Custom validation for "name" field
            function validateName() {
                const nameValue = nameInput.value.trim();
                const namePattern = /^[A-Za-zÀ-ÿ\s]+$/;
                
                if (!nameValue.match(namePattern)) {
                    nameError.classList.remove('hidden');
                    return false;
                } else {
                    nameError.classList.add('hidden');
                    return true;
                }
            }

            // Add event listener to validate name on input
            nameInput.addEventListener('input', validateName);

            // Form submit handler
            saveTechnicianButton.addEventListener('click', function () {
                const isNameValid = validateName();
                if (isNameValid) {
                    // Show the confirmation modal before submitting the form
                    document.getElementById('confirmationModal').classList.remove('hidden');
                } else {
                    alert("Please correct the name.");
                }
            });


            // Confirmation modal buttons
            document.getElementById('confirmSubmit').addEventListener('click', function () {
                form.submit();
                document.getElementById('confirmationModal').classList.add('hidden');
            });

            document.getElementById('confirmCancel').addEventListener('click', function () {
                document.getElementById('confirmationModal').classList.add('hidden');
            });
        });
    </script>

    <style>
        /* Custom error message styling */
        #nameError {
            display: none;
            color: red;
            font-size: 12px;
        }

  
        body {
            font-family: 'Poppins';
            background-color: #f3f3f3;
            margin: 0;
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
            margin-bottom: 15px;
            font-weight: bold;
        }

        label {
            display: block;
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
            text-align: left;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 3px;
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
            border-radius: 3px;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            color: white;
            display: inline-block;
            margin-top: 10px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .button-group input{
            background-color: #4A628A;
            border: none;
        }

        .button-group input:hover {
            background-color: #3B4D6C;
            transform: scale(1.05);
        }

        .button-group .exit-btn {
            background-color: #e74c3c;
            border: none;
        }

        .button-group .exit-btn:hover {
            background-color: #c0392b;
            transform: scale(1.05);
        }

        .back-btn {
            color: #3C3D37;
            padding: 0.3rem 1.2rem;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 0.375rem;
            transition:transform 0.3s ease;
            text-decoration: none;
            margin-left: 2rem;
            margin-top: -2rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem; 
        }

        .back-btn:hover {
            background-color: #F5F5F5;
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
        border-radius: 12px;
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
        font-size: 15px;
        color: #4B5563;
        text-align: center;
        margin: 16px 0 24px;
        line-height: 1.6;
    }

    /* Buttons */
    #confirmationModal button {
        border: none;
        padding: 12px 20px;
        font-size: 14px;
        font-weight: bold;
        border-radius: 3px;
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

    /* Icons */
    #confirmationModal button svg {
        height: 18px;
        width: 18px;
    }
    #confirmationModal .flex {
    justify-content: center; 
    gap: 16px;
    padding: 12px 0;
}

/* Buttons */
#confirmationModal button {
    border: none;
    padding: 10px 20px; 
    font-size: 14px;
    font-weight: bold;
    border-radius: 3px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: all 0.3s ease;
}

#cancelModal {
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

#cancelModal .bg-white {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    animation: modalEntry 0.4s ease-out;
    width: 100%;
    max-width: 400px; /* Limit the maximum width */
    margin: 0 auto; /* Center it horizontally */
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

/* Header with Red Gradient */
/* Modal Header */
#cancelModal h2 {
    font-size: 22px; /* Slightly smaller font for better fit */
    font-weight: bold;
    background: linear-gradient(90deg, #FF4C4C, #C62828);
    color: #fff;
    text-align: center;
    padding: 12px;
    margin: 0;
}

/* Modal Content */
#cancelModal p {
    font-size: 16px; /* Adjust text size for better fit */
    color: #4B5563;
    text-align: center;
    margin: 16px 0 28px;
    line-height: 1.4;
}

/* Buttons */
#cancelModal .flex {
    justify-content: center;
    gap: 12px; /* Reduce button spacing */
    padding: 0; /* Remove extra padding */
}

/* Equal-width buttons with max width */
#cancelModal button,
#cancelModal a {
    margin-top: 0.5rem;
    margin-bottom: 1rem;
    border: none;
        padding: 9px 20px;
        font-size: 14px;
        font-weight: bold;
        border-radius: 3px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
}

#cancelModal button:hover,
#cancelModal a:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

/* Cancel Button */
#cancelCancel {
    background-color: #E5E7EB;
    color: #374151;
}

#cancelCancel:hover {
    background-color: #D1D5DB;
}

    </style>
</x-app-layout>

