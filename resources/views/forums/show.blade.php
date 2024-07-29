@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $forum->title }}</h1>
    <p>{{ $forum->description }}</p>
    <p>Category: <a href="{{ route('forums.show', $forum->category) }}">{{ $forum->category->title }}</a></p>

    <h2>Posts in this Forum</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Content Preview</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($forum->posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ Str::limit($post->content, 100) }}</td>
                <td>{{ $post->created_at->format('Y-m-d H:i') }}</td>
                <td>
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('posts.create') }}" class="btn btn-primary">Create New Post</a>
</div>
@endsection