<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class UserFilmController extends Controller
{
    public function index()
    {
        $films = Film::paginate(10);

        return view('dashboard', compact('films'));
    }
    public function show($id)
    {
        $film = Film::with('cast')->findOrFail($id);
        $film->load('tags');

        if ($film->status === 'hide') {
            abort(404);
        }
        return view('user.films.show', compact('film'));
    }
}
