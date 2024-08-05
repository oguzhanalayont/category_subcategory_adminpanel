@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $category->title }}</h1>
    <p>{{ $category->description }}</p>

    <h2>Forums in this Category</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($category->forums as $forum)
            <tr>
                <td>{{ $forum->title }}</td>
                <td>{{ $forum->description }}</td>
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