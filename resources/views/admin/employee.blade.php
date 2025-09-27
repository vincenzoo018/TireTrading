@extends('layouts.admin.app')

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
<div class="stats-container d-flex gap-3 mb-4">
    <div class="stat-card p-3 border rounded flex-fill d-flex align-items-center">
        <div class="stat-icon me-3" style="background-color: rgba(74, 144, 226, 0.1); color: var(--primary); font-size: 2rem;">
            <i class="fas fa-user-tie"></i>
        </div>
        <div>
            <h3 class="stat-value mb-0">{{ $employees->count() }}</h3>
            <p class="stat-label mb-0">Total Employees</p>
        </div>
    </div>
    <div class="stat-card p-3 border rounded flex-fill d-flex align-items-center">
        <div class="stat-icon me-3" style="background-color: rgba(40, 167, 69, 0.1); color: var(--success); font-size: 2rem;">
            <i class="fas fa-user-check"></i>
        </div>
        <div>
            <h3 class="stat-value mb-0">{{ $employees->where('status', 'active')->count() }}</h3>
            <p class="stat-label mb-0">Active Employees</p>
        </div>
    </div>
    <div class="stat-card p-3 border rounded flex-fill d-flex align-items-center">
        <div class="stat-icon me-3" style="background-color: rgba(255, 193, 7, 0.1); color: var(--warning); font-size: 2rem;">
            <i class="fas fa-clock"></i>
        </div>
        <div>
            <h3 class="stat-value mb-0">{{ $employees->where('status', 'on_leave')->count() }}</h3>
            <p class="stat-label mb-0">On Leave</p>
        </div>
    </div>
    <div class="stat-card p-3 border rounded flex-fill d-flex align-items-center">
        <div class="stat-icon me-3" style="background-color: rgba(220, 53, 69, 0.1); color: var(--danger); font-size: 2rem;">
            <i class="fas fa-user-slash"></i>
        </div>
        <div>
            <h3 class="stat-value mb-0">{{ $employees->where('status', 'inactive')->count() }}</h3>
            <p class="stat-label mb-0">Inactive</p>
        </div>
    </div>
</div>

<!-- Add Employee Form -->
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-user-plus me-2"></i>Add New Employee
    </div>
    <div class="card-body">
        <form action="{{ route('admin.employee.store') }}" method="POST">
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="employeeName" class="form-label">Full Name</label>
                    <input type="text" name="employee_name" id="employeeName" class="form-control" value="{{ old('employee_name') }}" required>
                    @error('employee_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="employeeEmail" class="form-label">Email Address</label>
                    <input type="email" name="email" id="employeeEmail" class="form-control" value="{{ old('email') }}" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="employeePhone" class="form-label">Phone Number</label>
                    <input type="tel" name="contact_number" id="employeePhone" class="form-control" value="{{ old('contact_number') }}" required>
                    @error('contact_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="employeePosition" class="form-label">Position</label>
                    <input type="text" name="position" id="employeePosition" class="form-control" value="{{ old('position') }}" required>
                    @error('position')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
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
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employee->employee_name }}</td>
                        <td>{{ ucfirst($employee->position) }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>
                            <a href="{{ route('admin.employee.edit', $employee->employee_id) }}" class="btn btn-sm btn-primary" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.employee.destroy', $employee->employee_id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" title="Delete" type="submit">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No employees found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
