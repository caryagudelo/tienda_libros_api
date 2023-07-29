<?php

namespace App\Http\Controllers;

use App\Models\LiteraryGenre;
use Illuminate\Http\Request;

class LiteraryGenreController extends Controller
{
    public function index()
    {
        $literaryGenres = LiteraryGenre::all();
        return view('literary_genres.index', compact('literaryGenres'));
    }

    public function create()
    {
        return view('literary_genres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:literary_genres',
        ]);

        LiteraryGenre::create([
            'name' => $request->name,
        ]);

        return redirect()->route('literary_genres.index')->with('success', 'Literary genre created successfully.');
    }

    public function edit(LiteraryGenre $literaryGenre)
    {
        return view('literary_genres.edit', compact('literaryGenre'));
    }

    public function update(Request $request, LiteraryGenre $literaryGenre)
    {
        $request->validate([
            'name' => 'required|unique:literary_genres,name,' . $literaryGenre->id,
        ]);

        $literaryGenre->update([
            'name' => $request->name,
        ]);

        return redirect()->route('literary_genres.index')->with('success', 'Literary genre updated successfully.');
    }

    public function destroy(LiteraryGenre $literaryGenre)
    {
        $literaryGenre->delete();
        return redirect()->route('literary_genres.index')->with('success', 'Literary genre deleted successfully.');
    }
}