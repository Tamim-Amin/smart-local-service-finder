<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Available Services') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 p-6">
                <form method="GET" action="{{ route('services.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    
                    <div>
                        <x-input-label for="category" :value="__('Category')" />
                        <select name="category" id="category" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="location" :value="__('Location')" />
                        <x-text-input id="location" class="block w-full" type="text" name="location" :value="request('location')" placeholder="Enter city or area" />
                    </div>

                    <div>
                        <x-input-label for="min_rating" :value="__('Min Rating')" />
                        <select name="min_rating" id="min_rating" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">Any Rating</option>
                            <option value="3" {{ request('min_rating') == '3' ? 'selected' : '' }}>3+ Stars</option>
                            <option value="4" {{ request('min_rating') == '4' ? 'selected' : '' }}>4+ Stars</option>
                            <option value="5" {{ request('min_rating') == '5' ? 'selected' : '' }}>5 Stars</option>
                        </select>
                    </div>

                    <div class="flex items-end">
                        <x-primary-button class="w-full justify-center">
                            {{ __('Search') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($services as $service)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow duration-300">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                    {{ $service->category->name }}
                                </span>
                                <span class="text-yellow-500 font-bold flex items-center">
                                    ★ {{ $service->average_rating }}
                                    <span class="text-gray-400 text-sm font-normal ml-1">({{ $service->total_reviews }})</span>
                                </span>
                            </div>

                            <h3 class="text-xl font-bold text-gray-900 mb-2">
                                {{ $service->user->name }}
                            </h3>
                            
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ $service->bio }}
                            </p>

                            <div class="border-t pt-4 space-y-2 text-sm text-gray-600">
                                <div class="flex justify-between">
                                    <span>Rate:</span>
                                    <span class="font-semibold text-gray-900">${{ number_format($service->hourly_rate, 2) }}/hr</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Experience:</span>
                                    <span class="font-semibold text-gray-900">{{ $service->years_of_experience }} Years</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Location:</span>
                                    <span class="font-semibold text-gray-900">{{ $service->location }}</span>
                                </div>
                            </div>

                            <div class="mt-6">
                                <a href="{{ route('services.show', $service) }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 w-full">
                                    View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 bg-white rounded-lg shadow-sm">
                        <p class="text-gray-500 text-lg">No services found matching your criteria.</p>
                        <a href="{{ route('services.index') }}" class="text-indigo-600 hover:text-indigo-900 mt-2 inline-block">Clear Filters</a>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $services->links() }}
            </div>
        </div>
    </div>
</x-app-layout>