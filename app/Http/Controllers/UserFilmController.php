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
    }}
