@extends('layouts.app')

@section('content')
    <h1>Author Details</h1>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $author->name }}</h5>
            <p class="card-text">Books written: {{ $author->books->count() }}</p>
        </div>
    </div>

    <a href="{{ route('authors.index') }}" class="btn btn-secondary">Back to List</a>
@endsection
