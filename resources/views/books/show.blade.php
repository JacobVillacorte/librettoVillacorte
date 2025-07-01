@extends('layouts.app')

@section('content')
    <h1>Book Details</h1>

    <div class="mb-3">
        <strong>Title:</strong> {{ $book->title }}
    </div>
    <div class="mb-3">
        <strong>Author:</strong> {{ $book->author->name }}
    </div>
    <div class="mb-3">
        <strong>Genres:</strong>
        @foreach($book->genres as $genre)
            <span class="badge bg-secondary">{{ $genre->name }}</span>
        @endforeach
    </div>

    <a href="{{ route('books.index') }}" class="btn btn-secondary">Back</a>
@endsection
