@extends('layouts.customer.app')

@section('content')
<!-- Services Header -->
<section class="py-5 bg-light">
    <div class="container">
        <h1 class="section-title">Our Services</h1>
        <p class="lead">Professional automotive services to keep your vehicle in top condition</p>
    </div>
</section>

<!-- Services Section -->
<section class="py-5">
    <div class="container">
        <form method="GET" action="{{ route('customer.services') }}" class="row mb-4 g-2">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search services..." value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <select name="sort" class="form-select">
                    <option value="">Sort by: Featured</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z to A</option>
                </select>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary w-100" type="submit">Filter</button>
            </div>
        </form>

        <div class="row">
            @forelse($services as $service)
                @php
                    $isBooked = in_array($service->services_id, $bookedServiceIds ?? []);
                @endphp
                <div class="col-md-4 mb-4">
                    <div class="card service-card text-center h-100">
                        <div class="card-body">
                            <div class="service-icon mb-2">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <h5 class="card-title">{{ $service->service_name }}</h5>
                            <p class="card-text">{{ $service->description }}</p>
                            <p class="price">P{{ number_format($service->service_price, 2) }}</p>
                            <div class="mb-2">
                                @if($isBooked)
                                    <span class="badge bg-secondary">Not Available</span>
                                @else
                                    <span class="badge bg-success">Available</span>
                                @endif
                            </div>
                            <a href="{{ route('customer.booking', ['service_id' => $service->services_id]) }}" class="btn btn-primary @if($isBooked) disabled @endif" @if($isBooked) tabindex="-1" aria-disabled="true" @endif>
                                Book Now
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">No services found.</div>
                </div>
            @endforelse
        </div>

        <!-- Booking Modal -->
        <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="bookingForm" method="POST" action="{{ route('customer.booking.store') }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="bookingModalLabel">Book Service</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="service_id" id="modalServiceId">
                            <div class="mb-3">
                                <label for="modalServiceName" class="form-label">Service</label>
                                <input type="text" class="form-control" id="modalServiceName" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="modalServicePrice" class="form-label">Price</label>
                                <input type="text" class="form-control" id="modalServicePrice" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="modalServiceDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="modalServiceDescription" rows="2" readonly></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="customerName" class="form-label">Your Name</label>
                                <input type="text" class="form-control" id="customerName" name="customer_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="customerContact" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="customerContact" name="customer_contact" required>
                            </div>
                            <div class="mb-3">
                                <label for="bookingDate" class="form-label">Preferred Date</label>
                                <input type="date" class="form-control" id="bookingDate" name="booking_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="vehicleInfo" class="form-label">Vehicle Info</label>
                                <input type="text" class="form-control" id="vehicleInfo" name="vehicle_info" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit Booking</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.book-btn').forEach(function (button) {
                button.addEventListener('click', function () {
                    document.getElementById('modalServiceId').value = this.getAttribute('data-id');
                    document.getElementById('modalServiceName').value = this.getAttribute('data-name');
                    document.getElementById('modalServicePrice').value = 'P' + parseFloat(this.getAttribute('data-price')).toFixed(2);
                    document.getElementById('modalServiceDescription').value = this.getAttribute('data-description');
                    var modal = new bootstrap.Modal(document.getElementById('bookingModal'));
                    modal.show();
                });
            });
        });
        </script>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center">Why Choose Our Services?</h2>
        <div class="row">
            <div class="col-md-4 text-center mb-4">
                <div class="feature-icon mb-3">
                    <i class="fas fa-certificate fa-3x text-primary"></i>
                </div>
                <h5>Certified Technicians</h5>
                <p>Our team consists of certified and experienced automotive technicians.</p>
            </div>
            <div class="col-md-4 text-center mb-4">
                <div class="feature-icon mb-3">
                    <i class="fas fa-tools fa-3x text-primary"></i>
                </div>
                <h5>Quality Equipment</h5>
                <p>We use state-of-the-art equipment for all our services.</p>
            </div>
            <div class="col-md-4 text-center mb-4">
                <div class="feature-icon mb-3">
                    <i class="fas fa-shield-alt fa-3x text-primary"></i>
                </div>
                <h5>Warranty Included</h5>
                <p>All our services come with a comprehensive warranty.</p>
            </div>
        </div>
    </div>
</section>
@endsection
