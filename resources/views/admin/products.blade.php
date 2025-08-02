@extends('layouts.app')

@section('title', 'Manage Products')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Manage Products</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Add New Product</a>

    @if($products->count())
    <table class="table table-striped table-bordered align-middle">
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Created At</th>
                <th class="text-center" style="width: 180px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name ?? 'N/A' }}</td>
                <td>${{ number_format($product->price, 2) }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->created_at->format('M d, Y') }}</td>
                <td class="text-center">
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this product?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $products->links() }}
    </div>
    @else
    <p>No products found.</p>
    @endif
</div>
@endsection
