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
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Stats Cards -->
<div class="stats-container">
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(74, 144, 226, 0.1); color: var(--primary);">
            <i class="fas fa-box"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">{{ $totalProduct }}</h3>
            <p class="stat-label">Total Products</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.1); color: var(--success);">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">{{ $totalCategories }}</h3>
            <p class="stat-label">Total Categories</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(255, 193, 7, 0.1); color: var(--warning);">
            <i class="fas fa-warehouse"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">{{ $activeProducts }}</h3>
            <p class="stat-label">Active Products</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(108, 117, 125, 0.1); color: var(--secondary);">
            <i class="fas fa-tags"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">{{ $productCategories }}</h3>
            <p class="stat-label">Product Categories</p>
        </div>
    </div>
</div>


<!-- Add Product Form -->
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-plus-circle me-2"></i>Add New Product
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.products.store') }}">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="ProductName" class="form-label">Product Name *</label>
                    <input type="text" class="form-control" id="ProductName" name="product_name"
                           placeholder="Enter product name" value="{{ old('product_name') }}" required>
                    @error('product_name')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="productCategory" class="form-label">Category *</label>
                    <select class="form-select" id="productCategory" name="category_id" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_id }}" {{ old('category_id') == $category->category_id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="ProductBrand" class="form-label">Brand</label>
                    <input type="text" class="form-control" id="ProductBrand" name="brand"
                           placeholder="Enter brand name" value="{{ old('brand') }}">
                    @error('brand')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="ProductSize" class="form-label">Size</label>
                    <input type="text" class="form-control" id="ProductSize" name="size"
                           placeholder="Enter size" value="{{ old('size') }}">
                    @error('size')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="productStatus" class="form-label">Status</label>
                    <select class="form-select" id="productStatus" name="status">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="ProductLength" class="form-label">Length</label>
                    <input type="number" step="0.01" class="form-control" id="ProductLength" name="length"
                           placeholder="Enter length" value="{{ old('length') }}">
                    @error('length')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="ProductWidth" class="form-label">Width</label>
                    <input type="number" step="0.01" class="form-control" id="ProductWidth" name="width"
                           placeholder="Enter width" value="{{ old('width') }}">
                    @error('width')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="productStock" class="form-label">Initial Stock</label>
                    <input type="number" class="form-control" id="productStock" name="stock_quantity"
                           placeholder="Enter stock quantity" value="{{ old('stock_quantity') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="ProductBasePrice" class="form-label">Base Price *</label>
                    <input type="number" step="0.01" class="form-control" id="ProductBasePrice" name="base_price"
                           placeholder="Enter base price" value="{{ old('base_price') }}" required>
                    @error('base_price')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="ProductSellingPrice" class="form-label">Selling Price *</label>
                    <input type="number" step="0.01" class="form-control" id="ProductSellingPrice" name="selling_price"
                           placeholder="Enter selling price" value="{{ old('selling_price') }}" required>
                    @error('selling_price')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <label for="ProductDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="ProductDescription" name="description"
                              placeholder="Enter product description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
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
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Size</th>
                        <th>Length</th>
                        <th>Width</th>
                        <th>Base Price</th>
                        <th>Selling Price</th>
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
                                <span class="badge bg-warning">Uncategorized</span>
                            @endif
                        </td>
                        <td>{{ $product->brand ?? '-' }}</td>
                        <td>{{ $product->size ?? '-' }}</td>
                        <td>{{ $product->length ? $product->length . ' cm' : '-' }}</td>
                        <td>{{ $product->width ? $product->width . ' cm' : '-' }}</td>
                        <td>P{{ number_format($product->base_price, 2) }}</td>
                        <td>P{{ number_format($product->selling_price, 2) }}</td>
                        <td>
                            @if($product->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary action-btn edit-product"
                                    data-id="{{ $product->product_id }}"
                                    data-name="{{ $product->product_name }}"
                                    data-category="{{ $product->category_id }}"
                                    data-brand="{{ $product->brand }}"
                                    data-size="{{ $product->size }}"
                                    data-length="{{ $product->length }}"
                                    data-width="{{ $product->width }}"
                                    data-base-price="{{ $product->base_price }}"
                                    data-selling-price="{{ $product->selling_price }}"
                                    data-status="{{ $product->status }}"
                                    data-description="{{ $product->description }}"
                                    data-bs-toggle="tooltip" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('admin.product.destroy', $product->product_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger action-btn"
                                        data-bs-toggle="tooltip" title="Delete"
                                        onclick="return confirm('Are you sure you want to delete this product?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($products->isEmpty())
        <div class="text-center py-4">
            <i class="fas fa-box fa-3x text-muted mb-3"></i>
            <p class="text-muted">No products found. Add your first product above.</p>
        </div>
        @endif
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editProductForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editProductName" class="form-label">Product Name *</label>
                            <input type="text" class="form-control" id="editProductName" name="product_name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="editProductCategory" class="form-label">Category *</label>
                            <select class="form-select" id="editProductCategory" name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="editProductBrand" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="editProductBrand" name="brand">
                        </div>
                        <div class="col-md-4">
                            <label for="editProductSize" class="form-label">Size</label>
                            <input type="text" class="form-control" id="editProductSize" name="size">
                        </div>
                        <div class="col-md-4">
                            <label for="editProductStatus" class="form-label">Status</label>
                            <select class="form-select" id="editProductStatus" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editProductLength" class="form-label">Length</label>
                            <input type="number" step="0.01" class="form-control" id="editProductLength" name="length">
                        </div>
                        <div class="col-md-6">
                            <label for="editProductWidth" class="form-label">Width</label>
                            <input type="number" step="0.01" class="form-control" id="editProductWidth" name="width">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editProductBasePrice" class="form-label">Base Price *</label>
                            <input type="number" step="0.01" class="form-control" id="editProductBasePrice" name="base_price" required>
                        </div>
                        <div class="col-md-6">
                            <label for="editProductSellingPrice" class="form-label">Selling Price *</label>
                            <input type="number" step="0.01" class="form-control" id="editProductSellingPrice" name="selling_price" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="editProductDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editProductDescription" name="description" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Edit Product Modal
        const editProductButtons = document.querySelectorAll('.edit-product');
        const editProductModal = new bootstrap.Modal(document.getElementById('editProductModal'));
        const editProductForm = document.getElementById('editProductForm');

        editProductButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                const productName = this.getAttribute('data-name');
                const categoryId = this.getAttribute('data-category');
                const brand = this.getAttribute('data-brand');
                const size = this.getAttribute('data-size');
                const length = this.getAttribute('data-length');
                const width = this.getAttribute('data-width');
                const basePrice = this.getAttribute('data-base-price');
                const sellingPrice = this.getAttribute('data-selling-price');
                const status = this.getAttribute('data-status');
                const description = this.getAttribute('data-description');

                document.getElementById('editProductName').value = productName;
                document.getElementById('editProductCategory').value = categoryId;
                document.getElementById('editProductBrand').value = brand;
                document.getElementById('editProductSize').value = size;
                document.getElementById('editProductLength').value = length;
                document.getElementById('editProductWidth').value = width;
                document.getElementById('editProductBasePrice').value = basePrice;
                document.getElementById('editProductSellingPrice').value = sellingPrice;
                document.getElementById('editProductStatus').value = status;
                document.getElementById('editProductDescription').value = description;

                editProductForm.action = `/admin/products/${productId}`;
                editProductModal.show();
            });
        });
    });
</script>
@endsection
