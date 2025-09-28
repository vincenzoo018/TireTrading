@extends('layouts.admin.app')

@section('content')
<div class="page-header">
    <h1 class="page-title">Product Management</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Products</li>
        </ol>
    </nav>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- Stats Cards -->
<div class="stats-container">
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(74, 144, 226, 0.1); color: var(--primary);">
            <i class="fas fa-box"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">{{ $products->count() }}</h3>
            <p class="stat-label">Total Products</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.1); color: var(--success);">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">{{ $products->where('status','active')->count() }}</h3>
            <p class="stat-label">Active</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(255, 193, 7, 0.1); color: var(--warning);">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">{{ $products->where('stock_quantity','<',20)->count() }}</h3>
            <p class="stat-label">Low Stock (&lt;20)</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(220, 53, 69, 0.1); color: var(--danger);">
            <i class="fas fa-times-circle"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">{{ $products->where('stock_quantity',0)->count() }}</h3>
            <p class="stat-label">Out of Stock</p>
        </div>
    </div>
</div>

<!-- Add Product Form -->
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-plus-circle me-2"></i>Add New Product
    </div>
    <div class="card-body">
        <form action="{{ route('admin.products.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="productName" class="form-label">Product Name</label>
                    <input name="product_name" type="text" class="form-control" id="productName" required value="{{ old('product_name') }}">
                </div>
                <div class="col-md-6">
                    <label for="productCategory" class="form-label">Category</label>
                    <select name="category_id" class="form-select" id="productCategory" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->category_id }}" {{ old('category_id') == $cat->category_id ? 'selected' : '' }}>
                                {{ $cat->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="productBrand" class="form-label">Brand</label>
                    <input name="brand" type="text" class="form-control" id="productBrand" value="{{ old('brand') }}">
                </div>
                <div class="col-md-3">
                    <label for="productSize" class="form-label">Size</label>
                    <input name="size" type="text" class="form-control" id="productSize" value="{{ old('size') }}">
                </div>
                <div class="col-md-3">
                    <label for="productLength" class="form-label">Length</label>
                    <input name="length" type="text" class="form-control" id="productLength" value="{{ old('length') }}">
                </div>
                <div class="col-md-3">
                    <label for="productWidth" class="form-label">Width</label>
                    <input name="width" type="text" class="form-control" id="productWidth" value="{{ old('width') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="basePrice" class="form-label">Base Price</label>
                    <input name="base_price" type="number" step="0.01" class="form-control" id="basePrice" required value="{{ old('base_price', '0.00') }}">
                </div>
                <div class="col-md-4">
                    <label for="sellingPrice" class="form-label">Selling Price</label>
                    <input name="selling_price" type="number" step="0.01" class="form-control" id="sellingPrice" required value="{{ old('selling_price', '0.00') }}">
                </div>
                <div class="col-md-4">
                    <label for="productStock" class="form-label">Stock Quantity</label>
                    <input name="stock_quantity" type="number" class="form-control" id="productStock" required value="{{ old('stock_quantity', 0) }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="productStatus" class="form-label">Status</label>
                    <select name="status" class="form-select" id="productStatus" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="productDescription" class="form-label">Description</label>
                    <input name="description" type="text" class="form-control" id="productDescription" value="{{ old('description') }}">
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save me-2"></i>Add Product
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Products Table -->
<div class="card">
    <div class="card-header">
        <i class="fas fa-list me-2"></i>Product List
    </div>
    <div class="card-body">
        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Size</th>
                        <th>Price (Base / Selling)</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>
                            @if($product->category)
                                <span class="badge bg-info">{{ $product->category->category_name }}</span>
                            @else
                                <span class="badge bg-secondary">Uncategorized</span>
                            @endif
                        </td>
                        <td>{{ $product->brand ?? '-' }}</td>
                        <td>
                            {{ $product->size ?? '-' }}
                            @if($product->length || $product->width)
                                <small class="d-block text-muted">L:{{ $product->length ?? '-' }} W:{{ $product->width ?? '-' }}</small>
                            @endif
                        </td>
                        <td>P{{ number_format($product->base_price,2) }} / P{{ number_format($product->selling_price,2) }}</td>
                        <td>{{ $product->stock_quantity }}</td>
                        <td>
                            @if($product->stock_quantity == 0)
                                <span class="badge bg-danger">Out of Stock</span>
                            @elseif($product->stock_quantity < 20)
                                <span class="badge bg-warning text-dark">Low Stock</span>
                            @else
                                <span class="badge bg-success">{{ ucfirst($product->status) }}</span>
                            @endif
                        </td>
                        <td>
                            <!-- Edit Button triggers modal -->
                            <button class="btn btn-sm btn-primary action-btn" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $product->product_id }}" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>

                            <!-- Delete: form -->
                            <form action="{{ route('admin.products.destroy', $product->product_id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger action-btn" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editProductModal{{ $product->product_id }}" tabindex="-1" aria-labelledby="editProductModalLabel{{ $product->product_id }}" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editProductModalLabel{{ $product->product_id }}">Edit Product - {{ $product->product_name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <form action="{{ route('admin.products.update', $product->product_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Product Name</label>
                                        <input name="product_name" type="text" class="form-control" value="{{ old('product_name', $product->product_name) }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Category</label>
                                        <select name="category_id" class="form-select" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->category_id }}" {{ (old('category_id', $product->category_id) == $cat->category_id) ? 'selected' : '' }}>
                                                    {{ $cat->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Brand</label>
                                        <input name="brand" type="text" class="form-control" value="{{ old('brand', $product->brand) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Size</label>
                                        <input name="size" type="text" class="form-control" value="{{ old('size', $product->size) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Length</label>
                                        <input name="length" type="text" class="form-control" value="{{ old('length', $product->length) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Width</label>
                                        <input name="width" type="text" class="form-control" value="{{ old('width', $product->width) }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Base Price</label>
                                        <input name="base_price" type="number" step="0.01" class="form-control" value="{{ old('base_price', $product->base_price) }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Selling Price</label>
                                        <input name="selling_price" type="number" step="0.01" class="form-control" value="{{ old('selling_price', $product->selling_price) }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Stock Quantity</label>
                                        <input name="stock_quantity" type="number" class="form-control" value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <input name="description" type="text" class="form-control" value="{{ old('description', $product->description) }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select" required>
                                        <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- End modal -->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
