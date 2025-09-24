@extends('layouts.admin.app')

@section('content')
<div class="page-header">
    <h1 class="page-title">Dashboard</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
            <p class="stat-label">New Orders</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.1); color: var(--success);">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">156</h3>
            <p class="stat-label">Total Customers</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(255, 193, 7, 0.1); color: var(--warning);">
            <i class="fas fa-box"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">24</h3>
            <p class="stat-label">Low Stock Items</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(220, 53, 69, 0.1); color: var(--danger);">
            <i class="fas fa-chart-line"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">P125,640</h3>
            <p class="stat-label">Monthly Revenue</p>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row">
    <div class="col-md-8">
        <div class="chart-container">
            <h5>Sales Overview</h5>
            <canvas id="salesChart"></canvas>
        </div>
    </div>
    <div class="col-md-4">
        <div class="chart-container">
            <h5>Revenue Sources</h5>
            <canvas id="revenueChart"></canvas>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="card mt-4">
    <div class="card-header">
        <i class="fas fa-history me-2"></i>Recent Activity
    </div>
    <div class="card-body">
        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Activity</th>
                        <th>User</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>12/04/2023 10:30 AM</td>
                        <td>New Order</td>
                        <td>Customer: John Doe</td>
                        <td>Order #12345</td>
                    </tr>
                    <tr>
                        <td>12/03/2023 02:15 PM</td>
                        <td>Product Added</td>
                        <td>Admin User</td>
                        <td>Winter Tires</td>
                    </tr>
                    <tr>
                        <td>12/02/2023 09:45 AM</td>
                        <td>Payment Received</td>
                        <td>Customer: Jane Smith</td>
                        <td>Amount: P12,500</td>
                    </tr>
                    <tr>
                        <td>12/01/2023 04:20 PM</td>
                        <td>Inventory Updated</td>
                        <td>Admin User</td>
                        <td>All-Terrain Tires: +20 units</td>
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
                    data: [65, 59, 80, 81, 56, 55, 72, 68, 75, 80, 85, 92],
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

        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'doughnut',
            data: {
                labels: ['Tires', 'Services', 'Accessories'],
                datasets: [{
                    data: [65, 25, 10],
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
