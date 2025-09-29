@extends('layouts.customer.app')

@section('content')
<!-- Products Header -->
<section class="py-5 bg-light">
    <div class="container">
        <h1 class="section-title">Our Products</h1>
        <p class="lead">Browse our wide selection of quality tires for all vehicle types</p>
    </div>
</section>

<!-- Products Section -->
<section class="py-5">
    <div class="container">
        <form method="GET" action="{{ route('customer.products') }}" class="row mb-4 g-2">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="category" class="form-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->category_id }}" {{ request('category') == $cat->category_id ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="brand" class="form-select">
                    <option value="">All Brands</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="sort" class="form-select">
                    <option value="">Sort by: Featured</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z to A</option>
                </select>
            </div>
            <div class="col-md-12 mt-2">
                <button class="btn btn-primary" type="submit">Filter</button>
            </div>
        </form>

        <div class="row">
            @forelse($inventories as $inventory)
                @php
                    $product = $inventory->stockIn->product ?? null;
                    $stock = $inventory->quantity_on_hand ?? 0;
                    $status = $stock == 0 ? 'Out of Stock' : ($stock < 15 ? 'Low Stock' : 'In Stock');
                @endphp
                <div class="col-md-4 mb-4">
                    <div class="card product-card h-100">
                        <img src="/images/tire-{{ $product?->product_id ?? 1 }}.jpg" class="card-img-top product-img" alt="{{ $product?->product_name }}">
                        <div class="card-body">
                            <h5 class="product-title">{{ $product?->product_name }}</h5>
                            <p class="card-text">{{ $product?->description }}</p>
                            <ul class="list-unstyled mb-2">
                                <li><strong>Brand:</strong> {{ $product?->brand }}</li>
                                <li><strong>Size:</strong> {{ $product?->size }}</li>
                                <li><strong>Length:</strong> {{ $product?->length }}</li>
                                <li><strong>Width:</strong> {{ $product?->width }}</li>
                                <li><strong>Category:</strong> {{ $product?->category?->category_name ?? '-' }}</li>
                            </ul>
                            <div class="mb-2">
                                <span class="product-price">P{{ number_format($product?->selling_price ?? 0, 2) }}</span>
                            </div>
                            <div class="mb-2">
                                @if($status == 'Out of Stock')
                                    <span class="badge bg-danger">Out of Stock</span>
                                @elseif($status == 'Low Stock')
                                    <span class="badge bg-warning text-dark">Low Stock</span>
                                @else
                                    <span class="badge bg-success">In Stock</span>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <button class="btn btn-primary" @if($stock == 0) disabled @endif>
                                    <i class="fas fa-cart-plus"></i> Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">No products found.</div>
                </div>
            @endforelse
        </div>
        <!-- Pagination (optional, if you add pagination) -->
    </div>
</section>
@endsection
