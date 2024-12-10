@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Posts</h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Title</th>
                <th>Content Preview</th>
                <th>Forum</th>
                <th>Comments</th>
                <th>Last Comment</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>
                    <a href="{{ route('posts.show', $post) }}">
                        {{ $post->title }}
                    </a>
                </td>
                <td>{{ Str::limit($post->content, 100) }}</td>
                <td>{{ $post->forum->title }}</td>
                <td>
                    <span class="badge bg-secondary">
                        {{ $post->comments_count ?? $post->comments()->count() }}
                    </span>
                </td>
                <td>
                    @if($post->comments->count() > 0)
                        @php
                            $lastComment = $post->comments->last();
                        @endphp
                        <small>
                            {{ Str::limit($lastComment->content, 50) }}
                            <br>
                            <em>{{ $lastComment->user->name }} - {{ $lastComment->created_at->diffForHumans() }}</em>
                        </small>
                    @else
                        <small class="text-muted">No comments</small>
                    @endif
                </td>
                <td>{{ $post->created_at->format('Y-m-d H:i') }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('posts.create') }}" class="btn btn-primary">Create New Post</a>

    @if($posts->isEmpty())
        <div class="alert alert-info mt-3">
            There are no posts yet. Create your first post!
        </div>
    @endif

    {{ $posts->links() }} {{-- Sayfalama için --}}
</div>
@endsection