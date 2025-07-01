@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Welcome to Libretto 📚</h1>
    <div class="row g-3">
        <div class="col-md-4">
            <a href="{{ route('authors.index') }}" class="btn btn-outline-primary w-100">Manage Authors</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('books.index') }}" class="btn btn-outline-success w-100">Manage Books</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('genres.index') }}" class="btn btn-outline-warning w-100">Manage Genres</a>
        </div>
    </div>
@endsection
