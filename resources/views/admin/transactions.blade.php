@extends('layouts.app')

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
                    <option value="pending">