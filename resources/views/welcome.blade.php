<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Santiago Bernabeu - Premium Football Experience</title>
    <meta name="description" content="Official ticket booking system for Santiago Bernabeu football watching hall with premium amenities">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #1a365d;
            --secondary: #e53e3e;
            --accent: #f6ad55;
            --dark: #2d3748;
            --light: #f7fafc;
        }
        
        /* Animation classes */
        .fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }
        
        .slide-up {
            animation: slideUp 0.8s ease-out forwards;
        }
        
        .scale-in {
            animation: scaleIn 0.8s ease-out forwards;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideUp {
            from { 
                opacity: 0;
                transform: translateY(20px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes scaleIn {
            from { 
                opacity: 0;
                transform: scale(0.95);
            }
            to { 
                opacity: 1;
                transform: scale(1);
            }
        }
        
        /* Initial state before animations */
        [data-animate] {
            opacity: 0;
        }
        
        /* Custom styles */
        .hero-gradient {
            background: linear-gradient(135deg, var(--primary) 0%, #2c5282 100%);
        }
        
        .feature-card {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            border-bottom: 4px solid transparent;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-bottom-color: var(--secondary);
        }
        
        .ticket-row {
            transition: all 0.2s ease;
        }
        
        .ticket-row:hover {
            background-color: rgba(246, 173, 85, 0.1) !important;
        }
        
        .vip-badge {
            background: linear-gradient(135deg, #f6e05e 0%, #d69e2e 100%);
        }
        
        .nav-shadow {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--secondary) 0%, #c53030 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(229, 62, 62, 0.3);
        }
        
        .btn-secondary {
            transition: all 0.3s ease;
            border: 1px solid var(--primary);
        }
        
        .btn-secondary:hover {
            background-color: var(--primary);
            color: white;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans min-h-screen flex flex-col antialiased">
    <!-- Navigation -->
    <nav class="w-full bg-white nav-shadow sticky top-0 z-50" data-animate="fade-in">
        <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/picture.jpg') }}" class="w-12 h-12" alt="Santiago Bernabeu Logo">
                <span class="text-2xl font-bold bg-gradient-to-r from-blue-900 to-blue-600 bg-clip-text text-transparent">Santiago Bernabeu</span>
            </div>
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-primary text-white px-5 py-2 rounded-full font-medium text-sm">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary text-white px-5 py-2 rounded-full font-medium text-sm">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-secondary px-5 py-2 rounded-full font-medium text-sm">Register</a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-gradient text-white py-20 px-6 text-center" data-animate="slide-up" data-delay="100">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">Experience Football Like Never Before</h1>
            <p class="text-xl md:text-2xl font-light mb-8 opacity-90">Premium football viewing at Santiago Bernabeu's state-of-the-art watching hall</p>
           
        </div>
    </header>

    <!-- Features Section -->
    <section id="features" class="py-16 bg-white" data-animate="slide-up" data-delay="150">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12">
                <span class="text-sm font-semibold tracking-wider text-blue-600 uppercase">Premium Experience</span>
                <h2 class="text-3xl md:text-4xl font-bold mt-2 text-gray-900">Why Choose Our Venue?</h2>
                <p class="max-w-2xl mx-auto mt-4 text-gray-600">We've created the ultimate environment for football enthusiasts to enjoy matches in comfort and style.</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Comfortable Seats -->
                <div class="feature-card bg-white p-8 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-couch text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Luxury Seating</h3>
                    <p class="text-gray-600">Ergonomic, padded seats with ample legroom for maximum comfort during matches.</p>
                </div>

                <!-- Standby Generator -->
                <div class="feature-card bg-white p-8 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-bolt text-red-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Uninterrupted Power</h3>
                    <p class="text-gray-600">500KVA standby generator ensures no interruption to your viewing experience.</p>
                </div>

                <!-- Climate Control -->
                <div class="feature-card bg-white p-8 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-fan text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Climate Control</h3>
                    <p class="text-gray-600">Advanced AC system and industrial fans maintain perfect temperature year-round.</p>
                </div>

                <!-- Big Screens -->
                <div class="feature-card bg-white p-8 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-purple-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-tv text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">4K Ultra HD</h3>
                    <p class="text-gray-600">Massive 150-inch screens with crystal clear 4K resolution and surround sound.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Ticket Table Section -->
    <main id="tickets" class="flex-grow w-full max-w-5xl mx-auto px-6 py-16" data-animate="scale-in" data-delay="200">
        <div class="text-center mb-12">
            <span class="text-sm font-semibold tracking-wider text-blue-600 uppercase">Pricing</span>
            <h2 class="text-3xl md:text-4xl font-bold mt-2 text-gray-900">Ticket Options</h2>
            <p class="max-w-2xl mx-auto mt-4 text-gray-600">Choose the experience that matches your preference and budget</p>
        </div>
        
        <div class="overflow-x-auto bg-white rounded-xl shadow-md overflow-hidden">
            <table class="w-full table-auto">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-8 py-4 font-semibold text-gray-700 uppercase tracking-wider">Class</th>
                        <th class="px-8 py-4 font-semibold text-gray-700 uppercase tracking-wider">Description</th>
                        <th class="px-8 py-4 font-semibold text-gray-700 uppercase tracking-wider text-right">Price (TZS)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($tickets as $ticket)
                        @php
                            $isVip = strtolower($ticket->name) === 'vip';
                            $icon = $isVip ? 'fa-crown' : 'fa-ticket-alt';
                            $textColor = $isVip ? 'text-yellow-600' : 'text-blue-600';
                            $bgColor = $isVip ? 'bg-yellow-50' : 'bg-blue-50';
                        @endphp
                        <tr class="ticket-row {{ $bgColor }}" data-animate="fade-in" data-delay="{{ 300 + ($loop->index * 100) }}">
                            <td class="px-8 py-6 font-medium">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full {{ $isVip ? 'vip-badge' : 'bg-blue-100' }} flex items-center justify-center mr-4">
                                        <i class="fas {{ $icon }} {{ $textColor }}"></i>
                                    </div>
                                    <div>
                                        <div class="text-lg font-semibold {{ $textColor }}">{{ $ticket->name }}</div>
                                        @if($isVip)
                                            <span class="inline-block mt-1 px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Premium</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-gray-600">
                                {{ $ticket->description ?? 'Standard viewing experience' }}
                            </td>
                            <td class="px-8 py-6 text-right">
                                <span class="text-xl font-bold text-gray-900">
                                    {{ $ticket->price ? number_format($ticket->price->price, 0) : 'N/A' }}
                                </span>
                                @if($loop->first)
                                    <span class="block text-sm text-green-600 font-medium mt-1">Most Popular</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>


    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Santiago Bernabeu</h3>
                    <p class="text-gray-400">Premium football watching experience with world-class amenities and service.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Home</a></li>
                        <li><a href="#features" class="text-gray-400 hover:text-white transition">Features</a></li>
                        <li><a href="#tickets" class="text-gray-400 hover:text-white transition">Tickets</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">About Us</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center"><i class="fas fa-map-marker-alt mr-2"></i> Bomang'ombe HAI</li>
                        <li class="flex items-center"><i class="fas fa-phone-alt mr-2"></i> +255 626 389 969</li>
                        <li class="flex items-center"><i class="fas fa-envelope mr-2"></i> info@santiagobernabeu.com</li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-blue-600 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-blue-400 transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-pink-600 transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-red-600 transition">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-500">
                <p>© {{ date('Y') }} Santiago Bernabeu. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all elements with data-animate attribute
            const animatedElements = document.querySelectorAll('[data-animate]');
            
            // Function to add animation class
            function animateElements() {
                animatedElements.forEach(element => {
                    const animationClass = element.getAttribute('data-animate');
                    const delay = element.getAttribute('data-delay') || 0;
                    
                    // Set timeout based on delay attribute
                    setTimeout(() => {
                        element.classList.add(animationClass);
                    }, delay);
                });
            }
            
            // Start animations after a short delay to allow preloader to finish
            setTimeout(animateElements, 300);
            
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    if(targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if(targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>