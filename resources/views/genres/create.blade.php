@extends('layouts.app')

@section('content')
<h1>Add New Genre</h1>

<form action="{{ route('genres.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Genre Name</label>
        <input type="text" name="name" class="form-control" id="name" required>
    </div>
    <button class="btn btn-primary" type="submit">Save</button>
</form>
@endsection
