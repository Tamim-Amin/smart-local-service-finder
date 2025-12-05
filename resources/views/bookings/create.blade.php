<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Book Service: {{ $service->category->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="mb-6 border-b pb-4">
                        <p class="text-sm text-gray-500">Provider</p>
                        <p class="font-bold text-lg">{{ $service->user->name }}</p>
                        <p class="text-sm text-gray-600">Rate: ${{ $service->hourly_rate }}/hr</p>
                    </div>

                    <form method="POST" action="{{ route('customer.bookings.store') }}">
                        @csrf
                        <input type="hidden" name="service_id" value="{{ $service->id }}">

                        <div class="mb-4">
                            <x-input-label for="problem_description" :value="__('Describe the Issue / Task')" />
                            <textarea id="problem_description" name="problem_description" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="4" required>{{ old('problem_description') }}</textarea>
                            <x-input-error :messages="$errors->get('problem_description')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="preferred_date" :value="__('Preferred Date')" />
                                <x-text-input id="preferred_date" class="block mt-1 w-full" type="date" name="preferred_date" :value="old('preferred_date')" min="{{ date('Y-m-d') }}" required />
                                <x-input-error :messages="$errors->get('preferred_date')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="preferred_time" :value="__('Preferred Time')" />
                                <x-text-input id="preferred_time" class="block mt-1 w-full" type="time" name="preferred_time" :value="old('preferred_time')" required />
                                <x-input-error :messages="$errors->get('preferred_time')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-6">
                            <x-input-label for="customer_location" :value="__('Your Address')" />
                            <x-text-input id="customer_location" class="block mt-1 w-full" type="text" name="customer_location" :value="old('customer_location', auth()->user()->address)" required placeholder="House No, Street, Area..." />
                            <x-input-error :messages="$errors->get('customer_location')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ url()->previous() }}" class="text-sm text-gray-600 underline mr-4">Cancel</a>
                            <x-primary-button class="ml-4">
                                {{ __('Confirm Booking Request') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>