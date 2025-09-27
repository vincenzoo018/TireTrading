@extends('layouts.admin.app')

@section('content')
<div class="page-header">
    <h1 class="page-title">Bookings Management</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Bookings</li>
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
            <i class="fas fa-calendar-check"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">{{ $totalBookings }}</h3>
            <p class="stat-label">Total Bookings</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.1); color: var(--success);">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">{{ $confirmedBookings }}</h3>
            <p class="stat-label">Confirmed</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(255, 193, 7, 0.1); color: var(--warning);">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">{{ $pendingBookings }}</h3>
            <p class="stat-label">Pending</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(220, 53, 69, 0.1); color: var(--danger);">
            <i class="fas fa-times-circle"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">{{ $cancelledBookings }}</h3>
            <p class="stat-label">Cancelled</p>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-filter me-2"></i>Filter Bookings
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.bookings') }}">
            <div class="row">
                <div class="col-md-3">
                    <label for="statusFilter" class="form-label">Status</label>
                    <select class="form-select" id="statusFilter" name="status">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="dateFilter" class="form-label">Booking Date</label>
                    <input type="date" class="form-control" id="dateFilter" name="date" value="{{ request('date') }}">
                </div>
                <div class="col-md-3">
                    <label for="serviceFilter" class="form-label">Service</label>
                    <select class="form-select" id="serviceFilter" name="service_id">
                        <option value="">All Services</option>
                        @foreach($services as $service)
                            <option value="{{ $service->services_id }}" {{ request('service_id') == $service->services_id ? 'selected' : '' }}>
                                {{ $service->service_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Bookings Table -->
<div class="card">
    <div class="card-header">
        <i class="fas fa-list me-2"></i>Booking List
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Service</th>
                        <th>Booking Date & Time</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $loop->iteration + ($bookings->currentPage() - 1) * $bookings->perPage() }}</td>
                        <td>
                            @if($booking->customer)
                                {{ $booking->customer->first_name }} {{ $booking->customer->last_name }}
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>
                            @if($booking->service)
                                {{ $booking->service->service_name }}
                            @else
                                <span class="text-muted">Service not available</span>
                            @endif
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}
                            at {{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}
                        </td>
                        <td>
                            @if($booking->payment_method)
                                <span class="text-capitalize">{{ $booking->payment_method }}</span>
                            @else
                                <span class="text-muted">Not specified</span>
                            @endif
                        </td>
                        <td>
                            @if($booking->status === 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($booking->status === 'confirmed')
                                <span class="badge bg-success">Confirmed</span>
                            @elseif($booking->status === 'completed')
                                <span class="badge bg-info">Completed</span>
                            @else
                                <span class="badge bg-danger">Cancelled</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary action-btn view-booking"
                                    data-bs-toggle="tooltip" title="View Details"
                                    data-id="{{ $booking->booking_id }}"
                                    data-customer="{{ $booking->customer ? $booking->customer->first_name . ' ' . $booking->customer->last_name : 'N/A' }}"
                                    data-service="{{ $booking->service ? $booking->service->service_name : 'N/A' }}"
                                    data-date="{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}"
                                    data-time="{{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}"
                                    data-payment="{{ $booking->payment_method ?: 'Not specified' }}"
                                    data-status="{{ $booking->status }}"
                                    data-notes="{{ $booking->notes ?: 'No additional notes' }}">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-warning action-btn edit-booking"
                                    data-bs-toggle="tooltip" title="Edit Booking"
                                    data-id="{{ $booking->booking_id }}"
                                    data-status="{{ $booking->status }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('admin.bookings.delete', $booking->booking_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger action-btn" data-bs-toggle="tooltip" title="Delete" onclick="return confirm('Are you sure you want to delete this booking?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($bookings->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $bookings->links() }}
        </div>
        @endif
    </div>
</div>

<!-- View Booking Modal -->
<div class="modal fade" id="viewBookingModal" tabindex="-1" aria-labelledby="viewBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewBookingModalLabel">Booking Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-sm-4 fw-bold">Customer:</div>
                    <div class="col-sm-8" id="viewCustomer"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 fw-bold">Service:</div>
                    <div class="col-sm-8" id="viewService"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 fw-bold">Date & Time:</div>
                    <div class="col-sm-8" id="viewDateTime"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 fw-bold">Payment Method:</div>
                    <div class="col-sm-8" id="viewPayment"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 fw-bold">Status:</div>
                    <div class="col-sm-8" id="viewStatus"></div>
                </div>
                <div class="row">
                    <div class="col-sm-4 fw-bold">Notes:</div>
                    <div class="col-sm-8" id="viewNotes"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Booking Status Modal -->
<div class="modal fade" id="editBookingModal" tabindex="-1" aria-labelledby="editBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBookingModalLabel">Update Booking Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editBookingForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editBookingStatus" class="form-label">Status</label>
                        <select class="form-select" id="editBookingStatus" name="status" required>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // View Booking Modal
        const viewBookingButtons = document.querySelectorAll('.view-booking');
        const viewBookingModal = new bootstrap.Modal(document.getElementById('viewBookingModal'));

        viewBookingButtons.forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('viewCustomer').textContent = this.getAttribute('data-customer');
                document.getElementById('viewService').textContent = this.getAttribute('data-service');
                document.getElementById('viewDateTime').textContent = this.getAttribute('data-date') + ' at ' + this.getAttribute('data-time');
                document.getElementById('viewPayment').textContent = this.getAttribute('data-payment');

                const status = this.getAttribute('data-status');
                let statusBadge = '';
                if(status === 'pending') {
                    statusBadge = '<span class="badge bg-warning text-dark">Pending</span>';
                } else if(status === 'confirmed') {
                    statusBadge = '<span class="badge bg-success">Confirmed</span>';
                } else if(status === 'completed') {
                    statusBadge = '<span class="badge bg-info">Completed</span>';
                } else {
                    statusBadge = '<span class="badge bg-danger">Cancelled</span>';
                }
                document.getElementById('viewStatus').innerHTML = statusBadge;

                document.getElementById('viewNotes').textContent = this.getAttribute('data-notes');

                viewBookingModal.show();
            });
        });

        // Edit Booking Status Modal
        const editBookingButtons = document.querySelectorAll('.edit-booking');
        const editBookingModal = new bootstrap.Modal(document.getElementById('editBookingModal'));
        const editBookingForm = document.getElementById('editBookingForm');

        editBookingButtons.forEach(button => {
            button.addEventListener('click', function() {
                const bookingId = this.getAttribute('data-id');
                const currentStatus = this.getAttribute('data-status');

                document.getElementById('editBookingStatus').value = currentStatus;
                editBookingForm.action = `/admin/bookings/${bookingId}`;
                editBookingModal.show();
            });
        });
    });
</script>
@endsection
