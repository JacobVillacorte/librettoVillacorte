@extends('layouts.app')

@section('content')
    <h1>Edit Author</h1>

    <form action="{{ route('authors.update', $author) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Author Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $author->name }}" required>
        </div>
        <button class="btn btn-primary" type="submit">Update</button>
    </form>
@endsection
