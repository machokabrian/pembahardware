@extends('layouts.app')

@section('title', 'Manage Categories')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Manage Categories</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Add New Category</a>

    @if($categories->count())
    <table class="table table-striped table-bordered align-middle">
        <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Created At</th>
                <th class="text-center" style="width: 150px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->created_at->format('M d, Y') }}</td>
                <td class="text-center">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this category?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No categories found.</p>
    @endif
</div>
@endsection
