@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1 class="page-title">Employee Management</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Employees</li>
        </ol>
    </nav>
</div>

<!-- Stats Cards -->
<div class="stats-container">
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(74, 144, 226, 0.1); color: var(--primary);">
            <i class="fas fa-user-tie"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">24</h3>
            <p class="stat-label">Total Employees</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.1); color: var(--success);">
            <i class="fas fa-user-check"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">20</h3>
            <p class="stat-label">Active Employees</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(255, 193, 7, 0.1); color: var(--warning);">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">3</h3>
            <p class="stat-label">On Leave</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(220, 53, 69, 0.1); color: var(--danger);">
            <i class="fas fa-user-slash"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">1</h3>
            <p class="stat-label">Inactive</p>
        </div>
    </div>
</div>

<!-- Add Employee Form -->
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-user-plus me-2"></i>Add New Employee
    </div>
    <div class="card-body">
        <form>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="employeeName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="employeeName" required>
                </div>
                <div class="col-md-6">
                    <label for="employeeEmail" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="employeeEmail" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="employeePhone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="employeePhone" required>
                </div>
                <div class="col-md-6">
                    <label for="employeePosition" class="form-label">Position</label>
                    <select class="form-select" id="employeePosition" required>
                        <option value="manager">Manager</option>
                        <option value="sales">Sales Associate</option>
                        <option value="technician">Technician</option>
                        <option value="admin">Administrator</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="employeeDepartment" class="form-label">Department</label>
                    <select class="form-select" id="employeeDepartment" required>
                        <option value="sales">Sales</option>
                        <option value="service">Service</option>
                        <option value="admin">Administration</option>
                        <option value="management">Management</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="employeeSalary" class="form-label">Salary</label>
                    <input type="number" class="form-control" id="employeeSalary" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="employeeStatus" class="form-label">Status</label>
                    <select class="form-select" id="employeeStatus" required>
                        <option value="active">Active</option>
                        <option value="on_leave">On Leave</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="employeeDate" class="form-label">Hire Date</label>
                    <input type="date" class="form-control" id="employeeDate" required>
                </div>
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save me-2"></i>Add Employee
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Employees Table -->
<div class="card">
    <div class="card-header">
        <i class="fas fa-list me-2"></i>Employee List
    </div>
    <div class="card-body">
        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Department</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Juan Dela Cruz</td>
                        <td>Manager</td>
                        <td>Management</td>
                        <td>juan.delacruz@8ply.com</td>
                        <td>0912-345-6789</td>
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
                        <td>Maria Santos</td>
                        <td>Sales Associate</td>
                        <td>Sales</td>
                        <td>maria.santos@8ply.com</td>
                        <td>0917-890-1234</td>
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
                        <td>Pedro Reyes</td>
                        <td>Technician</td>
                        <td>Service</td>
                        <td>pedro.reyes@8ply.com</td>
                        <td>0918-765-4321</td>
                        <td><span class="badge bg-warning text-dark">On Leave</span></td>
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
                        <td>Ana Lopez</td>
                        <td>Administrator</td>
                        <td>Administration</td>
                        <td>ana.lopez@8ply.com</td>
                        <td>02-8123-4567</td>
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
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection