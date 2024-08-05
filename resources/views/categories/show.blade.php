@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tüm Kategoriler</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Category</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->title }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    <a href="{{ route('categories.view', $category->id) }}" class="btn btn-primary">View All Forums</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection