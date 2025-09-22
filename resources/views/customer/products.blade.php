@extends('layouts.app')

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
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search products...">
                    <button class="btn btn-primary" type="button">Search</button>
                </div>
            </div>
            <div class="col-md-6">
                <select class="form-select">
                    <option selected>Sort by: Featured</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                    <option>Name: A to Z</option>
                    <option>Name: Z to A</option>
                </select>
            </div>
        </div>

        <div class="row">
            <!-- Product listings would go here -->
            <div class="col-md-4 mb-4">
                <div class="card product-card">
                    <img src="/images/tire-1.jpg" class="card-img-top product-img" alt="All-Terrain Tire">
                    <div class="card-body">
                        <h5 class="product-title">All-Terrain Tire</h5>
                        <p class="card-text">Perfect for both on-road and off-road adventures.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="product-price">P2,500</span>
                            <button class="btn btn-primary" onclick="addToCart(1, 'All-Terrain Tire', 2500)">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card product-card">
                    <img src="/images/tire-2.jpg" class="card-img-top product-img" alt="Performance Tire">
                    <div class="card-body">
                        <h5 class="product-title">Performance Tire</h5>
                        <p class="card-text">Enhanced handling and superior traction for sports cars.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="product-price">P3,200</span>
                            <button class="btn btn-primary" onclick="addToCart(2, 'Performance Tire', 3200)">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card product-card">
                    <img src="/images/tire-3.jpg" class="card-img-top product-img" alt="Winter Tire">
                    <div class="card-body">
                        <h5 class="product-title">Winter Tire</h5>
                        <p class="card-text">Specialized tread design for superior snow and ice traction.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="product-price">P3,800</span>
                            <button class="btn btn-primary" onclick="addToCart(3, 'Winter Tire', 3800)">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- More product cards would go here -->
        </div>

        <!-- Pagination -->
        <nav aria-label="Product pagination" class="mt-5">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</section>
@endsection