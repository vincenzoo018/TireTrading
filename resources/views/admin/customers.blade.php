@extends('layouts.admin.app')

@section('content')
<div class="page-header">
    <h1 class="page-title">Customer Management</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Customers</li>
        </ol>
    </nav>
</div>

<!-- Stats Cards -->
<div class="stats-container">
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(74, 144, 226, 0.1); color: var(--primary);">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">156</h3>
            <p class="stat-label">Total Customers</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.1); color: var(--success);">
            <i class="fas fa-user-check"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">128</h3>
            <p class="stat-label">Active Customers</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(255, 193, 7, 0.1); color: var(--warning);">
            <i class="fas fa-user-clock"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">24</h3>
            <p class="stat-label">New This Month</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(220, 53, 69, 0.1); color: var(--danger);">
            <i class="fas fa-user-slash"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">4</h3>
            <p class="stat-label">Inactive Customers</p>
        </div>
    </div>
</div>

<!-- Add Customer Form -->
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-user-plus me-2"></i>Add New Customer
    </div>
    <div class="card-body">
        <form>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="customerName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="customerName" required>
                </div>
                <div class="col-md-6">
                    <label for="customerEmail" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="customerEmail" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="customerPhone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="customerPhone" required>
                </div>
                <div class="col-md-6">
                    <label for="customerAddress" class="form-label">Address</label>
                    <input type="text" class="form-control" id="customerAddress" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="customerType" class="form-label">Customer Type</label>
                    <select class="form-select" id="customerType" required>
                        <option value="regular">Regular</option>
                        <option value="premium">Premium</option>
                        <option value="business">Business</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="customerStatus" class="form-label">Status</label>
                    <select class="form-select" id="customerStatus" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save me-2"></i>Add Customer
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Customers Table -->
<div class="card">
    <div class="card-header">
        <i class="fas fa-list me-2"></i>Customer List
    </div>
    <div class="card-body">
        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Type</th>
                        <th>Orders</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>john.doe@email.com</td>
                        <td>0912-345-6789</td>
                        <td><span class="badge bg-info">Regular</span></td>
                        <td>12</td>
                        <td><span class="badge bg-success">Active</span></td>
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
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>jane.smith@email.com</td>
                        <td>0917-890-1234</td>
                        <td><span class="badge bg-warning text-dark">Premium</span></td>
                        <td>28</td>
                        <td><span class="badge bg-success">Active</span></td>
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
                        <td>3</td>
                        <td>ABC Corporation</td>
                        <td>purchasing@abccorp.com</td>
                        <td>02-8123-4567</td>
                        <td><span class="badge bg-success">Business</span></td>
                        <td>45</td>
                        <td><span class="badge bg-success">Active</span></td>
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
                        <td>4</td>
                        <td>Mike Johnson</td>
                        <td>mike.j@email.com</td>
                        <td>0918-765-4321</td>
                        <td><span class="badge bg-info">Regular</span></td>
                        <td>3</td>
                        <td><span class="badge bg-secondary">Inactive</span></td>
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
