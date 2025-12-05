<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->user->name }}'s Service
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="md:col-span-2 space-y-6">
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-2xl font-bold text-gray-900">{{ $service->category->name }} Service</h3>
                            <span class="bg-indigo-100 text-indigo-800 text-sm font-medium px-3 py-1 rounded-full">
                                {{ ucfirst($service->availability_status) }}
                            </span>
                        </div>
                        
                        <div class="prose max-w-none text-gray-600 mb-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">About this Service</h4>
                            <p>{{ $service->bio }}</p>
                        </div>

                        <div class="border-t pt-4">
                            <h4 class="text-lg font-semibold text-gray-900 mb-3">Skills & Expertise</h4>
                            <div class="flex flex-wrap gap-2">
                                @if($service->skills)
                                    @foreach($service->skills as $skill)
                                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                                            {{ $skill }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="text-gray-500 italic">No specific skills listed.</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Reviews ({{ $service->total_reviews }})</h3>
                        
                        @forelse($service->reviews as $review)
                            <div class="border-b last:border-0 py-4">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-semibold">{{ $review->customer->name }}</span>
                                    <span class="text-yellow-500 font-bold">★ {{ $review->rating }}</span>
                                </div>
                                <p class="text-gray-600">{{ $review->review_text }}</p>
                                <span class="text-xs text-gray-400 block mt-2">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                        @empty
                            <p class="text-gray-500 italic">No reviews yet.</p>
                        @endforelse
                    </div>
                </div>

                <div class="md:col-span-1">
                    <div class="bg-white p-6 rounded-lg shadow-sm sticky top-6">
                        <div class="text-center mb-6">
                            <span class="block text-gray-500 text-sm">Hourly Rate</span>
                            <span class="text-3xl font-bold text-gray-900">${{ number_format($service->hourly_rate, 2) }}</span>
                        </div>

                        <div class="space-y-4 mb-6 text-sm text-gray-600">
                            <div class="flex justify-between border-b pb-2">
                                <span>Location</span>
                                <span class="font-medium text-right">{{ $service->location }}</span>
                            </div>
                            <div class="flex justify-between border-b pb-2">
                                <span>Experience</span>
                                <span class="font-medium text-right">{{ $service->years_of_experience }} Years</span>
                            </div>
                            <div class="flex justify-between border-b pb-2">
                                <span>Member Since</span>
                                <span class="font-medium text-right">{{ $service->created_at->format('M Y') }}</span>
                            </div>
                        </div>

                        @auth
                            @if(auth()->user()->role === 'customer')
                                <a href="{{ route('customer.bookings.create', $service) }}" 
                                   class="block w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded transition">
                                    Book Now
                                </a>
                            @elseif(auth()->id() === $service->user_id)
                                <a href="{{ route('provider.services.edit', $service) }}" 
                                   class="block w-full text-center bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-4 rounded transition">
                                    Edit Service
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="block w-full text-center bg-gray-800 hover:bg-gray-900 text-white font-bold py-3 px-4 rounded transition">
                                Login to Book
                            </a>
                        @endauth
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>