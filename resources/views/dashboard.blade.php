<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Overview') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-500">
                    <div class="text-sm text-gray-500 uppercase font-bold">Total Links</div>
                    <div class="text-3xl font-bold text-gray-800">{{ Auth::user()->links()->count() }}</div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-green-500">
                    <div class="text-sm text-gray-500 uppercase font-bold">Categories Used</div>
                    <div class="text-3xl font-bold text-gray-800">{{ \App\Models\Category::count() }}</div>
                </div>

                <div class="bg-indigo-600 p-6 rounded-lg shadow-sm flex items-center justify-center">
                    <a href="{{ route('links.create') }}" class="text-white font-bold text-lg hover:underline">
                        + Add New Bookmark
                    </a>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-2">Welcome back, {{ Auth::user()->name }}!</h3>
                    <p class="text-gray-600">You can manage your saved links by clicking on <a href="{{ route('links.index') }}" class="text-indigo-600 font-bold hover:underline">My Links</a> in the navigation menu.</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>