<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto flex justify-between items-center p-4">
            <h1 class="text-2xl font-bold text-gray-800">{{ config('app.name') }}</h1>
            <nav class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">Log in</a>
                    <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-900">Register</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-cover bg-center h-screen" style="background-image: url('https://source.unsplash.com/random');">
        <div class="bg-gray-900 bg-opacity-50 h-full flex items-center justify-center">
            <div class="text-center text-white p-8">
                <h2 class="text-4xl md:text-6xl font-bold">Welcome to {{ config('app.name') }}</h2>
                <p class="mt-4 text-xl">Your trusted platform for [Your Service/Business]</p>
                <a href="{{ route('register') }}" class="mt-6 inline-block bg-gray-800 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition">Get Started</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto text-center">
            <h3 class="text-3xl font-bold mb-8">Why Choose Us?</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h4 class="text-2xl font-semibold mb-4">Feature 1</h4>
                    <p class="text-gray-600">Brief description of why this feature is important and how it benefits the user.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h4 class="text-2xl font-semibold mb-4">Feature 2</h4>
                    <p class="text-gray-600">Another great benefit of using our platform that enhances the user experience.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h4 class="text-2xl font-semibold mb-4">Feature 3</h4>
                    <p class="text-gray-600">Explain why users will love this feature and how it makes things easier.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>

