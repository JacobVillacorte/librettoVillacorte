<?php

namespace App\Http\Controllers;
use App\Models\Genre;


use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $genres = Genre::withCount('books')->paginate(10);

    return view('genres.index', compact('genres'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('genres.create');
}
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:genres,name',
    ]);

    Genre::create([
        'name' => $request->name,
    ]);

    return redirect()->route('genres.index')->with('success', 'Genre added successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
{
    // Optional: Show genre details and related books
    $genre->load('books');
    return view('genres.show', compact('genre'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
{
    return view('genres.edit', compact('genre'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genre $genre)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:genres,name,' . $genre->id,
    ]);

    $genre->update([
        'name' => $request->name,
    ]);

    return redirect()->route('genres.index')->with('success', 'Genre updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
{
    $genre->delete();
    return redirect()->route('genres.index')->with('success', 'Genre deleted successfully.');
}
}
