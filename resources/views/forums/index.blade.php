@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Forums</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Category</th>
                <th>Posts Count</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($forums as $forum)
            <tr>
                <td>{{ $forum->title }}</td>
                <td>{{ Str::limit($forum->description, 100) }}</td>
                <td>{{ $forum->category->title }}</td>
                <td>{{ $forum->posts_count }}</td>
                <td>
                    <a href="{{ route('forums.show', $forum) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('forums.edit', $forum) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('forums.destroy', $forum) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('forums.create') }}" class="btn btn-primary">Create New Forum</a>
</div>
@endsection