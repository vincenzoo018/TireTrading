@extends('layouts.admin.app')

@section('content')
<div class="page-header">
    <h1 class="page-title">Transaction Management</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Transactions</li>
        </ol>
    </nav>
</div>

<!-- Stats Cards -->
<div class="stats-container">
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(74, 144, 226, 0.1); color: var(--primary);">
            <i class="fas fa-exchange-alt"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">156</h3>
            <p class="stat-label">Total Transactions</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.1); color: var(--success);">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">P245,800</h3>
            <p class="stat-label">Total Amount</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(255, 193, 7, 0.1); color: var(--warning);">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">12</h3>
            <p class="stat-label">Pending</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(220, 53, 69, 0.1); color: var(--danger);">
            <i class="fas fa-times-circle"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">8</h3>
            <p class="stat-label">Failed</p>
        </div>
    </div>
</div>

<!-- Transaction Filters -->
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-filter me-2"></i>Filter Transactions
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <label for="dateFrom" class="form-label">Date From</label>
                <input type="date" class="form-control" id="dateFrom">
            </div>
            <div class="col-md-3">
                <label for="dateTo" class="form-label">Date To</label>
                <input type="date" class="form-control" id="dateTo">
            </div>
            <div class="col-md-3">
                <label for="transactionType" class="form-label">Type</label>
                <select class="form-select" id="transactionType">
                    <option value="">All Types</option>
                    <option value="sale">Sale</option>
                    <option value="refund">Refund</option>
                    <option value="payment">Payment</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="transactionStatus" class="form-label">Status</label>
                <select class="form-select" id="transactionStatus">
                    <option value="">All Status</option>
                    <option value="completed">Completed</option>
                    <option value="pending">Pending</option>
                    <option value="failed">Failed</option>
                </select>
            </div>
        </div>
        <div class="text-center mt-3">
            <button class="btn btn-primary">
                <i class="fas fa-filter me-2"></i>Apply Filters
            </button>
        </div>
    </div>
</div>

<!-- Transactions Table -->
<div class="card">
    <div class="card-header">
        <i class="fas fa-list me-2"></i>Transaction List
    </div>
    <div class="card-body">
        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#TXN-001</td>
                        <td>Dec 4, 2023</td>
                        <td>John Doe</td>
                        <td><span class="badge bg-success">Sale</span></td>
                        <td>P5,800</td>
                        <td>Credit Card</td>
                        <td><span class="badge bg-success">Completed</span></td>
                        <td>
                            <button class="btn btn-sm btn-info action-btn" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-primary action-btn" title="Print">
                                <i class="fas fa-print"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>#TXN-002</td>
                        <td>Dec 3, 2023</td>
                        <td>Jane Smith</td>
                        <td><span class="badge bg-success">Sale</span></td>
                        <td>P12,400</td>
                        <td>Bank Transfer</td>
                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                        <td>
                            <button class="btn btn-sm btn-info action-btn" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-primary action-btn" title="Print">
                                <i class="fas fa-print"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>#TXN-003</td>
                        <td>Dec 2, 2023</td>
                        <td>ABC Corporation</td>
                        <td><span class="badge bg-info">Payment</span></td>
                        <td>P45,200</td>
                        <td>Check</td>
                        <td><span class="badge bg-success">Completed</span></td>
                        <td>
                            <button class="btn btn-sm btn-info action-btn" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-primary action-btn" title="Print">
                                <i class="fas fa-print"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>#TXN-004</td>
                        <td>Dec 1, 2023</td>
                        <td>Mike Johnson</td>
                        <td><span class="badge bg-danger">Refund</span></td>
                        <td>P2,500</td>
                        <td>Cash</td>
                        <td><span class="badge bg-success">Completed</span></td>
                        <td>
                            <button class="btn btn-sm btn-info action-btn" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-primary action-btn" title="Print">
                                <i class="fas fa-print"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
