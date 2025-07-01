<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['author', 'genres'])->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::all();
        $genres = Genre::all();
        return view('books.create', compact('authors', 'genres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'author_id' => 'required|exists:authors,id',
            'genres' => 'array'
        ]);

        $book = Book::create([
            'title' => $validated['title'],
            'author_id' => $validated['author_id'],
        ]);

        if ($request->has('genres')) {
            $book->genres()->attach($validated['genres']);
        }

        return redirect()->route('books.index')->with('success', 'Book added successfully.');
    }

    public function show(Book $book)
    {
        $book->load(['author', 'genres']);
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $authors = Author::all();
        $genres = Genre::all();
        $book->load('genres');
        return view('books.edit', compact('book', 'authors', 'genres'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'author_id' => 'required|exists:authors,id',
            'genres' => 'array'
        ]);

        $book->update([
            'title' => $validated['title'],
            'author_id' => $validated['author_id'],
        ]);

        $book->genres()->sync($validated['genres'] ?? []);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->genres()->detach();
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
