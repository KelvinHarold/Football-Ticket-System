<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Santiago Bernabeu</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

  
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-white font-sans min-h-screen flex flex-col">
<!-- Preloader -->
<x-preloader />

    <!-- Navigation -->
    <nav class="w-full bg-white dark:bg-gray-800 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <img src="{{ asset('images/picture.jpg') }}" class="w-10 h-10 rounded-full border border-gray-300" alt="Logo">
                <span class="text-xl font-bold">Santiago Bernabeu</span>
            </div>
            <div>
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-2 text-sm px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">Register</a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="text-center py-12 bg-gradient-to-r from-white-600 to-white-700 text-blue-900 dark:from-gray-800 dark:to-gray-900">
        <h1 class="text-4xl font-bold mb-2">Welcome to Santiago Bernabeu Football Watching Hall</h1>
        <p class="text-lg">Official Football Ticket Booking System</p>
    </header>

    <!-- Ticket Table Section -->
    <main class="flex-grow w-full max-w-5xl mx-auto px-6 py-12">
        <h2 class="text-3xl font-semibold mb-6 text-center">Available Ticket Classes</h2>
        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-100 dark:bg-gray-700 text-left text-sm font-semibold">
                    <tr>
                        <th class="px-6 py-4 border-b">Name</th>
                        <th class="px-6 py-4 border-b">Description</th>
                        <th class="px-6 py-4 border-b text-right">Price (TZS)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 border-b">{{ $ticket->name }}</td>
                            <td class="px-6 py-4 border-b">{{ $ticket->description ?? 'N/A' }}</td>
                            <td class="px-6 py-4 border-b text-right">
                                {{ $ticket->price ? number_format($ticket->price->price, 0) : 'Not Set' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-800 border-t text-center text-sm py-6 text-gray-500 dark:text-gray-400">
        © {{ date('Y') }} Santiago Bernabeu. All rights reserved.
    </footer>
</body>
</html>
