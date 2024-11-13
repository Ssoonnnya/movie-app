<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Film Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Links for changing language -->
                <a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">English</a>
                <a href="{{ LaravelLocalization::getLocalizedURL('uk', null, [], true) }}">Українська</a>

                <div class="p-6 text-gray-900">
                    <!-- Film Title -->
                    <h1 class="text-3xl font-semibold mb-4">{{ $film->title }}</h1>

                    <!-- Poster Image -->
                    <div class="h-96 w-full bg-gray-200 flex items-center justify-center mb-6">
                        <img src="{{ asset('storage/' . $film->poster) }}" alt="Poster" class="object-cover w-full h-full">
                    </div>

                    <!-- Film Details -->
                    <div class="mb-6">
                        <h3 class="text-xl font-semibold mb-2">{{ __('Description') }}:</h3>
                        <p>{{ $film->description }}</p>
                    </div>

                    <div class="mb-6">
                        <p class="text-sm text-gray-600 mb-1">{{ __('Release Year') }}: <span class="font-medium">{{ $film->release_year }}</span></p>
                    </div>

                    <!-- Cast -->
                    <div class="mb-6">
                        <h3 class="text-xl font-semibold mb-2">{{ __('Cast') }}:</h3>
                        @if($film->cast && count($film->cast) > 0)
                            <ul>
                                @foreach ($film->cast as $cast)
                                    <li class="mb-2">
                                        <p class="font-medium">{{ $cast->name }} ({{ $cast->role }})</p>
                                        @if ($cast->photo)
                                            <img src="{{ asset('storage/' . $cast->photo) }}" alt="{{ $cast->name }}" class="w-20 h-20 rounded-full mt-2">
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>{{ __('No cast information available.') }}</p>
                        @endif
                    </div>

                    <!-- Tags -->
                    <div class="mb-6">
                        <h3 class="text-xl font-semibold mb-2">{{ __('Tags') }}:</h3>
                        @if($film->tags && count($film->tags) > 0)
                            <ul class="flex gap-2">
                                @foreach ($film->tags as $tag)
                                    <li class="px-4 py-2 bg-gray-200 rounded-full">{{ $tag->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>{{ __('No tags available.') }}</p>
                        @endif
                    </div>

                    <!-- YouTube Trailer -->
                    <div class="mb-6">
                        <h3 class="text-xl font-semibold mb-2">{{ __('Trailer') }}:</h3>
                        @if($film->youtube_trailer_id)
                            <div class="aspect-w-16 aspect-h-9">
                                <iframe
                                    src="https://www.youtube.com/embed/{{ $film->youtube_trailer_id }}"
                                    title="YouTube trailer"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        @else
                            <p>{{ __('Trailer is not available.') }}</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
