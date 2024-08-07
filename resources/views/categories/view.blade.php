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
<div class="container">
    <h1>{{ $category->title }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Forum</th>
                <th>Description</th>
                <th>Posts Count</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($category->forums as $forum)
            <tr>
                <td>{{ $forum->title }}</td>
                <td>{{ $forum->description }}</td>
                <td>{{ $forum->posts_count }}</td>
                <td>
                    <a href="{{ route('forums.view', $forum->id) }}" class="btn btn-primary">View Posts</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection