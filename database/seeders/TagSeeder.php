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

        foreach (range(1, 10) as $index) {
            $tag = Tag::create([
                'name_uk' => $faker->word,
                'name_en' => $faker->word,
                'slug' => $faker->slug,
            ]);
        }

        $films = Film::all();

        foreach ($films as $film) {

            $tags = Tag::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $film->tags()->attach($tags);
        }
    }
}
