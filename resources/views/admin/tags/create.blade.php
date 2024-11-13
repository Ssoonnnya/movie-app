<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Tag to Film') }}: {{ $film->title_uk }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-semibold mb-4">Add Tag to Film</h1>

                    <form action="{{ route('films.tags.store', $film) }}" method="POST">
                        @csrf

                        <!-- Ukrainian Name -->
                        <div class="mb-4">
                            <label for="name_uk" class="block text-sm font-medium text-gray-700">Ukrainian Name</label>
                            <input type="text" id="name_uk" name="name_uk" class="mt-1 block w-full border-gray-300 rounded-md" required>
                        </div>

                        <!-- English Name -->
                        <div class="mb-4">
                            <label for="name_en" class="block text-sm font-medium text-gray-700">English Name</label>
                            <input type="text" id="name_en" name="name_en" class="mt-1 block w-full border-gray-300 rounded-md" required>
                        </div>

                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Add Tag</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
