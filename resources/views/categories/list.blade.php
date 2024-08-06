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
    <h1>Forums in {{ $category->title }}</h1>
    <p>Category Description: {{ $category->description }}</p>

    <a href="{{ route('forums.create', ['category_id' => $category->id]) }}" class="btn btn-primary mb-3">Create New Forum</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Posts Count</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($category->forums as $forum)
            <tr>
                <td>{{ $forum->title }}</td>
                <td>{{ $forum->description }}</td>
                <td>{{ $forum->posts_count}}</td>
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
</div>
@endsection