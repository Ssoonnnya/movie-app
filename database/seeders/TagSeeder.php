<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Film;
use App\Models\Tag;
use Faker\Factory as Faker;

class TagSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();


        $films = Film::all();

        foreach ($films as $film) {

            foreach (range(1, rand(1, 3)) as $index) {
                $tag = Tag::create([
                    'name_uk' => $faker->word,
                    'name_en' => $faker->word,
                    'slug' => $faker->slug,
                    'film_id' => $film->id,
                ]);
            }
        }
    }
}
