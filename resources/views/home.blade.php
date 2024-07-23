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

<div class="row">
    @foreach($categories as $category)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $category->title }}</h3>
                </div>
                <div class="card-body">
                    <p>{{ $category->description }}</p>
                    <h4>Forums:</h4>
                    <ul class="list-group">
                        @foreach($category->forums as $forum)
                            <li class="list-group-item">
                                <h5>{{ $forum->title }} ({{ $forum->posts_count }} posts)</h5>
                                <p>{{ $forum->description }}</p>
                                <h6>Recent Posts:</h6>
                                <ul>
                                    @foreach($forum->posts as $post)
                                        <li>{{ $post->title }}</li>
                                    @endforeach
                                </ul>
                                @if($forum->posts_count > 3)
                                    <a href="{{ route('forums.show', $forum) }}" class="btn btn-sm btn-primary">View all posts</a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    @if($category->forums->count() > 3)
                        <a href="{{ route('categories.show', $category) }}" class="btn btn-primary mt-3">View all forums</a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
