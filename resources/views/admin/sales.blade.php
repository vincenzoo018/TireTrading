@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1 class="page-title">Sales Management</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sales</li>
        </ol>
    </nav>
</div>

<!-- Stats Cards -->
<div class="stats-container">
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(74, 144, 226, 0.1); color: var(--primary);">
            <i class="fas fa-chart-line"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">P125,640</h3>
            <p class="stat-label">Total Sales</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.1); color: var(--success);">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">42</h3>
            <p class="stat-label">Total Orders</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(255, 193, 7, 0.1); color: var(--warning);">
            <i class="fas fa-user"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">28</h3>
            <p class="stat-label">Active Customers</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(220, 53, 69, 0.1); color: var(--danger);">
            <i class="fas fa-percentage"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">15%</h3>
            <p class="stat-label">Growth Rate</p>
        </div>
    </div>
</div>

<!-- Sales Charts -->
<div class="row mb-4">
    <div class="col-md-8">
        <div class="chart-container">
            <h5>Sales Performance</h5>
            <canvas id="salesChart"></canvas>
        </div>
    </div>
    <div class="col-md-4">
        <div class="chart-container">
            <h5>Sales by Category</h5>
            <canvas id="salesCategoryChart"></canvas>
        </div>
    </div>
</div>

<!-- Top Selling Products -->
<div class="card">
    <div class="card-header">
        <i class="fas fa-star me-2"></i>Top Selling Products
    </div>
    <div class="card-body">
        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Units Sold</th>
                        <th>Revenue</th>
                        <th>Trend</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>All-Terrain Tires</td>
                        <td>Tires</td>
                        <td>45</td>
                        <td>P112,500</td>
                        <td><span class="text-success"><i class="fas fa-arrow-up"></i> 15%</span></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Winter Tires</td>
                        <td>Tires</td>
                        <td>28</td>
                        <td>P89,600</td>
                        <td><span class="text-success"><i class="fas fa-arrow-up"></i> 8%</span></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Performance Tires</td>
                        <td>Tires</td>
                        <td>22</td>
                        <td>P99,000</td>
                        <td><span class="text-success"><i class="fas fa-arrow-up"></i> 12%</span></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Wheel Alignment</td>
                        <td>Services</td>
                        <td>35</td>
                        <td>P28,000</td>
                        <td><span class="text-success"><i class="fas fa-arrow-up"></i> 5%</span></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Car Mats</td>
                        <td>Accessories</td>
                        <td>18</td>
                        <td>P21,600</td>
                        <td><span class="text-danger"><i class="fas fa-arrow-down"></i> 3%</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sales Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Sales 2023',
                    data: [85000, 92000, 78000, 95000, 110000, 105000, 120000, 115000, 125000, 130000, 140000, 125640],
                    backgroundColor: 'rgba(74, 144, 226, 0.2)',
                    borderColor: 'rgba(74, 144, 226, 1)',
                    borderWidth: 2,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Sales Category Chart
        const categoryCtx = document.getElementById('salesCategoryChart').getContext('2d');
        const categoryChart = new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: ['Tires', 'Services', 'Accessories'],
                datasets: [{
                    data: [75, 20, 5],
                    backgroundColor: [
                        'rgba(74, 144, 226, 0.8)',
                        'rgba(40, 167, 69, 0.8)',
                        'rgba(255, 193, 7, 0.8)'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    });
</script>
@endsection
@endsection