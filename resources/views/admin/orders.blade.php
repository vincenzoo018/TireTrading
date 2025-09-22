@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1 class="page-title">Order Management</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Orders</li>
        </ol>
    </nav>
</div>

<!-- Stats Cards -->
<div class="stats-container">
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(74, 144, 226, 0.1); color: var(--primary);">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">42</h3>
            <p class="stat-label">Total Orders</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.1); color: var(--success);">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">28</h3>
            <p class="stat-label">Completed</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(255, 193, 7, 0.1); color: var(--warning);">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">8</h3>
            <p class="stat-label">Pending</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(220, 53, 69, 0.1); color: var(--danger);">
            <i class="fas fa-times-circle"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">6</h3>
            <p class="stat-label">Cancelled</p>
        </div>
    </div>
</div>

<!-- Order Actions -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-plus-circle fa-3x text-primary mb-3"></i>
                <h5>Create Order</h5>
                <p class="text-muted">Create new customer order</p>
                <button class="btn btn-primary">Create Now</button>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-file-export fa-3x text-success mb-3"></i>
                <h5>Export Orders</h5>
                <p class="text-muted">Export order reports</p>
                <button class="btn btn-success">Export Now</button>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-filter fa-3x text-info mb-3"></i>
                <h5>Filter Orders</h5>
                <p class="text-muted">Advanced order filtering</p>
                <button class="btn btn-info">Filter Now</button>
            </div>
        </div>
    </div>
</div>

<!-- Orders Table -->
<div class="card">
    <div class="card-header">
        <i class="fas fa-list me-2"></i>Order List
    </div>
    <div class="card-body">
        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Products</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#ORD-001</td>
                        <td>John Doe</td>
                        <td>Dec 4, 2023</td>
                        <td>2 items</td>
                        <td>P5,800</td>
                        <td><span class="badge bg-success">Completed</span></td>
                        <td>
                            <button class="btn btn-sm btn-primary action-btn" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-info action-btn" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>#ORD-002</td>
                        <td>Jane Smith</td>
                        <td>Dec 3, 2023</td>
                        <td>3 items</td>
                        <td>P12,400</td>
                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                        <td>
                            <button class="btn btn-sm btn-primary action-btn" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-info action-btn" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>#ORD-003</td>
                        <td>ABC Corporation</td>
                        <td>Dec 2, 2023</td>
                        <td>10 items</td>
                        <td>P45,200</td>
                        <td><span class="badge bg-info">Processing</span></td>
                        <td>
                            <button class="btn btn-sm btn-primary action-btn" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-info action-btn" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>#ORD-004</td>
                        <td>Mike Johnson</td>
                        <td>Dec 1, 2023</td>
                        <td>1 item</td>
                        <td>P2,500</td>
                        <td><span class="badge bg-danger">Cancelled</span></td>
                        <td>
                            <button class="btn btn-sm btn-primary action-btn" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-info action-btn" title="View">
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