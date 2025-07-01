@extends('layouts.app')

@section('content')
<h1>Edit Genre</h1>

<form action="{{ route('genres.update', $genre) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Genre Name</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ $genre->name }}" required>
    </div>

    <button class="btn btn-primary" type="submit">Update</button>
</form>
@endsection
