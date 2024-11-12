<?php

namespace App\Http\Controllers;namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Cast;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function index()
    {
        $films = Film::paginate(10);

        return view('admin-dashboard', compact('films'));
    }

    public function create()
    {
        return view('admin.films.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_uk' => 'required|string',
            'title_en' => 'required|string',
            'description_uk' => 'required|string',
            'description_en' => 'required|string',
            'poster' => 'required|image',
            'screenshots.*' => 'image',
            'youtube_trailer_id' => 'required|string',
            'release_year' => 'required|integer',
            'status' => 'required|in:show,hide',
            'casts' => 'array',
            'casts.*.role' => 'required|string',
            'casts.*.name_uk' => 'required|string',
            'casts.*.name_en' => 'required|string',
            'casts.*.photo' => 'nullable|image',
        ]);

        if ($request->hasFile('poster')) {
            $validated['poster'] = $request->file('poster')->store('posters', 'public');
        }

        if ($request->hasFile('screenshots')) {
            $validated['screenshots'] = array_map(function ($file) {
                return $file->store('screenshots', 'public');
            }, $request->file('screenshots'));
            $validated['screenshots'] = json_encode($validated['screenshots']);
        }

        $film = Film::create($validated);

        if ($request->has('casts')) {
            foreach ($request->input('casts') as $castData) {

                $cast = new Cast([
                    'role' => $castData['role'],
                    'name_uk' => $castData['name_uk'],
                    'name_en' => $castData['name_en'],
                ]);

                if (isset($castData['photo'])) {
                    $cast->photo = $castData['photo']->store('cast_photos', 'public');
                }

                $film->cast()->save($cast);
            }
        }

        return redirect()->route('admin.films.index');
    }

    public function edit(Film $film)
    {
        return view('admin.films.edit', compact('film'));
    }

    public function update(Request $request, Film $film)
    {
        $validated = $request->validate([
            'title_uk' => 'required|string',
            'title_en' => 'required|string',
            'description_uk' => 'required|string',
            'description_en' => 'required|string',
            'poster' => 'nullable|image',
            'screenshots.*' => 'image',
            'youtube_trailer_id' => 'required|string',
            'release_year' => 'required|integer',
            'status' => 'required|in:show,hide',
            'casts' => 'array',
            'casts.*.role' => 'required|string',
            'casts.*.name_uk' => 'required|string',
            'casts.*.name_en' => 'required|string',
            'casts.*.photo' => 'nullable|image',
        ]);

        $film->update($validated);

        if ($request->hasFile('poster')) {
            $film->poster = $request->file('poster')->store('public/posters');
        }

        if ($request->hasFile('screenshots')) {
            $film->screenshots = array_map(function ($file) {
                return $file->store('public/screenshots');
            }, $request->file('screenshots'));
            $film->screenshots = json_encode($film->screenshots);
        }

        $film->save();

        if ($request->has('casts')) {
            foreach ($request->input('casts') as $castData) {

                if (isset($castData['id'])) {
                    $cast = Cast::find($castData['id']);
                    $cast->update([
                        'role' => $castData['role'],
                        'name_uk' => $castData['name_uk'],
                        'name_en' => $castData['name_en'],
                    ]);

                    if (isset($castData['photo'])) {
                        $cast->photo = $castData['photo']->store('cast_photos', 'public');
                    }
                } else {
                    $cast = new Cast([
                        'role' => $castData['role'],
                        'name_uk' => $castData['name_uk'],
                        'name_en' => $castData['name_en'],
                    ]);

                    if (isset($castData['photo'])) {
                        $cast->photo = $castData['photo']->store('cast_photos', 'public');
                    }

                    $film->casts()->save($cast);
                }
            }
        }

        return redirect()->route('admin.films.index');
    }


    public function destroy(Film $film)
    {
        $film->delete();
        return redirect()->route('admin.films.index');
    }
}

