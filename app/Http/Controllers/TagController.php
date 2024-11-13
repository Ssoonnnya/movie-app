<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function createForFilm(Film $film)
    {
        return view('admin.tags.create', compact('film'));
    }

    public function storeForFilm(Request $request, Film $film)
    {
        $request->validate([
            'name_uk' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);

        $slug = $request->input('slug') ?: Str::slug($request->input('name_en'));

        $tag = Tag::create([
            'name_uk' => $request->input('name_uk'),
            'name_en' => $request->input('name_en'),
            'slug' => $slug,
            'film_id' => $film->id,
        ]);

        $film->tags()->attach($tag->id);

        return redirect()->route('admin.films.index')->with('success', 'Tag added successfully');
    }
    public function delete(Tag $tag)
    {
        $tag->films()->detach();

        $tag->delete();

        return redirect()->back()->with('success', 'Tag deleted successfully');
    }
}
