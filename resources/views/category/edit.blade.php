<x-app-layout>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <div class="flex flex-col md:flex-row h-screen font-poppins">
        <!-- Sidebar (Navigation) -->
        <div class="w-full md:w-64 fixed top-0 left-0 z-10 h-screen bg-gray-900">
            @include('layouts.navigation')
        </div>

        <!-- Main Content -->
        <div class="flex-1 md:ml-64 mt-15 bg-gray-100 text-gray-800">
            <!-- Fixed Header -->
            <header class="bg-gray-200 py-3 px-3 fixed top-0 md:left-64 right-0 z-20 h-15 flex items-center justify-between text-black shadow-md">
                <h1 class="text-lg font-bold">Category List</h1>
            </header>

            <!-- Form Container -->
            <div class="form-container mx-auto mt-24 md:mt-32">
                <h1 class="font-bold" style="color: #4a628a;">CATEGORY INFORMATION</h1>

                <!-- Error Checking -->
                <div class="error_checking">
                    @if($errors->any())
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

                <!-- Form -->
                <form method="post" action="{{ route('category.update', ['category' => $category]) }}"
                    onsubmit="return confirmAction('Are you sure you want to save these changes?')">
                    @csrf
                    @method('put')

                    <div class="category_name">
                        <input type="text" id="category_name" name="category_name" placeholder="Category Name" value="{{ $category->category_name }}" />
                    </div>

                    <div class="button-group">
                        <input type="submit" value="UPDATE">
                        <button type="button" onclick="window.location.href='{{ url()->previous() }}'">CANCEL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmAction(message) {
            return confirm(message);
        }
    </script>

    <style>
        /* Apply Poppins font */
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Form container styling */
        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 90%;
            text-align: center;
            margin: 12rem auto;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .fixed {
                position: relative;
                width: 100%;
            }

            header {
                left: 0;
                padding-left: 1rem;
            }

            .form-container {
                margin-top: 14rem;
                padding: 20px;
            }

            .form-container h1 {
                font-size: 1.2em;
            }
        }

        /* Form header */
        .form-container h1 {
            font-size: 1.5em;
            margin-bottom: 20px;
            color: #4a4a4a;
        }

        /* Error checking list */
        .error_checking ul {
            color: red;
            list-style-type: none;
            padding: 0;
            margin: 10px 0;
        }

        /* Input styling */
        .form-container input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }

        /* Button styling */
        .button-group {
            margin-top: 20px;
            display: flex;
            gap: 10px;
            flex-direction: row;
        }

        .button-group input[type="submit"],
        .button-group button {
            flex: 1;
            padding: 10px;
            font-size: 1em;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            text-align: center;
        }

        /* Save button */
        .button-group input[type="submit"] {
            background-color: #4a628a;
        }

        /* Cancel button */
        .button-group button {
            background-color: #d9534f;
        }

        /* Hover effects */
        .button-group input[type="submit"]:hover {
            background-color: #3b5374;
        }

        .button-group button:hover {
            background-color: #c9302c;
        }
    </style>
</x-app-layout>
