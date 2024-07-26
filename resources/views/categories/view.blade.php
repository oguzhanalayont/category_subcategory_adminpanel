@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $category->title }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Forum</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($category->forums as $forum)
            <tr>
                <td>{{ $forum->title }}</td>
                <td>{{ $forum->description }}</td>
                <td>
                    <a href="{{ route('forums.view', $forum->id) }}" class="btn btn-primary">View Posts</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection