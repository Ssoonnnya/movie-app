<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Film') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-semibold mb-4">Редагувати фільм</h1>

                    <form action="{{ route('admin.films.update', $film) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title_uk" class="block text-sm font-medium text-gray-700">Title (Ukrainian):</label>
                            <input type="text" id="title_uk" name="title_uk" value="{{ old('title_uk', $film->title_uk) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="title_en" class="block text-sm font-medium text-gray-700">Title (English):</label>
                            <input type="text" id="title_en" name="title_en" value="{{ old('title_en', $film->title_en) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="description_uk" class="block text-sm font-medium text-gray-700">Description (Ukrainian):</label>
                            <textarea id="description_uk" name="description_uk" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>{{ old('description_uk', $film->description_uk) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="description_en" class="block text-sm font-medium text-gray-700">Description (English):</label>
                            <textarea id="description_en" name="description_en" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>{{ old('description_en', $film->description_en) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="poster" class="block text-sm font-medium text-gray-700">Poster:</label>
                            <input type="file" id="poster" name="poster" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @if($film->poster)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $film->poster) }}" alt="Current Poster" class="w-32 h-auto">
                                </div>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label for="screenshots" class="block text-sm font-medium text-gray-700">Screenshots:</label>
                            <input type="file" id="screenshots" name="screenshots[]" multiple class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @if($film->screenshots)
                                <div class="mt-2">
                                    @foreach(json_decode($film->screenshots, true) as $screenshot)
                                        <img src="{{ asset('storage/' . $screenshot) }}" alt="Screenshot" class="w-32 h-auto mt-2">
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label for="youtube_trailer_id" class="block text-sm font-medium text-gray-700">YouTube Trailer ID:</label>
                            <input type="text" id="youtube_trailer_id" name="youtube_trailer_id" value="{{ old('youtube_trailer_id', $film->youtube_trailer_id) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="release_year" class="block text-sm font-medium text-gray-700">Release Year:</label>
                            <input type="number" id="release_year" name="release_year" value="{{ old('release_year', $film->release_year) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
                            <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <option value="show" {{ old('status', $film->status) == 'show' ? 'selected' : '' }}>Show</option>
                                <option value="hide" {{ old('status', $film->status) == 'hide' ? 'selected' : '' }}>Hide</option>
                            </select>
                        </div>

                        <h2 class="text-xl font-semibold mt-6">Edit Cast</h2>

                        @foreach ($film->cast as $index => $cast)
                            <div class="mb-4 border-t border-gray-300 pt-4">
                                <h3 class="text-lg font-medium">Cast Member #{{ $index + 1 }}</h3>

                                <input type="hidden" name="casts[{{ $index }}][id]" value="{{ $cast->id }}">

                                <label class="block text-sm font-medium text-gray-700">Role:</label>
                                <select name="casts[{{ $index }}][role]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
                                    <option value="director" {{ $cast->role == 'director' ? 'selected' : '' }}>Director</option>
                                    <option value="screenwriter" {{ $cast->role == 'screenwriter' ? 'selected' : '' }}>Screenwriter</option>
                                    <option value="actor" {{ $cast->role == 'actor' ? 'selected' : '' }}>Actor</option>
                                    <option value="composer" {{ $cast->role == 'composer' ? 'selected' : '' }}>Composer</option>
                                </select>

                                <label class="block text-sm font-medium text-gray-700">Name (Ukrainian):</label>
                                <input type="text" name="casts[{{ $index }}][name_uk]" value="{{ $cast->name_uk }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm" required>

                                <label class="block text-sm font-medium text-gray-700">Name (English):</label>
                                <input type="text" name="casts[{{ $index }}][name_en]" value="{{ $cast->name_en }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm" required>

                                <label class="block text-sm font-medium text-gray-700">Photo:</label>
                                <input type="file" name="casts[{{ $index }}][photo]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
                                @if($cast->photo)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $cast->photo) }}" alt="Current Photo" class="w-16 h-auto">
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary">Update Film</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
