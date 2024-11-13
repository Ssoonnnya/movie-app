<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Films') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-semibold mb-4">{{ __('Film Catalog') }}</h1>

                    <!-- Links for changing language -->

                    <a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">English</a>
                    <a href="{{ LaravelLocalization::getLocalizedURL('uk', null, [], true) }}">Українська</a>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($films as $film)
                            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                                <!-- Poster Image -->
                                <div class="h-48 w-full bg-gray-200 flex items-center justify-center">
                                    <img src="{{ asset('storage/' . $film->poster) }}" alt="Poster" class="object-cover w-full h-full">
                                </div>

                                <!-- Film Details -->
                                <div class="p-4">
                                    <h3 class="text-xl font-semibold mb-2">
                                        <a href="{{ route('films.show', $film->id) }}">{{ $film->title }}</a>
                                    </h3>
                                    <p class="text-sm text-gray-600 mb-4">Рік випуску: <span class="font-medium">{{ $film->release_year }}</span></p>

                                    <!-- Screenshots -->
                                    @php
                                        $screenshots = is_array($film->screenshots) ? $film->screenshots : json_decode($film->screenshots, true);
                                    @endphp

                                    @if($screenshots && count($screenshots) > 0)
                                        <div class="flex gap-4 mb-4">
                                            @foreach ($screenshots as $screenshot)
                                                <img src="{{ asset('storage/' . $screenshot) }}" alt="Screenshot" class="w-1/4 h-auto">
                                            @endforeach
                                        </div>
                                    @else
                                        <p>No screenshots available.</p>
                                    @endif

                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $films->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
