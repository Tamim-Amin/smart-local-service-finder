<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Bookings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if(session('success'))
                        <div class="bg-green-100 border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Details</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($bookings as $booking)
                                    <tr>
                                        <td class="px-6 py-4">
                                            <div class="font-bold">{{ $booking->customer->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $booking->customer_location }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-bold">{{ $booking->preferred_date->format('M d') }} at {{ $booking->preferred_time }}</div>
                                            <p class="text-sm text-gray-600 mt-1 italic">"{{ Str::limit($booking->problem_description, 50) }}"</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $booking->status === 'accepted' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $booking->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $booking->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium">
                                            <div class="flex space-x-2">
                                                @if($booking->status === 'pending')
                                                    <form action="{{ route('provider.bookings.accept', $booking) }}" method="POST">
                                                        @csrf
                                                        <button class="text-blue-600 hover:text-blue-900">Accept</button>
                                                    </form>
                                                    <form action="{{ route('provider.bookings.reject', $booking) }}" method="POST">
                                                        @csrf
                                                        <button class="text-red-600 hover:text-red-900">Reject</button>
                                                    </form>
                                                @elseif($booking->status === 'accepted')
                                                    <form action="{{ route('provider.bookings.complete', $booking) }}" method="POST">
                                                        @csrf
                                                        <button class="text-green-600 hover:text-green-900 font-bold">Mark Complete</button>
                                                    </form>
                                                @else
                                                    <span class="text-gray-400">Closed</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No bookings found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">{{ $bookings->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>