@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1 class="page-title">Inventory Management</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Inventory</li>
        </ol>
    </nav>
</div>

<!-- Stats Cards -->
<div class="stats-container">
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(74, 144, 226, 0.1); color: var(--primary);">
            <i class="fas fa-boxes"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">542</h3>
            <p class="stat-label">Total Items</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.1); color: var(--success);">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">P256,840</h3>
            <p class="stat-label">Inventory Value</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(255, 193, 7, 0.1); color: var(--warning);">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">24</h3>
            <p class="stat-label">Low Stock Items</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(220, 53, 69, 0.1); color: var(--danger);">
            <i class="fas fa-times-circle"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">8</h3>
            <p class="stat-label">Out of Stock</p>
        </div>
    </div>
</div>

<!-- Inventory Actions -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-plus-circle fa-3x text-primary mb-3"></i>
                <h5>Add Stock</h5>
                <p class="text-muted">Add new inventory items</p>
                <button class="btn btn-primary">Add Now</button>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-sync-alt fa-3x text-success mb-3"></i>
                <h5>Update Stock</h5>
                <p class="text-muted">Update existing inventory</p>
                <button class="btn btn-success">Update Now</button>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-file-export fa-3x text-info mb-3"></i>
                <h5>Export Data</h5>
                <p class="text-muted">Export inventory reports</p>
                <button class="btn btn-info">Export Now</button>
            </div>
        </div>
    </div>
</div>

<!-- Inventory Table -->
<div class="card">
    <div class="card-header">
        <i class="fas fa-list me-2"></i>Inventory List
    </div>
    <div class="card-body">
        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Current Stock</th>
                        <th>Price</th>
                        <th>Value</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>All-Terrain Tires</td>
                        <td>Tires</td>
                        <td>45</td>
                        <td>P2,500</td>
                        <td>P112,500</td>
                        <td><span class="badge bg-success">In Stock</span></td>
                        <td>
                            <button class="btn btn-sm btn-primary action-btn" data-bs-toggle="tooltip" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-info action-btn" data-bs-toggle="tooltip" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Winter Tires</td>
                        <td>Tires</td>
                        <td>12</td>
                        <td>P3,200</td>
                        <td>P38,400</td>
                        <td><span class="badge bg-warning text-dark">Low Stock</span></td>
                        <td>
                            <button class="btn btn-sm btn-primary action-btn" data-bs-toggle="tooltip" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-info action-btn" data-bs-toggle="tooltip" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Performance Tires</td>
                        <td>Tires</td>
                        <td>28</td>
                        <td>P4,500</td>
                        <td>P126,000</td>
                        <td><span class="badge bg-success">In Stock</span></td>
                        <td>
                            <button class="btn btn-sm btn-primary action-btn" data-bs-toggle="tooltip" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-info action-btn" data-bs-toggle="tooltip" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Car Mats</td>
                        <td>Accessories</td>
                        <td>0</td>
                        <td>P1,200</td>
                        <td>P0</td>
                        <td><span class="badge bg-danger">Out of Stock</span></td>
                        <td>
                            <button class="btn btn-sm btn-primary action-btn" data-bs-toggle="tooltip" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-info action-btn" data-bs-toggle="tooltip" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
