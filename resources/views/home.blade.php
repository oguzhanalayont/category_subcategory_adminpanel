@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url('{{ asset('images/background.jpg') }}');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
</style>
<div class="row justify-content-center">
    <div class="col-md-10">
        <h1 class="mb-4">Kategoriler</h1>
        <div class="row">
            @foreach($categories as $category)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h2>{{ $category->title }}</h2>
                        </div>
                        <div class="card-body">
                            <p>{{ $category->description }}</p>
                            <h3>Forums:</h3>
                            <ul class="list-group">
                                @foreach($category->forums->take(3) as $forum)
                                    <li class="list-group-item" id="forum-{{ $forum->id }}">
                                        <h4>{{ $forum->title }}</h4>
                                        <p class="forum-description" data-forum-id="{{ $forum->id }}" style="cursor: pointer;">{{ $forum->description }}</p>
                                        <div class="posts-container" id="posts-{{ $forum->id }}" style="display: none;">
                                            <h5>Recent Posts:</h5>
                                            <ul>
                                                @forelse($forum->posts->take(3) as $post)
                                                    <li>{{ $post->title }}</li>
                                                @empty
                                                    <li>No recent posts</li>
                                                @endforelse
                                            </ul>
                                            @if($forum->posts_count > 3)
                                                <a href="{{ route('forums.show', $forum->id) }}" class="btn btn-sm btn-primary">View all posts</a>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            @if($category->forums_count > 3)
                                <a href="{{ route('categories.forums', $category->id) }}" class="btn btn-primary mt-3">View all forums</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.body.addEventListener('click', function(event) {
        if (event.target.classList.contains('forum-description')) {
            const forumId = event.target.getAttribute('data-forum-id');
            const postsContainer = document.getElementById(`posts-${forumId}`);
            if (postsContainer) {
                postsContainer.style.display = postsContainer.style.display === 'none' ? 'block' : 'none';
            }
        }
    });
});
</script>
@endsection
