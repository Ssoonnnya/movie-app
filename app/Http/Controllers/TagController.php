<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_uk' => 'required|string',
            'name_en' => 'required|string',
            'slug' => 'nullable|string|unique:tags',
        ]);

        Tag::create([
            'name_uk' => $validated['name_uk'],
            'name_en' => $validated['name_en'],
            'slug' => $validated['slug'] ?? Str::slug($validated['name_en']),
        ]);

        return redirect()->route('tags.index');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index');
    }}
