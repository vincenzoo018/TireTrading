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

<!-- Stats Cards -->
<div class="stats-container">
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(74, 144, 226, 0.1); color: var(--primary);">
            <i class="fas fa-box"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">156</h3>
            <p class="stat-label">Total Products</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.1); color: var(--success);">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">128</h3>
            <p class="stat-label">In Stock</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(255, 193, 7, 0.1); color: var(--warning);">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">24</h3>
            <p class="stat-label">Low Stock</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(220, 53, 69, 0.1); color: var(--danger);">
            <i class="fas fa-times-circle"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">4</h3>
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
        <form>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="productName" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="productName" required>
                </div>
                <div class="col-md-6">
                    <label for="productCategory" class="form-label">Category</label>
                    <select class="form-select" id="productCategory" required>
                        <option value="">Select Category</option>
                        <option value="tires">Tires</option>
                        <option value="services">Services</option>
                        <option value="accessories">Accessories</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="productPrice" class="form-label">Price</label>
                    <input type="number" class="form-control" id="productPrice" required>
                </div>
                <div class="col-md-4">
                    <label for="productStock" class="form-label">Stock Quantity</label>
                    <input type="number" class="form-control" id="productStock" required>
                </div>
                <div class="col-md-4">
                    <label for="productStatus" class="form-label">Status</label>
                    <select class="form-select" id="productStatus" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label for="productDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="productDescription" rows="3"></textarea>
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
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>All-Terrain Tires</td>
                        <td><span class="badge bg-info">Tires</span></td>
                        <td>P2,500</td>
                        <td>45</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>
                            <button class="btn btn-sm btn-primary action-btn" data-bs-toggle="tooltip" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger action-btn" data-bs-toggle="tooltip" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Winter Tires</td>
                        <td><span class="badge bg-info">Tires</span></td>
                        <td>P3,200</td>
                        <td>12</td>
                        <td><span class="badge bg-warning text-dark">Low Stock</span></td>
                        <td>
                            <button class="btn btn-sm btn-primary action-btn" data-bs-toggle="tooltip" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger action-btn" data-bs-toggle="tooltip" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Wheel Alignment</td>
                        <td><span class="badge bg-secondary">Services</span></td>
                        <td>P800</td>
                        <td>-</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>
                            <button class="btn btn-sm btn-primary action-btn" data-bs-toggle="tooltip" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger action-btn" data-bs-toggle="tooltip" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Car Mats</td>
                        <td><span class="badge bg-warning text-dark">Accessories</span></td>
                        <td>P1,200</td>
                        <td>0</td>
                        <td><span class="badge bg-danger">Out of Stock</span></td>
                        <td>
                            <button class="btn btn-sm btn-primary action-btn" data-bs-toggle="tooltip" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger action-btn" data-bs-toggle="tooltip" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
