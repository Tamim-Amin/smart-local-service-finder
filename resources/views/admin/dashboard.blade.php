<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-xs font-bold uppercase">Total Users</div>
                    <div class="text-3xl font-bold text-gray-800">{{ $stats['total_users'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-xs font-bold uppercase">Providers</div>
                    <div class="text-3xl font-bold text-indigo-600">{{ $stats['total_providers'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-xs font-bold uppercase">Pending Verifications</div>
                    <div class="text-3xl font-bold text-orange-500">{{ $stats['pending_verifications'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-xs font-bold uppercase">Total Bookings</div>
                    <div class="text-3xl font-bold text-green-600">{{ $stats['total_bookings'] }}</div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('admin.users.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Manage Users</h5>
                    <p class="font-normal text-gray-700">Block/Unblock users and view user details.</p>
                </a>
                <a href="{{ route('admin.categories.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Categories</h5>
                    <p class="font-normal text-gray-700">Add or edit service categories.</p>
                </a>
                <a href="{{ route('admin.verifications.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Verifications</h5>
                    <p class="font-normal text-gray-700">Approve or reject provider service profiles.</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>