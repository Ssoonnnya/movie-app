<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Film;
use App\Models\Cast;
use Faker\Factory as Faker;

class FilmSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {

            $film = Film::create([
                'title_uk' => $faker->sentence,
                'title_en' => $faker->sentence,
                'description_uk' => $faker->paragraph,
                'description_en' => $faker->paragraph,
                'poster' => 'posters/' . $faker->image(storage_path('app/public/posters'), 640, 480, null, false),
                'screenshots' => json_encode(['screenshots/' . $faker->image(storage_path('app/public/screenshots'), 640, 480, null, false)]),
                'youtube_trailer_id' => $faker->word,
                'release_year' => $faker->year,
                'status' => $faker->randomElement(['show', 'hide']),
            ]);

            foreach (range(1, rand(3, 5)) as $castIndex) {
                Cast::create([
                    'film_id' => $film->id,
                    'role' => $faker->randomElement(['director', 'screenwriter', 'actor', 'composer']),
                    'name_uk' => $faker->name,
                    'name_en' => $faker->name,
                    'photo' => 'casts/' . $faker->image(storage_path('app/public/casts'), 640, 480, null, false),
                ]);
            }
        }
    }
}
