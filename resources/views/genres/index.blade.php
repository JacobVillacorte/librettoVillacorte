@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Genres</h1>
    <a href="{{ route('genres.create') }}" class="btn btn-primary">Add Genre</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($genres->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Books Count</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($genres as $genre)
                <tr>
                    <td>{{ $genre->id }}</td>
                    <td>{{ $genre->name }}</td>
                    <td>{{ $genre->books->count() }}</td>
                    <td>
                        <a href="{{ route('genres.show', $genre) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('genres.edit', $genre) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('genres.destroy', $genre) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this genre?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $genres->links() }}  {{-- for genres/index.blade.php --}}
    @else
    <p>No genres found.</p>
@endif
@endsection
