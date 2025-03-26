@extends('layouts.app')
<style>
    body {
        background-image: url('{{ asset('images/background.jpg') }}');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
</style>
@section('content')
<div class="container">
    <h1>Admin - Manage Forums</h1>
    <a href="{{ route('admin.forums.create') }}" class="btn btn-primary mb-3">Create New Forum</a>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($forums as $forum)
            <tr>
                <td>{{ $forum->title }}</td>
                <td>{{ Str::limit($forum->description, 100) }}</td>
                <td>{{ $forum->category->title }}</td>
                <td>
                    <a href="{{ route('admin.forums.edit', $forum) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.forums.destroy', $forum) }}" method="POST" class="d-inline">
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