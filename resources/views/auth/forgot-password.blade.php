<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Forgot Password</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* ! tailwindcss v3.4.1 | MIT License | https://tailwindcss.com */
                /* Styles here */
            </style>
        @endif
    </head>

    <body class="font-sans antialiased">
        <div class="bg-gray-50 text-black/50" 
            style="position: absolute; top: 0; left: 0; width: 100vw; height: 100vh; 
                    background-image: url('{{ asset('images/loginbg.png') }}');
                    background-size: cover; background-position: center;">

            <!-- Centered Form Container -->
            <div class="flex justify-center items-center min-h-screen">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
                    <h2 class="text-xl font-semibold text-center text-gray-800">Forgot Password</h2>
                    <p class="text-sm text-center text-gray-500 mb-4">Enter your email address to reset your password.</p>

                    <!-- Forgot Password Form -->
                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <input type="email" id="email" name="email" class="w-full p-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required placeholder="Your email address">
                        </div>

                        <div class="mb-4 text-center">
                            <button type="submit" class="w-full py-2 px-4 bg-[#16325b] text-white rounded-lg hover:bg-#1c1c84 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Send Password Reset Link
                            </button>
                        </div>
                    </form>

                    <!-- Link to Login Page -->
                    <p class="text-center text-sm text-gray-500">
                        Remembered your password? <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700">Back to Login</a>
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
