<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Service Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('services.index', ['category' => $category->id]) }}" 
                       class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow duration-300 group">
                        <div class="p-6 text-center">
                            <div class="text-4xl mb-4 group-hover:scale-110 transition-transform duration-300">
                                🛠️
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors">
                                {{ $category->name }}
                            </h3>
                            <p class="text-sm text-gray-500 line-clamp-2">
                                {{ $category->description ?? 'Find professionals in ' . $category->name }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>