<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Smart Local Service Finder') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans text-gray-900 bg-gray-50">

    <nav class="bg-white shadow-sm fixed w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center gap-2">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-indigo-600 tracking-tighter flex items-center gap-2">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        ServiceFinder
                    </a>
                </div>

                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('services.index') }}" class="text-gray-600 hover:text-indigo-600 font-medium transition">Find Services</a>
                    <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-indigo-600 font-medium transition">Categories</a>
                    
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-indigo-600 text-white px-5 py-2 rounded-full font-medium hover:bg-indigo-700 transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600 font-medium transition">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-5 py-2 rounded-full font-medium hover:bg-indigo-700 transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                    Get Started
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="relative pt-24 pb-12 md:pt-32 md:pb-24 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 right-0 w-1/2 h-full bg-indigo-50/50 skew-x-12 transform origin-top-right"></div>
            <div class="absolute bottom-0 left-0 w-1/3 h-2/3 bg-blue-50/50 -skew-x-12 transform origin-bottom-left"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 tracking-tight mb-6">
                Find Trusted <span class="text-indigo-600">Local Professionals</span><br class="hidden md:block"> for Any Job
            </h1>
            <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500 mb-10">
                From home repairs to cleaning, connect with verified experts in your area. Fast, reliable, and secure.
            </p>

            <div class="max-w-3xl mx-auto bg-white p-4 rounded-2xl shadow-xl border border-gray-100">
                <form action="{{ route('services.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-grow relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <input type="text" name="location" placeholder="Enter your city or zip code" class="w-full pl-10 pr-4 py-3 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50 focus:bg-white transition" required>
                    </div>
                    
                    <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Search
                    </button>
                </form>
            </div>
            
            <div class="mt-8 flex justify-center gap-4 text-sm text-gray-500">
                <span>Popular:</span>
                <a href="{{ route('services.index', ['category' => '1']) }}" class="hover:text-indigo-600 underline">Plumbing</a>
                <a href="{{ route('services.index', ['category' => '2']) }}" class="hover:text-indigo-600 underline">Cleaning</a>
                <a href="{{ route('services.index', ['category' => '3']) }}" class="hover:text-indigo-600 underline">Electrical</a>
            </div>
        </div>
    </div>

    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 rounded-2xl bg-gray-50 hover:bg-indigo-50 transition duration-300">
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600 mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Verified Professionals</h3>
                    <p class="text-gray-600">Every service provider is vetted to ensure high-quality and reliable service for your peace of mind.</p>
                </div>

                <div class="p-6 rounded-2xl bg-gray-50 hover:bg-indigo-50 transition duration-300">
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600 mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Instant Booking</h3>
                    <p class="text-gray-600">Check availability in real-time and book appointments that fit your schedule perfectly.</p>
                </div>

                <div class="p-6 rounded-2xl bg-gray-50 hover:bg-indigo-50 transition duration-300">
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600 mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Rated & Reviewed</h3>
                    <p class="text-gray-600">Read reviews from real neighbors to choose the best expert for your specific needs.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gray-900 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Are you a Service Professional?</h2>
            <p class="text-gray-400 max-w-2xl mx-auto mb-8 text-lg">
                Join thousands of providers growing their business with ServiceFinder. Get access to new customers and manage your bookings effortlessly.
            </p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-8 py-3 rounded-full font-bold hover:bg-indigo-500 transition shadow-lg">
                    Join as a Pro
                </a>
                <a href="{{ route('login') }}" class="bg-transparent border border-gray-600 text-white px-8 py-3 rounded-full font-bold hover:bg-gray-800 transition">
                    Provider Login
                </a>
            </div>
        </div>
    </div>

    <footer class="bg-white border-t border-gray-100 pt-12 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <span class="text-xl font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        ServiceFinder
                    </span>
                    <p class="text-gray-500 text-sm mt-2">Connecting you with local experts since 2025.</p>
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-gray-900">About</a>
                    <a href="#" class="text-gray-400 hover:text-gray-900">Privacy</a>
                    <a href="#" class="text-gray-400 hover:text-gray-900">Terms</a>
                    <a href="#" class="text-gray-400 hover:text-gray-900">Contact</a>
                </div>
            </div>
            <div class="mt-8 text-center text-gray-400 text-sm">
                &copy; {{ date('Y') }} Smart Local Service Finder. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>