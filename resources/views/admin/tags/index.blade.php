<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Tags') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Add New Tag Form -->
                    <form action="{{ route('tags.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name_uk" class="block text-sm font-medium text-gray-700">Ukrainian Name</label>
                            <input type="text" id="name_uk" name="name_uk" class="mt-1 block w-full border-gray-300 rounded-md" required>
                        </div>

                        <div class="mb-4">
                            <label for="name_en" class="block text-sm font-medium text-gray-700">English Name</label>
                            <input type="text" id="name_en" name="name_en" class="mt-1 block w-full border-gray-300 rounded-md" required>
                        </div>

                        <div class="mb-4">
                            <label for="slug" class="block text-sm font-medium text-gray-700">Slug (Optional)</label>
                            <input type="text" id="slug" name="slug" class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>

                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Add Tag</button>
                    </form>

                    <!-- Tags List -->
                    <div class="mt-8">
                        <h3 class="text-xl font-semibold mb-4">Existing Tags</h3>
                        @if($tags->count() > 0)
                            <ul>
                                @foreach ($tags as $tag)
                                    <li class="flex justify-between items-center mb-2">
                                        <span>{{ $tag->name_uk }} / {{ $tag->name_en }}</span>
                                        <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tag?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white py-1 px-2 rounded">Delete</button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No tags found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
