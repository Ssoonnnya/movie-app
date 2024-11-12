<x-app-layout>
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8 w-1/2">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Create a New Film</h2>

        <form action="{{ route('admin.films.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-8 rounded-lg shadow-lg">
            @csrf

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status:</label>
                <select name="status" id="status" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="show">Show</option>
                    <option value="hide">Hide</option>
                </select>
            </div>

            <div>
                <label for="title_uk" class="block text-sm font-medium text-gray-700 mb-2">Title (Ukrainian):</label>
                <input type="text" name="title_uk" id="title_uk" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="title_en" class="block text-sm font-medium text-gray-700 mb-2">Title (English):</label>
                <input type="text" name="title_en" id="title_en" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="description_uk" class="block text-sm font-medium text-gray-700 mb-2">Description (Ukrainian):</label>
                <textarea name="description_uk" id="description_uk" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required></textarea>
            </div>

            <div>
                <label for="description_en" class="block text-sm font-medium text-gray-700 mb-2">Description (English):</label>
                <textarea name="description_en" id="description_en" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required></textarea>
            </div>

            <div>
                <label for="poster" class="block text-sm font-medium text-gray-700 mb-2">Poster:</label>
                <input type="file" name="poster" id="poster" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="screenshots" class="block text-sm font-medium text-gray-700 mb-2">Screenshots:</label>
                <input type="file" name="screenshots[]" id="screenshots" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" multiple>
            </div>

            <div>
                <label for="youtube_trailer_id" class="block text-sm font-medium text-gray-700 mb-2">YouTube Trailer ID:</label>
                <input type="text" name="youtube_trailer_id" id="youtube_trailer_id" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="release_year" class="block text-sm font-medium text-gray-700 mb-2">Release Year:</label>
                <input type="number" name="release_year" id="release_year" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <!-- Fields for Casts -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Cast</h3>

                <div id="casts-container">
                    <div class="cast-entry space-y-4 mb-4">
                        <div>
                            <label for="casts[0][role]" class="block text-sm font-medium text-gray-700 mb-2">Role:</label>
                            <select name="casts[0][role]" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="director">Director</option>
                                <option value="screenwriter">Screenwriter</option>
                                <option value="actor">Actor</option>
                                <option value="composer">Composer</option>
                            </select>
                        </div>

                        <div>
                            <label for="casts[0][name_uk]" class="block text-sm font-medium text-gray-700 mb-2">Name (Ukrainian):</label>
                            <input type="text" name="casts[0][name_uk]" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>

                        <div>
                            <label for="casts[0][name_en]" class="block text-sm font-medium text-gray-700 mb-2">Name (English):</label>
                            <input type="text" name="casts[0][name_en]" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>

                        <div>
                            <label for="casts[0][photo]" class="block text-sm font-medium text-gray-700 mb-2">Photo:</label>
                            <input type="file" name="casts[0][photo]" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>

                <button type="button" onclick="addCast()" class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Add Another Cast
                </button>
            </div>

            <div>
                <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Create Film
                </button>
            </div>
        </form>
    </div>

    <script>
        let castCount = 1;

        function addCast() {
            const castContainer = document.getElementById('casts-container');
            const newCast = document.createElement('div');
            newCast.classList.add('cast-entry', 'space-y-4', 'mb-4');
            newCast.innerHTML = `
                <div>
                    <label for="casts[${castCount}][role]" class="block text-sm font-medium text-gray-700 mb-2">Role:</label>
                    <select name="casts[${castCount}][role]" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="director">Director</option>
                        <option value="screenwriter">Screenwriter</option>
                        <option value="actor">Actor</option>
                        <option value="composer">Composer</option>
                    </select>
                </div>
                <div>
                    <label for="casts[${castCount}][name_uk]" class="block text-sm font-medium text-gray-700 mb-2">Name (Ukrainian):</label>
                    <input type="text" name="casts[${castCount}][name_uk]" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div>
                    <label for="casts[${castCount}][name_en]" class="block text-sm font-medium text-gray-700 mb-2">Name (English):</label>
                    <input type="text" name="casts[${castCount}][name_en]" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div>
                    <label for="casts[${castCount}][photo]" class="block text-sm font-medium text-gray-700 mb-2">Photo:</label>
                    <input type="file" name="casts[${castCount}][photo]" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
            `;
            castContainer.appendChild(newCast);
            castCount++;
        }
    </script>
</x-app-layout>
