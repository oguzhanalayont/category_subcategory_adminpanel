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
    <h1>{{ $forum->title }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Post</th>
                <th>Content</th>
            </tr>
        </thead>
        <tbody>
            @foreach($forum->posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->content }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection