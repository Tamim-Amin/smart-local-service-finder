<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Provider Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if(!$service)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center py-12">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Welcome, {{ auth()->user()->name }}!</h3>
                        <p class="text-gray-600 mb-6">You haven't set up your service profile yet. Create one to start accepting bookings.</p>
                        <a href="{{ route('provider.services.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Create Service Profile
                        </a>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-gray-500 text-sm font-medium">Average Rating</div>
                        <div class="mt-2 flex items-baseline">
                            <span class="text-3xl font-bold text-gray-900">{{ $service->average_rating }}</span>
                            <span class="ml-2 text-sm text-gray-600">/ 5.0</span>
                        </div>
                    </div>
                    
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-gray-500 text-sm font-medium">Total Reviews</div>
                        <div class="mt-2 text-3xl font-bold text-gray-900">{{ $service->total_reviews }}</div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-gray-500 text-sm font-medium">Verification Status</div>
                        <div class="mt-2">
                            <span class="px-2 py-1 text-sm font-bold rounded 
                                {{ $service->verification_status === 'approved' ? 'bg-green-100 text-green-800' : 
                                   ($service->verification_status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ ucfirst($service->verification_status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">My Service Profile</h3>
                            <div class="space-y-4">
                                <p class="text-sm text-gray-600"><span class="font-bold">Category:</span> {{ $service->category->name }}</p>
                                <p class="text-sm text-gray-600"><span class="font-bold">Hourly Rate:</span> ${{ number_format($service->hourly_rate, 2) }}</p>
                                <p class="text-sm text-gray-600"><span class="font-bold">Status:</span> {{ ucfirst($service->availability_status) }}</p>
                                
                                <div class="pt-4 flex gap-4">
                                    <a href="{{ route('provider.services.edit', $service) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit Profile &rarr;</a>
                                    <a href="{{ route('services.show', $service) }}" class="text-gray-600 hover:text-gray-900 font-medium">View as Public &rarr;</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Bookings Management</h3>
                            <p class="text-gray-600 mb-6">View pending requests, manage upcoming appointments, and track your history.</p>
                            
                            <a href="{{ route('provider.bookings') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Go to Bookings
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>