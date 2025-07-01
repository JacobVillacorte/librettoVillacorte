@extends('layouts.app')

@section('content')
    <h1>Edit Book</h1>

    <form action="{{ route('books.update', $book) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" value="{{ $book->title }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="author_id" class="form-label">Author</label>
            <select name="author_id" class="form-control">
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ $book->author_id == $author->id ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="genres" class="form-label">Genres</label>
            <select name="genres[]" class="form-control" multiple>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}"
                        {{ in_array($genre->id, $book->genres->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary" type="submit">Update</button>
    </form>
@endsection
