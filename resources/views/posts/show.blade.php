@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->content }}</p>
        <hr>

        <h2>Comments</h2>
        @forelse ($post->comments as $comment)
            <div class="mb-3">
                <p>{{ $comment->content }}</p>
                <small><em>Added on {{ $comment->created_at->format('d-m-Y H:i') }}</em></small>
            </div>
        @empty
            <p>No comments yet.</p>
        @endforelse

        <hr>
        <h3>Add a Comment</h3>
        <form action="{{ route('comments.store', $post) }}" method="POST">
            @csrf
            <div class="mb-3">
                <textarea name="content" class="form-control" rows="3" placeholder="Write your comment..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Comment</button>
        </form>
    </div>
@endsection
