@extends('layouts.app')

@section('content')
    <h1>Add New Author</h1>

    <form action="{{ route('authors.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Author Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>
        <button class="btn btn-primary" type="submit">Save</button>
    </form>
@endsection
