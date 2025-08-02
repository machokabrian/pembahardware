<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard - Full CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body { background-color: #f8f9fa; }
        .card { margin-bottom: 2rem; }
        .edit-form { display: none; }
        .category-edit-btn, .product-edit-btn {
            min-width: 70px;
        }
        /* Make edit forms flex nicely */
        form.edit-form .input-group, form.edit-form .row.g-2 {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }
        /* Make input groups inside forms responsive */
        form.edit-form .input-group input,
        form.edit-form .input-group select,
        form.edit-form .row.g-2 input,
        form.edit-form .row.g-2 select {
            flex: 1;
        }
    </style>
</head>
<body>
<div class="container py-4">
    <h1 class="mb-4 text-center">Admin Dashboard - Products & Categories CRUD</h1>

    @if(session('success'))
        <div class="alert alert-success text-center" role="alert">{{ session('success') }}</div>
    @endif

    {{-- Dashboard Counts --}}
    <div class="row text-center mb-5" role="region" aria-label="Dashboard statistics">
        <div class="col-md-4">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <h2 class="display-4">{{ $productCount }}</h2>
                    <p>Total Products</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <h2 class="display-4">{{ $categoryCount }}</h2>
                    <p>Total Categories</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning h-100">
                <div class="card-body">
                    <h2 class="display-4">{{ $messageCount ?? 0 }}</h2>
                    <p>Unread Messages</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Categories Section --}}
    <section aria-labelledby="categories-management-title">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 id="categories-management-title" class="mb-0">Categories Management</h3>
                <button id="toggleCategoryCreate" class="btn btn-sm btn-outline-primary">New Category</button>
            </div>
            <div class="card-body">
                {{-- Create Category Form --}}
                <form id="categoryCreateForm" action="{{ route('admin.categories.store') }}" method="POST" class="mb-4" style="display: none;" aria-label="Create new category">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="name" class="form-control" placeholder="Category Name" required aria-required="true" aria-describedby="create-category-help">
                        <button class="btn btn-success" type="submit">Create</button>
                        <button type="button" id="cancelCategoryCreate" class="btn btn-secondary">Cancel</button>
                    </div>
                    <small id="create-category-help" class="form-text text-muted">Enter a unique category name.</small>
                </form>

                {{-- Categories Table --}}
                <table class="table table-striped table-bordered align-middle" role="table" aria-describedby="categories-management-title">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col" style="width: 160px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr id="categoryRow-{{ $category->id }}">
                            <td>{{ $category->id }}</td>
                            <td>
                                <span class="category-name">{{ $category->name }}</span>
                                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="edit-form" id="categoryEditForm-{{ $category->id }}" aria-label="Edit category {{ $category->name }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="input-group">
                                        <input type="text" name="name" value="{{ $category->name }}" class="form-control" required aria-required="true">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                        <button type="button" class="btn btn-secondary cancel-category-edit" data-id="{{ $category->id }}">Cancel</button>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-warning category-edit-btn" data-id="{{ $category->id }}" aria-controls="categoryEditForm-{{ $category->id }}" aria-expanded="false">Edit</button>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?');" aria-label="Delete category {{ $category->name }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- Products Section --}}
<section aria-labelledby="products-management-title" class="mt-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 id="products-management-title" class="mb-0">Products Management</h3>
            <button id="toggleProductCreate" class="btn btn-sm btn-outline-primary">New Product</button>
        </div>
        <div class="card-body">
            {{-- Create Product Form --}}
            <form id="productCreateForm" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="mb-4" style="display: none;" aria-label="Create new product">
                @csrf
                <div class="row g-2 align-items-center">
                    <div class="col-md-3">
                        <input type="text" name="name" class="form-control" placeholder="Product Name" required aria-required="true">
                    </div>
                    <div class="col-md-3">
                        <select name="category_id" class="form-select" required aria-required="true" aria-describedby="select-category-help">
                            <option value="" disabled selected>Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <small id="select-category-help" class="form-text text-muted">Assign product to a category.</small>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="price" step="0.01" class="form-control" placeholder="Price" required aria-required="true">
                    </div>
                    <div class="col-md-2">
                        <input type="file" name="image" class="form-control" aria-label="Product image">
                    </div>
                    <div class="col-md-12 mt-2">
                        <textarea name="description" class="form-control" rows="3" placeholder="Product Description (optional)"></textarea>
                    </div>
                    <div class="col-md-12 mt-2 d-flex gap-2 justify-content-end">
                        <button class="btn btn-success" type="submit">Create</button>
                        <button type="button" id="cancelProductCreate" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </form>

            {{-- Products Table --}}
<table class="table table-striped table-bordered align-middle" role="table" aria-describedby="products-management-title">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Price</th>
            <th scope="col">Description</th>
            <th scope="col" style="width: 170px;">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        @php $primaryImage = $product->images->firstWhere('is_primary', true); @endphp
        <tr id="productRow-{{ $product->id }}">
            <td>{{ $product->id }}</td>
            <td>
                @if ($primaryImage)
                    <img src="{{ asset('storage/' . $primaryImage->image_path) }}" alt="{{ $product->name }}" style="width: 60px; height: 60px; object-fit: cover;" loading="lazy">
                @else
                    <span class="text-muted">No image</span>
                @endif
            </td>
            <td>
                <span class="product-name">{{ $product->name }}</span>
                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="edit-form" id="productEditForm-{{ $product->id }}" aria-label="Edit product {{ $product->name }}">
                    @csrf
                    @method('PUT')
                    <div class="row g-2 align-items-center">
                        <div class="col-md-3">
                            <input type="text" name="name" value="{{ $product->name }}" class="form-control" required aria-required="true">
                        </div>
                        <div class="col-md-3">
                            <select name="category_id" class="form-select" required aria-required="true">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="price" value="{{ $product->price }}" step="0.01" class="form-control" required aria-required="true">
                        </div>
                        <div class="col-md-2">
                            <input type="file" name="image" class="form-control" aria-label="Update product image">
                        </div>
                        <div class="col-md-12 mt-2">
                            <textarea name="description" class="form-control" rows="3" placeholder="Product Description (optional)">{{ $product->description }}</textarea>
                        </div>
                        <div class="col-md-12 mt-2 d-flex gap-2 justify-content-end">
                            <button class="btn btn-primary btn-sm" type="submit">Save</button>
                            <button type="button" class="btn btn-secondary btn-sm cancel-product-edit" data-id="{{ $product->id }}">Cancel</button>
                        </div>
                    </div>
                </form>
            </td>
            <td>{{ $product->category->name ?? 'Uncategorized' }}</td>
            <td>KSh {{ number_format($product->price, 2) }}</td>
            <td style="white-space: pre-wrap;">{{ $product->description }}</td>
            <td>
                <button class="btn btn-sm btn-warning product-edit-btn" data-id="{{ $product->id }}" aria-controls="productEditForm-{{ $product->id }}" aria-expanded="false">Edit</button>
                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this product?');" aria-label="Delete product {{ $product->name }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>


        </div>
    </div>
</section>

</div>

{{-- JS: Toggle forms --}}
<script>
    // Toggle Category Create Form
    document.getElementById('toggleCategoryCreate').onclick = () => {
        document.getElementById('categoryCreateForm').style.display = 'block';
        document.getElementById('toggleCategoryCreate').style.display = 'none';
    };
    document.getElementById('cancelCategoryCreate').onclick = () => {
        document.getElementById('categoryCreateForm').style.display = 'none';
        document.getElementById('toggleCategoryCreate').style.display = 'inline-block';
    };

    // Toggle Product Create Form
    document.getElementById('toggleProductCreate').onclick = () => {
        document.getElementById('productCreateForm').style.display = 'block';
        document.getElementById('toggleProductCreate').style.display = 'none';
    };
    document.getElementById('cancelProductCreate').onclick = () => {
        document.getElementById('productCreateForm').style.display = 'none';
        document.getElementById('toggleProductCreate').style.display = 'inline-block';
    };

    // Category Edit Buttons
    document.querySelectorAll('.category-edit-btn').forEach(btn => {
        btn.onclick = () => {
            const id = btn.dataset.id;
            const form = document.getElementById(`categoryEditForm-${id}`);
            form.style.display = 'flex';
            btn.style.display = 'none';
            document.querySelector(`#categoryRow-${id} .category-name`).style.display = 'none';
            btn.setAttribute('aria-expanded', 'true');
        };
    });
    // Cancel Category Edit
    document.querySelectorAll('.cancel-category-edit').forEach(btn => {
        btn.onclick = () => {
            const id = btn.dataset.id;
            const form = document.getElementById(`categoryEditForm-${id}`);
            form.style.display = 'none';
            const editBtn = document.querySelector(`#categoryRow-${id} .category-edit-btn`);
            editBtn.style.display = 'inline-block';
            document.querySelector(`#categoryRow-${id} .category-name`).style.display = 'inline';
            editBtn.setAttribute('aria-expanded', 'false');
        };
    });

    // Product Edit Buttons
    document.querySelectorAll('.product-edit-btn').forEach(btn => {
        btn.onclick = () => {
            const id = btn.dataset.id;
            const form = document.getElementById(`productEditForm-${id}`);
            form.style.display = 'flex';
            btn.style.display = 'none';
            document.querySelector(`#productRow-${id} .product-name`).style.display = 'none';
            btn.setAttribute('aria-expanded', 'true');
        };
    });
    // Cancel Product Edit
    document.querySelectorAll('.cancel-product-edit').forEach(btn => {
        btn.onclick = () => {
            const id = btn.dataset.id;
            const form = document.getElementById(`productEditForm-${id}`);
            form.style.display = 'none';
            const editBtn = document.querySelector(`#productRow-${id} .product-edit-btn`);
            editBtn.style.display = 'inline-block';
            document.querySelector(`#productRow-${id} .product-name`).style.display = 'inline';
            editBtn.setAttribute('aria-expanded', 'false');
        };
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
