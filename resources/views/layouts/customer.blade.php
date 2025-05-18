<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MtotoClinic') }}</title>
                <!-- Favicon (Logo) -->
    <link rel="icon" href="{{ asset('images/Logo.jpg') }}" type="image/jpg">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @include('layouts.navigation')
      
        <style>
            /* Custom Colors */
            .icon-colored {
                color: #FE6700;
            }

            .hover-link {
                transition: background-color 0.3s ease, color 0.3s ease;
            }

            .hover-link:hover {
                background-color:  rgb(58, 137, 240);
                color: #FEFEFE;
            }

            .dropdown-link:hover {
                background-color:  rgb(58, 137, 240);
                color: #FEFEFE;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <div class="flex-col w-full md:flex md:flex-row md:min-h-screen">
                <div @click.away="open = false" class="flex flex-col flex-shrink-0 w-full text-gray-700 bg-white md:w-64 dark-mode:text-gray-200 dark-mode:bg-gray-800" x-data="{ open: false }">
                    <div class="flex flex-row items-center justify-between flex-shrink-0 px-8 py-4">
                        <a href="#" class="text-lg font-semibold tracking-widest text-blue-400 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">Customer</a>
                        <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
                            <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                                <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    @include('layouts.navbar')
                </div>
                <div class="flex w-full bg-slate-50">
                {{ $slot }}    
                </div> 
            </div>
            @include('layouts.footer')
    </body>
</html>