@extends('layouts.admin.app')

@section('content')
<div class="page-header">
    <h1 class="page-title">Services Management</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Services</li>
        </ol>
    </nav>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Stats Cards -->
<div class="stats-container">
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(74, 144, 226, 0.1); color: var(--primary);">
            <i class="fas fa-concierge-bell"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">{{ $totalServices }}</h3>
            <p class="stat-label">Total Services</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.1); color: var(--success);">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">{{ $activeServices }}</h3>
            <p class="stat-label">Active Services</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(255, 193, 7, 0.1); color: var(--warning);">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">{{ $pendingServices }}</h3>
            <p class="stat-label">Pending Services</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(108, 117, 125, 0.1); color: var(--secondary);">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">{{ $totalEmployees }}</h3>
            <p class="stat-label">Available Employees</p>
        </div>
    </div>
</div>

<!-- Add Service Form -->
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-plus-circle me-2"></i>Add New Service
    </div>
    <div class="card-body">
        <form action="{{ route('admin.services.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="serviceName" class="form-label">Service Name *</label>
                    <input type="text" class="form-control" id="serviceName" name="service_name" required>
                </div>
                <div class="col-md-6">
                    <label for="servicePrice" class="form-label">Price *</label>
                    <input type="number" step="0.01" class="form-control" id="servicePrice" name="service_price" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="employee" class="form-label">Assigned Employee *</label>
                    <select class="form-select" id="employee" name="employee_id" required>
                        <option value="">Select Employee</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->employee_id }}">{{ $employee->employee_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="serviceStatus" class="form-label">Status *</label>
                    <select class="form-select" id="serviceStatus" name="status" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label for="serviceDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="serviceDescription" name="description" rows="3"></textarea>
                </div>
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save me-2"></i>Add Service
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Services Table -->
<div class="card">
    <div class="card-header">
        <i class="fas fa-list me-2"></i>Service List
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Service Name</th>
                        <th>Price</th>
                        <th>Assigned Employee</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $service->service_name }}</td>
                        <td>P{{ number_format($service->service_price, 2) }}</td>
                        <td>
                            @if($service->employee)
                                {{ $service->employee->employee_name }}
                            @else
                                <span class="text-muted">Not assigned</span>
                            @endif
                        </td>
                        <td>
                            @if($service->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary action-btn edit-service"
                                    data-id="{{ $service->services_id }}"
                                    data-name="{{ $service->service_name }}"
                                    data-price="{{ $service->service_price }}"
                                    data-employee="{{ $service->employee_id }}"
                                    data-status="{{ $service->status }}"
                                    data-description="{{ $service->description }}"
                                    data-bs-toggle="tooltip" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('admin.services.delete', $service->services_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger action-btn" data-bs-toggle="tooltip" title="Delete" onclick="return confirm('Are you sure you want to delete this service?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Service Modal -->
<div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editServiceModalLabel">Edit Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editServiceForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editServiceName" class="form-label">Service Name</label>
                        <input type="text" class="form-control" id="editServiceName" name="service_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editServicePrice" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" id="editServicePrice" name="service_price" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEmployee" class="form-label">Assigned Employee</label>
                        <select class="form-select" id="editEmployee" name="employee_id" required>
                            <option value="">Select Employee</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->employee_id }}">{{ $employee->employee_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editServiceStatus" class="form-label">Status</label>
                        <select class="form-select" id="editServiceStatus" name="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editServiceDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="editServiceDescription" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Service</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Edit Service Modal
        const editServiceButtons = document.querySelectorAll('.edit-service');
        const editServiceModal = new bootstrap.Modal(document.getElementById('editServiceModal'));
        const editServiceForm = document.getElementById('editServiceForm');

        editServiceButtons.forEach(button => {
            button.addEventListener('click', function() {
                const serviceId = this.getAttribute('data-id');
                const serviceName = this.getAttribute('data-name');
                const servicePrice = this.getAttribute('data-price');
                const employeeId = this.getAttribute('data-employee');
                const status = this.getAttribute('data-status');
                const description = this.getAttribute('data-description');

                document.getElementById('editServiceName').value = serviceName;
                document.getElementById('editServicePrice').value = servicePrice;
                document.getElementById('editEmployee').value = employeeId;
                document.getElementById('editServiceStatus').value = status;
                document.getElementById('editServiceDescription').value = description;

                editServiceForm.action = `/admin/services/${serviceId}`;
                editServiceModal.show();
            });
        });
    });
</script>
@endsection
