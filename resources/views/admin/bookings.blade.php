@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1 class="page-title">Booking Management</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Bookings</li>
        </ol>
    </nav>
</div>

<!-- Stats Cards -->
<div class="stats-container">
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(74, 144, 226, 0.1); color: var(--primary);">
            <i class="fas fa-calendar-check"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">36</h3>
            <p class="stat-label">Total Bookings</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.1); color: var(--success);">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">24</h3>
            <p class="stat-label">Confirmed</p>
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
            <h3 class="stat-value">4</h3>
            <p class="stat-label">Cancelled</p>
        </div>
    </div>
</div>

<!-- Booking Calendar -->
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-calendar me-2"></i>Booking Calendar
    </div>
    <div class="card-body">
        <div class="text-center mb-3">
            <h4>December 2023</h4>
        </div>
        <div class="calendar-container">
            <div class="calendar-grid">
                <div class="calendar-header">Sun</div>
                <div class="calendar-header">Mon</div>
                <div class="calendar-header">Tue</div>
                <div class="calendar-header">Wed</div>
                <div class="calendar-header">Thu</div>
                <div class="calendar-header">Fri</div>
                <div class="calendar-header">Sat</div>
                
                <!-- Calendar days would go here -->
                <div class="calendar-day">26</div>
                <div class="calendar-day">27</div>
                <div class="calendar-day">28</div>
                <div class="calendar-day">29</div>
                <div class="calendar-day">30</div>
                <div class="calendar-day">1</div>
                <div class="calendar-day active">2</div>
                <div class="calendar-day">3</div>
                <div class="calendar-day">4</div>
                <div class="calendar-day">5</div>
                <div class="calendar-day">6</div>
                <div class="calendar-day">7</div>
                <div class="calendar-day">8</div>
                <div class="calendar-day">9</div>
                <div class="calendar-day">10</div>
                <div class="calendar-day">11</div>
                <div class="calendar-day">12</div>
                <div class="calendar-day">13</div>
                <div class="calendar-day">14</div>
                <div class="calendar-day">15</div>
                <div class="calendar-day">16</div>
                <div class="calendar-day">17</div>
                <div class="calendar-day">18</div>
                <div class="calendar-day">19</div>
                <div class="calendar-day">20</div>
                <div class="calendar-day">21</div>
                <div class="calendar-day">22</div>
                <div class="calendar-day">23</div>
                <div class="calendar-day">24</div>
                <div class="calendar-day">25</div>
                <div class="calendar-day">26</div>
                <div class="calendar-day">27</div>
                <div class="calendar-day">28</div>
                <div class="calendar-day">29</div>
                <div class="calendar-day">30</div>
                <div class="calendar-day">31</div>
            </div>
        </div>
    </div>
</div>

<!-- Bookings Table -->
<div class="card">
    <div class="card-header">
        <i class="fas fa-list me-2"></i>Booking List
    </div>
    <div class="card-body">
        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Booking #</th>
                        <th>Customer</th>
                        <th>Service</th>
                        <th>Date & Time</th>
                        <th>Technician</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#BKG-001</td>
                        <td>John Doe</td>
                        <td>Wheel Alignment</td>
                        <td>Dec 5, 2023 - 10:00 AM</td>
                        <td>Pedro Reyes</td>
                        <td><span class="badge bg-success">Confirmed</span></td>
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
                        <td>#BKG-002</td>
                        <td>Jane Smith</td>
                        <td>Tire Replacement</td>
                        <td>Dec 6, 2023 - 2:00 PM</td>
                        <td>Maria Santos</td>
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
                        <td>#BKG-003</td>
                        <td>Mike Johnson</td>
                        <td>Brake Service</td>
                        <td>Dec 7, 2023 - 9:00 AM</td>
                        <td>Juan Dela Cruz</td>
                        <td><span class="badge bg-success">Confirmed</span></td>
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
                        <td>#BKG-004</td>
                        <td>ABC Corporation</td>
                        <td>Fleet Maintenance</td>
                        <td>Dec 8, 2023 - 1:00 PM</td>
                        <td>Ana Lopez</td>
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

<style>
.calendar-container {
    background: white;
    border-radius: 10px;
    padding: 20px;
}

.calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 5px;
}

.calendar-header {
    text-align: center;
    font-weight: bold;
    padding: 10px;
    background-color: #f8f9fa;
    border-radius: 5px;
}

.calendar-day {
    text-align: center;
    padding: 15px;
    border: 1px solid #dee2e6;
    border-radius: 5px;
    cursor: pointer;
}

.calendar-day:hover {
    background-color: #e9ecef;
}

.calendar-day.active {
    background-color: var(--primary);
    color: white;
}
</style>
@endsection